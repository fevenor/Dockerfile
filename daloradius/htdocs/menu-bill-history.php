<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>daloRADIUS</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/1.css" type="text/css" media="screen,projection" />

<link rel="stylesheet" type="text/css" href="library/js_date/datechooser.css">
<!--[if lte IE 6.5]>
<link rel="stylesheet" type="text/css" href="library/js_date/select-free.css"/>
<![endif]-->
</head>

<script src="library/js_date/date-functions.js" type="text/javascript"></script>
<script src="library/js_date/datechooser.js" type="text/javascript"></script>
<script src="library/javascript/pages_common.js" type="text/javascript"></script>

<body>
<?php
    include_once ("lang/main.php");
?>
<div id="wrapper">
<div id="innerwrapper">

<?php
    $m_active = "Billing";
    include_once ("include/menu/menu-items.php");
	include_once ("include/menu/billing-subnav.php");
?>

<div id="sidebar">

                                <h2><?php echo $l['menu']['Billing'];?></h2>

                                <h3><?php echo $l['menu']['Track Billing History'];?></h3>
	<ul class="subnav">

        <form name="billhistory" action="bill-history-query.php" method="get" class="sidebar">

        <input class="sidebutton" type="submit" name="submit" value="<?php echo $l['button']['ProcessQuery'] ?>" tabindex=3 />
	<br/><br/>

		<h109><?php echo $l['button']['BetweenDates']; ?></h109> <br/>

                        <input name="startdate" type="text" id="startdate"
                                value="<?php if (isset($billing_date_startdate)) echo $billing_date_startdate;
                        else echo date("Y-m-01"); ?>">

                        <img src="library/js_date/calendar.gif"
                                onclick="showChooser(this, 'startdate', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
                        <div id="chooserSpan" class="dateChooser select-free"
                                style="display: none; visibility: hidden;       width: 160px;"></div>

                        <input name="enddate" type="text" id="enddate"
                                value="<?php if (isset($billing_date_enddate)) echo $billing_date_enddate;
                                else echo date("Y-m-t"); ?>">

                        <img src="library/js_date/calendar.gif"
                                onclick="showChooser(this, 'enddate', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
                        <div id="chooserSpan" class="dateChooser select-free"
                                style="display: none; visibility: hidden; width: 160px;"></div>
			<br/><br/>


		<h109><?php echo $l['all']['Username']; ?></h109> <br/>
                        <input name="username" type="text"
                                value="<?php if (isset($billing_history_username)) echo $billing_history_username; else echo "*"; ?>">

		<h109><?php echo $l['all']['BillAction']; ?></h109> <br/>
                        <select name="billaction" size="1">
                                <option value="<?php if (isset($billing_history_billaction)) echo $billing_history_billaction; else echo "%"; ?>">
                                        <?php if (isset($billing_history_billaction)) echo $billing_history_billaction; else echo $l['button']['Any']; ?>
                                </option>
				<option value=""></option>
				<option value="Refill Session Time">Refill Session Time</option>
				<option value="Refill Session Traffic">Refill Session Traffic</option>
                        </select>
			<br/>


                <br/><br/>
                <h109><?php echo $l['button']['AccountingFieldsinQuery']; ?></h109><br/>
                <input type="checkbox" name="sqlfields[]" value="id" /> <h109> <?php echo $l['all']['ID']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="username" checked /> <h109><?php echo $l['all']['Username']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="planId" checked /> <h109><?php echo $l['all']['PlanId']; ?> </h109> <br/>

                <input type="checkbox" name="sqlfields[]" value="billAmount"  checked /> <h109><?php echo $l['all']['BillAmount']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="billAction"  checked /> <h109><?php echo $l['all']['BillAction']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="billPerformer"  checked /> <h109><?php echo $l['all']['BillPerformer']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="billReason"  /> <h109><?php echo $l['all']['BillReason']; ?> </h109> <br/>

                <input type="checkbox" name="sqlfields[]" value="paymentmethod"  checked /> <h109><?php echo $l['ContactInfo']['PaymentMethod']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="cash"  /> <h109><?php echo $l['ContactInfo']['Cash']; ?> </h109> <br/>

                <input type="checkbox" name="sqlfields[]" value="creditcardname"  /> <h109><?php echo $l['ContactInfo']['CreditCardName']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="creditcardnumber"  /> <h109><?php echo $l['ContactInfo']['CreditCardNumber']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="creditcardverification"  /> <h109><?php echo $l['ContactInfo']['CreditCardVerificationNumber']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="creditcardtype"  /> <h109><?php echo $l['ContactInfo']['CreditCardType']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="creditcardexp"  /> <h109><?php echo $l['ContactInfo']['CreditCardExpiration']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="coupon"  /> <h109><?php echo $l['all']['Coupon']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="discount"  /> <h109><?php echo $l['all']['Discount']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="notes"  /> <h109><?php echo $l['ContactInfo']['Notes']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="creationdate"  /> <h109><?php echo $l['all']['CreationDate']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="creationby"  /> <h109><?php echo $l['all']['CreationBy']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="updatedate"  /> <h109><?php echo $l['all']['UpdateDate']; ?> </h109> <br/>
                <input type="checkbox" name="sqlfields[]" value="updateby"  /> <h109><?php echo $l['all']['UpdateBy']; ?> </h109> <br/>

                <?php echo $l['button']['Select'];?>:
                <a class="table" href="javascript:SetChecked(1,'sqlfields[]','billhistory')"><?php echo $l['button']['All'];?></a>
                <a class="table" href="javascript:SetChecked(0,'sqlfields[]','billhistory')"><?php echo $l['button']['None'];?></a>


                <br/><br/>
                <h109><?php echo $l['button']['OrderBy'] ?><h109> <br/>
                        <center>
                        <select name="orderBy" size="1">
                                <option value="id"> Id </option>
                                <option value="username"> username </option>
                                <option value="txnId"> txnId </option>
			</select>

                        <select name="orderType" size="1">
				<option value="ASC"> <?php echo $l['button']['Ascending']; ?> </option>
				<option value="DESC"> <?php echo $l['button']['Descending'];?> </option>
                        </select>
                        </center>

        <br/>
        <input class="sidebutton" type="submit" name="submit" value="<?php echo $l['button']['ProcessQuery'] ?>" tabindex=3 />



                        </form></li>

		</ul>


                                <br/><br/>
                                <h2><?php echo $l['menu']['Search']; ?></h2>

			<input name="" type="text" value="<?php echo $l['menu']['Search']; ?>" tabindex=4 />

                </div>

