<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>daloRADIUS</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/1.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="css/form-field-tooltip.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" type="text/css" href="library/js_date/datechooser.css">
</head>
<script src="library/js_date/date-functions.js" type="text/javascript"></script>
<script src="library/js_date/datechooser.js" type="text/javascript"></script>
<script src="library/javascript/pages_common.js" type="text/javascript"></script>
<script src="library/javascript/rounded-corners.js" type="text/javascript"></script>
<script src="library/javascript/form-field-tooltip.js" type="text/javascript"></script>
 
<body>
<?php
include_once ("lang/main.php");
?>

<div id="wrapper">
<div id="innerwrapper">

<?php
	$m_active = "Reports";
	include_once ("include/menu/menu-items.php");
	include_once ("include/menu/reports-subnav.php");
        include_once("include/management/autocomplete.php");
?>      

		<div id="sidebar">
		
				<h2><?php echo $l['menu']['Reports'] ?></h2>
				
				<h3><?php echo $l['menu']['Users Reports'] ?></h3>
				<ul class="subnav">
				
						<li><a href="javascript:document.reponline.submit();"><b>&raquo;</b>
							<img src='images/icons/reportsOnlineUsers.gif' border='0'>
							<?php echo $l['button']['OnlineUsers'] ?></a>
							
							<form name="reponline" action="rep-online.php" method="get" class="sidebar">
								<input name="usernameOnline" type="text" id="usernameOnline"
				<?php if ($autoComplete) echo "autocomplete='off'"; ?>
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['Username']; ?> <br/> <?php echo $l['Tooltip']['UsernameWildcard'] ?> <br/>'
								value="<?php if (isset($usernameOnline)) echo $usernameOnline ?>" tabindex=1>
							</form>
							</li>							

                                                <li><a href="javascript:document.replastconnect.submit();"><b>&raquo;</b>
							<img src='images/icons/reportsLastConnection.png' border='0'>
							<?php echo $l['button']['LastConnectionAttempts'] ?></a>


							<form name="replastconnect" action="rep-lastconnect.php" method="get" class="sidebar">
								<input name="usernameLastConnect" type="text" id="usernameLastConnect"
				<?php if ($autoComplete) echo "autocomplete='off'"; ?>
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['Username']; ?> <br/> <?php echo $l['Tooltip']['UsernameWildcard'] ?> <br/>'
								value="<?php if (isset($usernameLastConnect)) echo $usernameLastConnect ?>" tabindex=2>
								<select class="generic" name="radiusreply" tabindex=3>
									<option value="Any"><?php echo $l['button']['Any']; ?></option>
									<option value="Access-Accept">Access-Accept</option>
									<option value="Access-Reject">Access-Reject</option>
								</select>
							<h4><?php echo $l['menu']['Start Date']; ?></h4>
							<img src="library/js_date/calendar.gif" 
								onclick="showChooser(this, 'startdate_lastconnect', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
							<input name="startdate" type="text" id="startdate_lastconnect" onClick='javascript:__displayTooltip();'
								tooltipText='<?php echo $l['Tooltip']['Date']; ?>'
							value="<?php if (isset($startdate)) echo $startdate;
							else echo date("Y-m-01"); ?>">
							<div id="chooserSpan" class="dateChooser select-free" 
								style="display: none; visibility: hidden; 	width: 160px;">
							</div>
							<h4><?php echo $l['menu']['End Date']; ?></h4>

							<img src="library/js_date/calendar.gif" 
								onclick="showChooser(this, 'enddate_lastconnect', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
							<input name="enddate" type="text" id="enddate_lastconnect" onClick='javascript:__displayTooltip();'
								tooltipText='<?php echo $l['Tooltip']['Date']; ?>'
								value="<?php if (isset($enddate)) echo $enddate;
							else echo date("Y-m-t"); ?>">
							<div id="chooserSpan" class="dateChooser select-free" 
								style="display: none; visibility: hidden; 	width: 160px;">
							</div>
							</form>
							</li>
							
							


						<li><a href="javascript:document.repnewusers.submit();"><b>&raquo;</b>
						<img src='images/icons/userList.gif' border='0'>
						<?php echo $l['button']['NewUsers'] ?></a>

						<form name="repnewusers" action="rep-newusers.php" method="get" class="sidebar">
							<h4><?php echo $l['menu']['Start Date']; ?></h4>
							<img src="library/js_date/calendar.gif" 
								onclick="showChooser(this, 'startdate', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
							<input name="startdate" type="text" id="startdate" onClick='javascript:__displayTooltip();'
								tooltipText='<?php echo $l['Tooltip']['Date']; ?>'
							value="<?php if (isset($startdate)) echo $startdate;
							else echo date("Y-01-01"); ?>">
							<div id="chooserSpan" class="dateChooser select-free" 
								style="display: none; visibility: hidden; 	width: 160px;">
							</div>
							<h4><?php echo $l['menu']['End Date']; ?></h4>
							<img src="library/js_date/calendar.gif" 
								onclick="showChooser(this, 'enddate', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
							<input name="enddate" type="text" id="enddate" onClick='javascript:__displayTooltip();'
								tooltipText='<?php echo $l['Tooltip']['Date']; ?>'
								value="<?php if (isset($enddate)) echo $enddate;
							else echo date("Y-m-t"); ?>">
							<div id="chooserSpan" class="dateChooser select-free" 
								style="display: none; visibility: hidden; 	width: 160px;">
							</div>
 						</form>
                        </li>
							
							
							
						<li><a href="javascript:document.topusers.submit();"><b>&raquo;</b>
							<img src='images/icons/reportsTopUsers.png' border='0'>
							<?php echo $l['button']['TopUser'] ?></a>
							<form name="topusers" action="rep-topusers.php" method="get" class="sidebar">
							<select class="generic" name="limit" type="text" tabindex=3>
								<option value="5"> 5 </option>
								<option value="10"> 10 </option>
								<option value="20"> 20 </option>
								<option value="50"> 50 </option>
								<option value="100"> 100 </option>
								<option value="500"> 500 </option>
								<option value="1000"> 1000 </option>
							</select>
			<h4><?php echo $l['Tooltip']['Username Filter']; ?></h4>
			<input name="username" type="text" id="username" 
			value="<?php if (isset($username)) echo $username; else echo "%"; ?>">
			<h4><?php echo $l['menu']['Start Date']; ?></h4>
			<img src="library/js_date/calendar.gif" 
				onclick="showChooser(this, 'startdate_topuser', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
			<input name="startdate" type="text" id="startdate_topuser" onClick='javascript:__displayTooltip();'
                     tooltipText='<?php echo $l['Tooltip']['Date']; ?>'
			value="<?php if (isset($startdate)) echo $startdate;
			else echo date("Y-m-01"); ?>">
			<div id="chooserSpan" class="dateChooser select-free" 
				style="display: none; visibility: hidden; 	width: 160px;">
			</div>
			
			<h4><?php echo $l['menu']['End Date']; ?></h4>
			<img src="library/js_date/calendar.gif" 
				onclick="showChooser(this, 'enddate_topuser', 'chooserSpan', 1950, <?= date('Y', time());?>, 'Y-m-d', false);">
			<input name="enddate" type="text" id="enddate_topuser" onClick='javascript:__displayTooltip();'
                     tooltipText='<?php echo $l['Tooltip']['Date']; ?>'
			value="<?php if (isset($enddate)) echo $enddate;
			else echo date("Y-m-t"); ?>">
			<div id="chooserSpan" class="dateChooser select-free" 
				style="display: none; visibility: hidden; 	width: 160px;">
			</div>
			<h4><?php echo $l['button']['Report By'] ?></h4>

							<select class="generic" name="orderBy" type="text" tabindex=4>
								<option value="Bandwidth"> <?php echo $l['button']['bandwidth']; ?> </option>
								<option value="Time"> <?php echo $l['button']['time']; ?> </option>
							</select>
							</form></li>
                                                <li><a href="rep-history.php"><b>&raquo;</b>
							<img src='images/icons/reportsHistory.png' border='0'>
							<?php echo $l['button']['History'] ?></a></li>
				</ul>
		
				
				<br/><br/>
				<h2><?php echo $l['menu']['Search']; ?></h2>
				<input name="" type="text" value="<?php echo $l['menu']['Search']; ?>" />
				
		
		</div>

<?php
        include_once("include/management/autocomplete.php");

        if ($autoComplete) {
                echo "<script type=\"text/javascript\">
                      autoComEdit = new DHTMLSuite.autoComplete();
                      autoComEdit.add('usernameOnline','include/management/dynamicAutocomplete.php','_small','getAjaxAutocompleteUsernames');
                      autoComEdit.add('usernameLastConnect','include/management/dynamicAutocomplete.php','_small','getAjaxAutocompleteUsernames');
                      </script>";
        }
?>

	
<script type="text/javascript">
        var tooltipObj = new DHTMLgoodies_formTooltip();
        tooltipObj.setTooltipPosition('right');
        tooltipObj.setPageBgColor('#EEEEEE');
        tooltipObj.setTooltipCornerSize(15);
        tooltipObj.initFormFieldTooltip();
</script>
