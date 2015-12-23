#!/bin/sh


sed -i -e 's/dialect =.*/dialect = \"mysql\"/' \
 -e 's/driver = \"rlm_sql_null\"/driver = \"rlm_sql_mysql\"/' \
 -e 's/#	server = \"localhost\"/	server = "$DB_HOST_VALUE"/' \
 -e 's/#	port = 3306/	port = $DB_PORT_VALUE/' \
 -e 's/#	login = \"radius\"/	login = \"$DB_USER_VALUE\"/' \
 -e 's/#	password = \"radpass\"/	password = \"$DB_PASS_VALUE\"/' \
 -e 's/	radius_db = \"radius\"/	radius_db = \"$DB_NAME_VALUE\"/' \
  /etc/raddb/mods-available/sql

