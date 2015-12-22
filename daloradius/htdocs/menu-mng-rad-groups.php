<script src="library/javascript/rounded-corners.js" type="text/javascript"></script>
<script src="library/javascript/form-field-tooltip.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/form-field-tooltip.css" type="text/css" media="screen,projection" />

<body>
<?php
    include_once ("lang/main.php");
?>
<div id="wrapper">
<div id="innerwrapper">

<?php
    $m_active = "Management";
    include_once ("include/menu/menu-items.php");
	include_once ("include/menu/management-subnav.php");
?>

<div id="sidebar">

	<h2><?php echo $l['menu']['Management']; ?></h2>

	<h3>Group Reply Management</h3>
	<ul class="subnav">

		<li><a href="mng-rad-groupreply-list.php"><b>&raquo;</b>
			<img src='images/icons/groupsList.png' border='0'>
			<?php echo $l['button']['ListGroupReply'] ?></a></li>
		<li><a href="javascript:document.mngradgroupreplysearch.submit();""><b>&raquo;</b>
			<img src='images/icons/groupsList.png' border='0'>
			<?php echo $l['button']['SearchGroupReply'] ?><a>
			<form name="mngradgroupreplysearch" action="mng-rad-groupreply-search.php" method="get" 
				class="sidebar">
			<input name="groupname" type="text" 
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['GroupName']; ?> <br/>'
				value="<?php if (isset($search_groupname)) echo $search_groupname; ?>" tabindex=2>
			</form></li>

		<li><a href="mng-rad-groupreply-new.php"><b>&raquo;</b>
			<img src='images/icons/groupsAdd.png' border='0'>
			<?php echo $l['button']['NewGroupReply'] ?></a></li>
		<li><a href="javascript:document.mngradgrprplyedit.submit();""><b>&raquo;</b>
			<img src='images/icons/groupsEdit.png' border='0'>
			<?php echo $l['button']['EditGroupReply'] ?><a>
			<form name="mngradgrprplyedit" action="mng-rad-groupreply-edit.php" method="get" class="sidebar">
			<input name="groupname" type="text" value=""
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['GroupName']; ?> <br/>'
				/>
			<input name="attribute" type="text" value=""
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['AttributeName']; ?> <br/>'
				/>
			</form></li>
		<li><a href="mng-rad-groupreply-del.php"><b>&raquo;</b>
			<img src='images/icons/groupsRemove.png' border='0'>
			<?php echo $l['button']['RemoveGroupReply'] ?></a></li>
		
	</ul>

	<h3>Group Check Management</h3>
	<ul class="subnav">

		<li><a href="mng-rad-groupcheck-list.php"><b>&raquo;</b>
			<img src='images/icons/groupsList.png' border='0'>
			<?php echo $l['button']['ListGroupCheck'] ?></a></li>
		<li><a href="javascript:document.mngradgroupchecksearch.submit();""><b>&raquo;</b>
			<img src='images/icons/groupsList.png' border='0'>
			<?php echo $l['button']['SearchGroupCheck'] ?><a>
			<form name="mngradgroupchecksearch" action="mng-rad-groupcheck-search.php" method="get" 
				class="sidebar">
			<input name="groupname" type="text" 
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['GroupName']; ?> <br/>'
				value="<?php if (isset($search_groupname)) echo $search_groupname; ?>" tabindex=2>
			</form></li>

		<li><a href="mng-rad-groupcheck-new.php"><b>&raquo;</b>
			<img src='images/icons/groupsAdd.png' border='0'>
			<?php echo $l['button']['NewGroupCheck'] ?></a></li>
		<li><a href="javascript:document.mngradgrpchkedit.submit();""><b>&raquo;</b>
			<img src='images/icons/groupsEdit.png' border='0'>
			<?php echo $l['button']['EditGroupCheck'] ?><a>
			<form name="mngradgrpchkedit" action="mng-rad-groupcheck-edit.php" method="get" class="sidebar">
			<input name="groupname" type="text" value=""
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['GroupName']; ?> <br/>'
				/>
			<input name="attribute" type="text" value=""
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['AttributeName']; ?> <br/>'
				/>
			</form></li>
		<li><a href="mng-rad-groupcheck-del.php"><b>&raquo;</b>
			<img src='images/icons/groupsRemove.png' border='0'>
			<?php echo $l['button']['RemoveGroupCheck'] ?></a></li>
		
	</ul>

</div>

<script type="text/javascript">
        var tooltipObj = new DHTMLgoodies_formTooltip();
        tooltipObj.setTooltipPosition('right');
        tooltipObj.setPageBgColor('#EEEEEE');
        tooltipObj.setTooltipCornerSize(15);
        tooltipObj.initFormFieldTooltip();
</script>

