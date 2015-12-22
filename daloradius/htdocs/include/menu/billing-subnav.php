
                                <ul id="subnav">

                                                <li><a href="bill-pos.php"><?php echo $l['menu']['POS'];?></a></li>
                                                <li><a href="bill-plans.php"><?php echo $l['menu']['Plans'];?></a></li>
                                                <li><a href="bill-rates.php"><?php echo $l['menu']['Rates'];?></a></li>
                                                <li><a href="bill-merchant.php"><?php echo $l['menu']['Merchant-Transactions'];?></a></li>
                                                <li><a href="bill-history.php"><?php echo $l['menu']['Billing-History'];?></a></li>
                                                <li><a href="bill-invoice.php"><?php echo $l['menu']['Invoices'];?></a></li>
                                                <li><a href="bill-payments.php"><?php echo $l['menu']['Payments'];?></a></li>
<div id="logindiv" style="text-align: right;">
                                                <li><?php echo $l['menu']['Location'];?>: <b><?php echo $_SESSION['location_name'] ?></b></li><br/>
                                                <li><?php echo $l['menu']['Welcome'];?>, <?php echo $operator; ?></li>
                                                <li><a href="logout.php">[<?php echo $l['menu']['logout'];?>]</a></li>
                                </ul>

                </div>

