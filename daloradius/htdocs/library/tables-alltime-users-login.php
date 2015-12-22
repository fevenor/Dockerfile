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
 * Description:
 *		this graph extension procduces a query of the alltime logins made by all users on a daily, monthly and yearly basis.
 *
 * Authors:	Liran Tal <liran@enginx.com>
 *
 *********************************************************************************************************
 */
 
if ($type == "daily") {
	daily($orderBy, $orderType);
} elseif ($type == "monthly") {
	monthly($orderBy, $orderType);
} elseif ($type == "yearly") {
	yearly($orderBy, $orderType);
}



function daily($orderBy, $orderType) {

	include 'opendb.php';

	$sql = "SELECT count(username) AS numberoflogins, day(AcctStartTime) AS day from ".$configValues['CONFIG_DB_TBL_RADACCT'].
			" GROUP BY day ORDER BY $orderBy $orderType;";
	$res = $dbSocket->query($sql);

	$total_logins = 0;		// initialize variables
	$count = 0;			

	$array_logins = array();
	$array_days = array();



	while($row = $res->fetchRow()) {

		// The table that is being procuded is in the format of:
		// +--------+------+
		// | Logins/Hits | Day  |
		// +--------+------+

		$logins = $row[0];	// total logins on that specific day
		$day = $row[1];		// day of the month [1-31]

		$total_logins = $total_logins + $logins;
		$count = $count + 1;

		array_push($array_logins, "$logins");
		array_push($array_days, "$day");

    }
	
	echo "<br/><br/>";

	echo "<table border='0' class='table1'>\n";
	echo "
		<thead>
			<tr>
				<th colspan='10'>All-time Logins/Hits statistics</th>
			</tr>
		</thead>
	";
	
	echo "
		<thread> <tr>
			<th scope='col'> Logins/Hits count
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=daily&orderBy=numberoflogins&orderType=asc\"> > </a>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=daily&orderBy=numberoflogins&orderType=desc\"> < </a>
			</th>
			<th scope='col'> Day of month
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=daily&orderBy=day&orderType=asc\"> > </a>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=daily&orderBy=day&orderType=desc\"> < </a>
			</th>
			</tr> </thread>
	";

	$i=0;
	foreach ($array_days as $a_day) {
		echo "<tr>
			<td> $array_logins[$i] </td>
			<td> $a_day </td>
			</tr>
		";
		$i++;
	}


	echo "<tr> <td> <b> $total_logins </b> </td> </tr>";
	echo "</table>";

	include 'closedb.php';
}





function monthly($orderBy, $orderType) {

	include 'opendb.php';

	$sql = "SELECT count(username) as numberoflogins, monthname(AcctStartTime) AS month from ".
			$configValues['CONFIG_DB_TBL_RADACCT']." group by month ORDER BY $orderBy $orderType;";
	$res = $dbSocket->query($sql);

	$total_logins = 0;		// initialize variables
	$count = 0;			

	$array_logins = array();
	$array_months = array();

	while($row = $res->fetchRow()) {

		// The table that is being procuded is in the format of:
		// +--------+--------+
		// | Logins/Hits | Month  |
		// +--------+--------+

		$logins = $row[0];	// total logins on that specific month
		$month = $row[1];	// Month of year [1-12]

		$total_logins = $total_logins + $logins;
		$count = $count + 1;

		array_push($array_logins, "$logins");
		array_push($array_months, "$month");
	}
	
	echo "<br/><br/>";
	echo "<table border='0' class='table1'>\n";
	echo "
		<thead>
			<tr>
				<th colspan='10'>All-time Logins/Hits statistics</th>
			</tr>
		</thead>
	";
	echo "
		<thread> <tr>
			<th scope='col'> Logins/Hits count
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=monthly&orderBy=numberoflogins&orderType=asc\"> > </a>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=monthly&orderBy=numberoflogins&orderType=desc\"> < </a>
			</th>
			<th scope='col'> Month of year
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=monthly&orderBy=month&orderType=asc\"> > </a>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=monthly&orderBy=month&orderType=desc\"> < </a>
			</th>
		</tr> </thread>
	";

	$i=0;
	foreach ($array_months as $a_month) {
		echo "<tr>
			<td> $array_logins[$i] </td>
			<td> $a_month </td>
			</tr>
		";
		$i++;
	}

	echo "<tr> <td> <b> $total_logins </b> </td> </tr>";
	echo "</table>";

	include 'closedb.php';
}








function yearly($orderBy, $orderType) {

	include 'opendb.php';

	$sql = "SELECT count(username) AS numberoflogins, year(AcctStartTime) AS year from ".
			$configValues['CONFIG_DB_TBL_RADACCT']." GROUP BY year ORDER BY $orderBy $orderType;";
	$res = $dbSocket->query($sql);

	$total_logins = 0;		// initialize variables
	$count = 0;			

	$array_logins = array();
	$array_years = array();

	while($row = $res->fetchRow()) {

		// The table that is being procuded is in the format of:
		// +--------+-------+
		// | Logins/Hits | Year  |
		// +--------+-------+

		$logins = $row[0];	// total logins on that specific month
		$year = $row[1];	// Year

		$total_logins = $total_logins + $logins;
		$count = $count + 1;

		array_push($array_logins, "$logins");
		array_push($array_years, "$year");

	}
        echo "<br/><br/>";



	echo "<table border='0' class='table1'>\n";
	echo "
		<thead>
			<tr>
				<th colspan='10'>All-Time Logins/Hits statistics</th>
			</tr>
		</thead>
	";
	
	echo "<thread> <tr>
			<th scope='col'> Logins/Hits count</th>
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=yearly&orderBy=numberoflogins&orderType=asc\"> > </a>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=yearly&orderBy=numberoflogins&orderType=desc\"> < </a>
			</th>
			<th scope='col'> Year </th>
			<br/>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=yearly&orderBy=year&orderType=asc\"> > </a>
			<a class='novisit' href=\"" . $_SERVER['PHP_SELF'] . "?type=yearly&orderBy=year&orderType=desc\"> < </a>
			</th>
		</tr> </thread>
	";

	$i=0;
	foreach ($array_years as $a_year) {
			echo "<tr>
					<td> $array_logins[$i]</td>
					<td> $a_year </td>
				</tr>";
			$i++;
	}


	echo "<tr> <td> <b> $total_logins </b> </td> </tr>";
	echo "</table>";

	include 'closedb.php';
}


?>
