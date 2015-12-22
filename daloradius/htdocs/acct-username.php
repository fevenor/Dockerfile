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
	isset($_GET['orderBy']) ? $orderBy = $_GET['orderBy'] : $orderBy = "radacctid";
	isset($_GET['orderType']) ? $orderType = $_GET['orderType'] : $orderType = "asc";	

	isset($_GET['username']) ? $username = $_GET['username'] : $username = "";

	$logDebugSQL = "";

	//feed the sidebar variables
	$accounting_username = $username;


	include_once('library/config_read.php');
    $log = "visited page: ";
    $logQuery = "performed query for user [$username] on page: ";

?>

<?php
	
	include("menu-accounting.php");
	
?>
		
		<div id="contentnorightbar">
		
		<h2 id="Intro"><a href="#" onclick="javascript:toggleShowDiv('helpPage')"><? echo $l['Intro']['acctusername.php']; ?>
		<h144>+</h144></a></h2>
				
		<div id="helpPage" style="display:none;visibility:visible" >
			<?php echo $l['helpPage']['acctusername'] ?>
			<br/>
		</div>
		<br/>



<?php

	include 'library/opendb.php';
	include 'include/management/pages_common.php';
	include 'include/management/pages_numbering.php';		// must be included after opendb because it needs to read the CONFIG_IFACE_TABLES_LISTING variable from the config file

	// we can only use the $dbSocket after we have included 'library/opendb.php' which initialzes the connection and the $dbSocket object	
	$username = $dbSocket->escapeSimple($username);	

	// setup php session variables for exporting
	$_SESSION['reportTable'] = $configValues['CONFIG_DB_TBL_RADACCT'];
	$_SESSION['reportQuery'] = " WHERE UserName='$username'";
	$_SESSION['reportType'] = "accountingGeneric";

	include 'library/closedb.php';

        include_once('include/management/userReports.php');
        userPlanInformation($username, 1);
        userSubscriptionAnalysis($username, 1);                 // userSubscriptionAnalysis with argument set to 1 for drawing the table
       	userConnectionStatus($username, 1);                     // userConnectionStatus (same as above)


	include 'library/opendb.php';

		//orig: used as maethod to get total rows - this is required for the pages_numbering.php page
		$sql = "SELECT ".$configValues['CONFIG_DB_TBL_RADACCT'].".RadAcctId, ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS'].
			".name as hotspot, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".UserName, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".FramedIPAddress, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctStartTime, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctStopTime, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctSessionTime, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctInputOctets, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctOutputOctets, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctTerminateCause, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".NASIPAddress FROM ".$configValues['CONFIG_DB_TBL_RADACCT'].
			" LEFT JOIN ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS'].
			" ON ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".calledstationid = ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS'].
			".mac WHERE UserName='$username';";
		$res = $dbSocket->query($sql);
		$numrows = $res->numRows();
		
		$sql = "SELECT ".$configValues['CONFIG_DB_TBL_RADACCT'].".RadAcctId, ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS'].
			".name as hotspot, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".UserName, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".FramedIPAddress, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctStartTime, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctStopTime, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctSessionTime, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctInputOctets, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctOutputOctets, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".AcctTerminateCause, ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".NASIPAddress FROM ".$configValues['CONFIG_DB_TBL_RADACCT'].
			" LEFT JOIN ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS'].
			" ON ".$configValues['CONFIG_DB_TBL_RADACCT'].
			".calledstationid = ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS'].
			".mac WHERE UserName='$username' ORDER BY $orderBy $orderType LIMIT $offset, $rowsPerPage;";
		$res = $dbSocket->query($sql);
		$logDebugSQL .= $sql . "\n";

		/* START - Related to pages_numbering.php */
		$maxPage = ceil($numrows/$rowsPerPage);	
		/* END */

		echo "<table border='0' class='table1'>\n";
		echo "
			<thead>
			<tr>
				<th colspan='12' align='left'>

			<input class='button' type='button' value='CSV Export'
			onClick=\"javascript:window.location.href='include/management/fileExport.php?reportFormat=csv'\"
			/>
			<br/>
			<br/>
		";


		if ($configValues['CONFIG_IFACE_TABLES_LISTING_NUM'] == "yes")
			setupNumbering($numrows, $rowsPerPage, $pageNum, $orderBy, $orderType,"&username=$username");

		echo " </th></tr></thead>";

		if ($orderType == "asc") {
			$orderTypeNextPage = "desc";
		} else  if ($orderType == "desc") {
			$orderTypeNextPage = "asc";
		}
		
		echo "<thread> <tr>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=radacctid&orderType=$orderTypeNextPage\">
			".$l['all']['ID']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=hotspot&orderType=$orderTypeNextPage\">
			".$l['all']['HotSpot']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=username&orderType=$orderTypeNextPage\">
			".$l['all']['Username']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=framedipaddress&orderType=$orderTypeNextPage\">
			".$l['all']['IPAddress']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=acctstarttime&orderType=$orderTypeNextPage\">
			".$l['all']['StartTime']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=acctstoptime&orderType=$orderTypeNextPage\">
			".$l['all']['StopTime']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=acctsessiontime&orderType=$orderTypeNextPage\">
			".$l['all']['TotalTime']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=acctinputoctets&orderType=$orderTypeNextPage\">
			".$l['all']['Upload']." (".$l['all']['Bytes'].")</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=acctoutputoctets&orderType=$orderTypeNextPage\">
			".$l['all']['Download']." (".$l['all']['Bytes'].")</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=acctterminatecause&orderType=$orderTypeNextPage\">
			".$l['all']['Termination']."</a>
			</th>
			<th scope='col'> 
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?username=$username&orderBy=nasipaddress&orderType=$orderTypeNextPage\">
			".$l['all']['NASIPAddress']."</a>
			</th>
			</tr> </thread>";
			
			while($row = $res->fetchRow()) {

				printqn("<tr>
						<td> $row[0] </td>
						<td> <a class='tablenovisit' href='javascript:return;'
								onClick='javascript:ajaxGeneric(\"include/management/retHotspotInfo.php\",\"retHotspotGeneralStat\",\"divContainerHotspotInfo\",\"hotspot=$row[1]\");
										javascript:__displayTooltip();'
								tooltipText='
										<a class=\"toolTip\" href=\"mng-hs-edit.php?name=$row[1]\">
												{$l['Tooltip']['HotspotEdit']}</a>
										&nbsp;
										<a class=\"toolTip\" href=\"acct-hotspot-compare.php?\">
												{$l['all']['Compare']}</a>
										<br/><br/>

										<div id=\"divContainerHotspotInfo\">
												Loading...
										</div>
										<br/>'
								>$row[1]</a>
						</td>

						<td> <a class='tablenovisit' href='javascript:return;'
								onClick='javascript:ajaxGeneric(\"include/management/retUserInfo.php\",\"retBandwidthInfo\",\"divContainerUserInfo\",\"username=$row[2]\");
										javascript:__displayTooltip();'
								tooltipText='
										<a class=\"toolTip\" href=\"mng-edit.php?username=$row[2]\">
											{$l['Tooltip']['UserEdit']}</a>
										<br/><br/>

										<div id=\"divContainerUserInfo\">
												Loading...
										</div>
										<br/>'
								>$row[2]</a>
						</td>

						<td> $row[3] </td>
						<td> $row[4] </td>
						<td> $row[5] </td>
						<td> ".time2str($row[6])." </td>
						<td> ".toxbyte($row[7])."</td>
						<td> ".toxbyte($row[8])."</td>
						<td> $row[9] </td>
						<td> $row[10] </td>
				</tr>");
	        }

		echo "
				<tfoot>
					<tr>
					<th colspan='12' align='left'>
	        ";
			
		setupLinks($pageNum, $maxPage, $orderBy, $orderType,"&username=$username");
		echo "
				</th>
				</tr>
			</tfoot>
			";

		echo "</table>";


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
