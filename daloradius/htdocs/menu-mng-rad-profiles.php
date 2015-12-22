
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

	<h3><?php echo $l['menu']['Profiles Management']; ?></h3>
	<ul class="subnav">

		<li><a href="mng-rad-profiles-list.php"><b>&raquo;</b>
			<img src='images/icons/groupsList.png' border='0'>
			<?php echo $l['button']['ListProfiles'] ?></a></li>
		<li><a href="mng-rad-profiles-new.php"><b>&raquo;</b>
			<img src='images/icons/groupsAdd.png' border='0'>
			<?php echo $l['button']['NewProfile'] ?></a></li>
		<li><a href="javascript:document.mngradprofileedit.submit();""><b>&raquo;</b>
			<img src='images/icons/groupsEdit.png' border='0'>
			<?php echo $l['button']['EditProfile'] ?><a>
			<form name="mngradprofileedit" action="mng-rad-profiles-edit.php" method="get" class="sidebar">
			<?php   
				include 'include/management/populate_selectbox.php';
				populate_groups($l['menu']['Select Profile'],"profile","generic");
			?>
			</form></li>

		<li><a href="mng-rad-profiles-duplicate.php"><b>&raquo;</b>
			<img src='images/icons/groupsEdit.png' border='0'>
			<?php echo $l['button']['DuplicateProfile'] ?></a></li>

		<li><a href="mng-rad-profiles-del.php"><b>&raquo;</b>
			<img src='images/icons/groupsRemove.png' border='0'>
			<?php echo $l['button']['RemoveProfile'] ?></a></li>
	</ul>

</div>


<?php 
	include_once("include/management/autocomplete.php");

	if ($autoComplete) {
		echo "<script type=\"text/javascript\">
			/** Making usernameEdit interactive **/
	              autoComEdit = new DHTMLSuite.autoComplete();
              </script>";
	} 
?>