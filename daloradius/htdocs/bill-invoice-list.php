<?php
/*
 *********************************************************************************************************
 * daloRADIUS - RADIUS Web Platform
 * Copyright (C) 2007 - Liran Tal <liran@enginx.com> All Rights Reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *********************************************************************************************************
 *
 * Authors:	Liran Tal <liran@enginx.com>
 *
 *********************************************************************************************************
 */
 
    include ("library/checklogin.php");
    $operator = $_SESSION['operator_user'];

	include('library/check_operator_perm.php');


	//setting values for the order by and order type variables
	isset($_GET['orderBy']) ? $orderBy = $_GET['orderBy'] : $orderBy = "id";
	isset($_GET['orderType']) ? $orderType = $_GET['orderType'] : $orderType = "desc";

	
	isset($_GET['user_id']) ? $user_id = $_GET['user_id'] : $user_id = "";
	isset($_GET['username']) ? $username = $_GET['username'] : $username = "";
	isset($_GET['invoice_status_id']) ? $invoice_status_id = $_GET['invoice_status_id'] : $invoice_status_id = "";

	$edit_invoice_status_id = $invoice_status_id;
	$edit_invoiceUsername = $username;	
	

	include_once('library/config_read.php');
    $log = "visited page: ";
    $logQuery = "performed query for listing of records on page: ";
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>daloRADIUS</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/1.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="css/form-field-tooltip.css" type="text/css" media="screen,projection" />
</head>
<script src="library/javascript/pages_common.js" type="text/javascript"></script>
<script src="library/javascript/rounded-corners.js" type="text/javascript"></script>
<script src="library/javascript/form-field-tooltip.js" type="text/javascript"></script>
<script type="text/javascript" src="library/javascript/ajax.js"></script>
<script type="text/javascript" src="library/javascript/ajaxGeneric.js"></script>
<?php
	include ("menu-bill-invoice.php");
?>
		
		<div id="contentnorightbar">
		
				<h2 id="Intro"><a href="#" onclick="javascript:toggleShowDiv('helpPage')"><?php echo $l['Intro']['billinvoicelist.php'] ?>
				<h144>+</h144></a></h2>
				
				<div id="helpPage" style="display:none;visibility:visible" >
					<?php echo $l['helpPage']['billinvoicelist'] ?>
					<br/>
				</div>
				<br/>


<?php

	include 'library/opendb.php';
	include 'include/management/pages_common.php';
	include 'include/management/pages_numbering.php';		// must be included after opendb because it needs to read the CONFIG_IFACE_TABLES_LISTING variable from the config file


	// if provided username, we'll need to turn that into the userbillinfo user id
	if (!empty($username)) {
		$username = $dbSocket->escapeSimple($username);
		$sql = 'SELECT id FROM '.$configValues['CONFIG_DB_TBL_DALOUSERBILLINFO'].
				' WHERE username="'.$username.'"';
		$res = $dbSocket->query($sql);
		$logDebugSQL .= $sql . "\n";
		
		$row = $res->fetchRow();
		$user_id = $row[0];	
	}
	
	
	$sql_WHERE = ' WHERE 1=1 ';
	if (!empty($user_id))
		$sql_WHERE .= ' AND a.user_id = \''.$dbSocket->escapeSimple($user_id).'\'';

	if (!empty($edit_invoice_status_id))
		$sql_WHERE .= ' AND a.status_id = '.$dbSocket->escapeSimple($edit_invoice_status_id);
		
	//orig: used as maethod to get total rows - this is required for the pages_numbering.php page
	$sql = "SELECT a.id, a.date, a.status_id, a.type_id, b.contactperson, b.username, ".
			" c.value AS status, COALESCE(e2.totalpayed, 0) as totalpayed, COALESCE(d2.totalbilled, 0) as totalbilled ".
			" FROM ".$configValues['CONFIG_DB_TBL_DALOBILLINGINVOICE']." AS a".
			" INNER JOIN ".$configValues['CONFIG_DB_TBL_DALOUSERBILLINFO']." AS b ON (a.user_id = b.id) ".
			" INNER JOIN ".$configValues['CONFIG_DB_TBL_DALOBILLINGINVOICESTATUS']." AS c ON (a.status_id = c.id) ".
			" LEFT JOIN (SELECT SUM(d.amount + d.tax_amount) ".
					" as totalbilled, invoice_id FROM ".$configValues['CONFIG_DB_TBL_DALOBILLINGINVOICEITEMS']." AS d ".
			" GROUP BY d.invoice_id) AS d2 ON (d2.invoice_id = a.id) ".
			" LEFT JOIN (SELECT SUM(e.amount) as totalpayed, invoice_id FROM ". 
			$configValues['CONFIG_DB_TBL_DALOPAYMENTS']." AS e GROUP BY e.invoice_id) AS e2 ON (e2.invoice_id = a.id) ".
			$sql_WHERE.
			" GROUP BY a.id ";
	$res = $dbSocket->query($sql);
	$numrows = $res->numRows();		
	
	$sql = "SELECT a.id, a.date, a.status_id, a.type_id, b.contactperson, b.username, ".
			" c.value AS status, COALESCE(e2.totalpayed, 0) as totalpayed, COALESCE(d2.totalbilled, 0) as totalbilled ".
			" FROM ".$configValues['CONFIG_DB_TBL_DALOBILLINGINVOICE']." AS a".
			" INNER JOIN ".$configValues['CONFIG_DB_TBL_DALOUSERBILLINFO']." AS b ON (a.user_id = b.id) ".
			" INNER JOIN ".$configValues['CONFIG_DB_TBL_DALOBILLINGINVOICESTATUS']." AS c ON (a.status_id = c.id) ".
			" LEFT JOIN (SELECT SUM(d.amount + d.tax_amount) ".
					" as totalbilled, invoice_id FROM ".$configValues['CONFIG_DB_TBL_DALOBILLINGINVOICEITEMS']." AS d ".
			" GROUP BY d.invoice_id) AS d2 ON (d2.invoice_id = a.id) ".
			" LEFT JOIN (SELECT SUM(e.amount) as totalpayed, invoice_id FROM ". 
			$configValues['CONFIG_DB_TBL_DALOPAYMENTS']." AS e GROUP BY e.invoice_id) AS e2 ON (e2.invoice_id = a.id) ".
			$sql_WHERE.
			" GROUP BY a.id ".
			" ORDER BY $orderBy $orderType LIMIT $offset, $rowsPerPage;";
	$res = $dbSocket->query($sql);
	$logDebugSQL = "";
	$logDebugSQL .= $sql . "\n";
	
	/* START - Related to pages_numbering.php */
	$maxPage = ceil($numrows/$rowsPerPage);
	/* END */

    
	echo "<form name='listbillinvoices' method='post' action='bill-invoice-del.php'>";

	echo "<table border='0' class='table1'>\n";
	echo "
					<thead>
                                                        <tr>
                                                        <th colspan='10' align='left'>
                                Select:
                                <a class=\"table\" href=\"javascript:SetChecked(1,'invoice_id[]','listbillinvoices')\">All</a> 
                                
                                <a class=\"table\" href=\"javascript:SetChecked(0,'invoice_id[]','listbillinvoices')\">None</a>
	                 <br/>
                                <input class='button' type='button' value='Delete' onClick='javascript:removeCheckbox(\"listbillinvoices\",\"bill-invoice-del.php\")' />
                                <br/><br/>

        ";

        if ($configValues['CONFIG_IFACE_TABLES_LISTING_NUM'] == "yes")
                setupNumbering($numrows, $rowsPerPage, $pageNum, $orderBy, $orderType);

        echo " </th></tr>
                                        </thead>

                        ";

        if ($orderType == "asc") {
                $orderTypeNextPage = "desc";
        } else  if ($orderType == "desc") {
                $orderTypeNextPage = "asc";
        }

	echo "<thread> <tr>
		<th scope='col'>
		<a title='Sort' class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?orderBy=id&orderType=$orderTypeNextPage\">
		".$l['all']['Invoice']."</a>
		</th>

		<th scope='col'> 
		<a title='Sort' class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?orderBy=contactperson&orderType=$orderTypeNextPage\">
		".$l['all']['ClientName']."</a>
		</th>

		<th scope='col'> 
		<a title='Sort' class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?orderBy=date&orderType=$orderTypeNextPage\">
		".$l['all']['Date']."</a>
		</th>
		
		<th scope='col'> 
		<a title='Sort' class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?orderBy=totalbilled&orderType=$orderTypeNextPage\">
		".$l['all']['TotalBilled']."</a>
		</th>
		
		<th scope='col'> 
		<a title='Sort' class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?orderBy=totalpayed&orderType=$orderTypeNextPage\">
		".$l['all']['TotalPayed']."</a>
		</th>
		
		<th scope='col'> 
		".$l['all']['Balance']."
		</th>
		
		<th scope='col'> 
		<a title='Sort' class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?orderBy=status_id&orderType=$orderTypeNextPage\">
		".$l['all']['Status']."</a>
		</th>
		
	</tr> </thread>";

	while($row = $res->fetchRow(DB_FETCHMODE_ASSOC)) {
		
		echo '<tr>';

		
		$content =  '<a class="toolTip" href="bill-invoice-edit.php?invoice_id='.$row['id'].'">'.$l['Tooltip']['InvoiceEdit'].'</a>';
		$invoice_id = addToolTipBalloon(array(
									'content' => $content,
									'onClick' => '',
									'value' => '#'.$row['id'],
									'divId' => '',
		
							));

		$content =  '<a class="toolTip" href="bill-pos-edit.php?username='.$row['username'].'">'.$l['Tooltip']['UserEdit'].'</a>';
		$contactperson = addToolTipBalloon(array(
									'content' => $content,
									'onClick' => '',
									'value' => $row['contactperson'],
									'divId' => '',
		
							));
							
		$balance = ($row['totalpayed'] - $row['totalbilled']);
		if ($balance < 0)
			$balance = '<font color="red">'.$balance.'</font>';
		echo '<td> <input type="checkbox" name="invoice_id[]" value="'.$row['id'].'"> '.$invoice_id.' </td>';
		echo '<td> '.$contactperson.' </td>';
		echo '<td> '.$row['date'].' </td>';
		echo '<td> '.$row['totalbilled'].' </td>';
		echo '<td> '.$row['totalpayed'].' </td>';
		echo '<td> '.$balance.' </td>';
		echo '<td> '.$row['status'].' </td>';
		
		echo '</tr>';
		
	}

        echo "
                                        <tfoot>
                                                        <tr>
                                                        <th colspan='10' align='left'>
        ";
        setupLinks($pageNum, $maxPage, $orderBy, $orderType);
        echo "
                                                        </th>
                                                        </tr>
                                        </tfoot>
                ";


	echo "</table>";
        echo "</form>";

	include 'library/closedb.php';
?>
				
						
<?php
	include('include/config/logging.php');
?>
		
		</div>
		
		<div id="footer">
		
								<?php
        include 'page-footer.php';
?>

		
		</div>
		
</div>
</div>

<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEEEEE');
tooltipObj.setTooltipCornerSize(15);
tooltipObj.initFormFieldTooltip();
</script>

</body>
</html>
