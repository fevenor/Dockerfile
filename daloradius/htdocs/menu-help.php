 
<body>
<?php
    include_once ("lang/main.php");
?>

<div id="wrapper">
<div id="innerwrapper">

<?php
    $m_active = "Help";
    include_once ("include/menu/menu-items.php");
	include_once ("include/menu/help-subnav.php");
?>

<div id="sidebar">

	<h2><?php echo $l['menu']['Help'];?></h2>

	<h3><?php echo $l['menu']['Support'];?></h3>

	<p class="news">
		daloRADIUS version svn-trnk
		RADIUS Management 
		<a href="http://www.enginx.com" class="more"><?php echo $l['menu']['READ MORE'];?> &raquo;</a>
	</p>

</div>
		
