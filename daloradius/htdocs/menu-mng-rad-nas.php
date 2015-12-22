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
        include_once("include/management/autocomplete.php");
?>
		
<div id="sidebar">

	<h2><?php echo $l['menu']['Management']; ?></h2>
	
	<h3><?php echo $l['menu']['NAS Management']; ?></h3>
	<ul class="subnav">
	
		<li><a href="mng-rad-nas-list.php" tabindex=1><b>&raquo;</b><?php echo $l['button']['ListNAS'] ?></a></li>
		<li><a href="mng-rad-nas-new.php" tabindex=2><b>&raquo;</b><?php echo $l['button']['NewNAS'] ?></a></li>
		<li><a href="javascript:document.mngradnasedit.submit();" tabindex=3 ><b>&raquo;</b><?php echo $l['button']['EditNAS'] ?></a>
			<form name="mngradnasedit" action="mng-rad-nas-edit.php" method="get" class="sidebar">
			<input name="nashost" type="text" id="nashostEdit" <?php if ($autoComplete) echo "autocomplete='off'"; ?>
                                onClick='javascript:__displayTooltip();'
                                tooltipText='<?php echo $l['Tooltip']['NasName']; ?> <br/>'
			tabindex=4>
			</form></li>
		<li><a href="mng-rad-nas-del.php" tabindex=5><b>&raquo;</b><?php echo $l['button']['RemoveNAS'] ?></a></li>
		
	</ul>

</div>

<?php
        include_once("include/management/autocomplete.php");

        if ($autoComplete) {
                echo "<script type=\"text/javascript\">
                      autoComEdit = new DHTMLSuite.autoComplete();
                      autoComEdit.add('nashostEdit','include/management/dynamicAutocomplete.php','_small','getAjaxAutocompleteNASHost');
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

