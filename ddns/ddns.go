package main

import (
	"context"
	"encoding/base64"
	"fmt"
	"os"
	"strings"
	"time"

	"github.com/cloudflare/cloudflare-go"
	"github.com/kataras/iris/v12"
	"github.com/kataras/iris/v12/middleware/logger"
	"github.com/kataras/iris/v12/middleware/recover"
)

var ipv4 map[string]cloudflare.DNSRecord
var ipv6 map[string]cloudflare.DNSRecord
var app *iris.Application

func main() {
	port := os.Getenv("PORT")
	key := os.Getenv("CF_API_KEY")
	domain := os.Getenv("DOMAIN")
	ipv4 = make(map[string]cloudflare.DNSRecord, 5)
	ipv6 = make(map[string]cloudflare.DNSRecord, 5)

	app = iris.New()
	app.Logger().SetLevel("info")
	app.Use(recover.New())
	app.Use(logger.New())

	iris.RegisterOnInterrupt(func() {
		timeout := 5 * time.Second
		ctx, cancel := context.WithTimeout(context.Background(), timeout)
		defer cancel()
		app.Shutdown(ctx)
	})

	app.Get("/", func(ctx iris.Context) {
		var ip string
		req := ctx.Request()
		if req.Header.Get("CF-Connecting-IP") != "" {
			ip = req.Header.Get("CF-Connecting-IP")
		} else if req.Header.Get("X-Real-Ip") != "" {
			ip = req.Header.Get("X-Real-Ip")
		} else if req.Header.Get("X-Forwarded-For") != "" {
			ip = req.Header.Get("X-Forwarded-For")
		} else {
			addrWithPort := ctx.Request().RemoteAddr
			ip = addrWithPort[0:strings.LastIndex(addrWithPort, ":")]
			ip = strings.Trim(strings.Trim(ip, "["), "]")
		}

		if ip != "" {
			encode := ctx.URLParam("device")
			if encode != "" {
				prefix, err := base64.StdEncoding.DecodeString(encode)
				if err == nil {
					subdomain := string(prefix) + "." + domain
					var isIPv6 bool
					if len(strings.Split(ip, ".")) == 4 {
						isIPv6 = false
					} else {
						isIPv6 = true
					}
					if !judgeDNS(ip, subdomain, isIPv6) {
						err := updateDNS(ip, key, domain, subdomain, isIPv6)
						if err != nil {
							app.Logger().Error(err)
						}
					}
				}
			}
			ctx.WriteString(ip)
		} else {
			ctx.WriteString("Unknown")
		}
	})

	app.Configure(iris.WithoutServerError(iris.ErrServerClosed),
		iris.WithRemoteAddrHeader("X-Real-Ip"),
		iris.WithRemoteAddrHeader("X-Forwarded-For"),
		iris.WithRemoteAddrHeader("CF-Connecting-IP"))
	app.Run(iris.Addr(":" + port))
}

func judgeDNS(ip string, subdomain string, isIPv6 bool) bool {
	if isIPv6 {
		oldRecord, ok := ipv6[subdomain]
		if ok {
			if ip == oldRecord.Content {
				return true
			}
		} else {
			app.Logger().Info("No cache record: ", subdomain)
		}
	} else {
		oldRecord, ok := ipv4[subdomain]
		if ok {
			if ip == oldRecord.Content {
				return true
			}
		} else {
			app.Logger().Info("No cache record: ", subdomain)
		}
	}

	return false
}

func updateDNS(ip string, key string, domain, subdomain string, isIPv6 bool) error {

	// Create Cloudflare API
	api, err := cloudflare.NewWithAPIToken(key)
	app.Logger().Info("Connect cloudflare")
	if err != nil {
		return fmt.Errorf("Auth failed: %v", err)
	}
	// Get record id of the host
	zone, err := api.ZoneIDByName(domain)
	if err != nil {
		return fmt.Errorf("Get zone id failed: %v", err)
	}
	var records []cloudflare.DNSRecord
	if isIPv6 {
		records, err = api.DNSRecords(zone, cloudflare.DNSRecord{Name: subdomain, Type: "AAAA"})
	} else {
		records, err = api.DNSRecords(zone, cloudflare.DNSRecord{Name: subdomain, Type: "A"})
	}
	if err != nil {
		return fmt.Errorf("Get record id failed: %v", err)
	}
	if len(records) == 0 {
		return fmt.Errorf("Find record id failed")
	}
	if len(records) != 1 {
		return fmt.Errorf("Find record id more than one: %+v", records)
	}
	record := records[0]
	if ip != record.Content {
		// Update DNS
		app.Logger().Info("Update cloudflare record: ", subdomain, " ", ip)
		record.Content = ip
		if err := api.UpdateDNSRecord(zone, record.ID, record); err != nil {
			return fmt.Errorf("dns record update failed: %v", err)
		}
	}
	app.Logger().Info("Update cache record: ", subdomain, " ", ip)
	if isIPv6 {
		ipv6[subdomain] = record
	} else {
		ipv4[subdomain] = record
	}
	return nil
}
