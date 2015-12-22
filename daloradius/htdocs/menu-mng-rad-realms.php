
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

	<h3><?php echo $l['menu']['Realms Management'];?></h3>
	<ul class="subnav">

		<li><a href="mng-rad-realms-list.php"><b>&raquo;</b><?php echo $l['button']['ListRealms'] ?></a></li>
		<li><a href="mng-rad-realms-new.php"><b>&raquo;</b><?php echo $l['button']['NewRealm'] ?></a></li>
		<li><a href="javascript:document.mngradrealmedit.submit();""><b>&raquo;</b><?php echo $l['button']['EditRealm'] ?><a>
			<form name="mngradrealmedit" action="mng-rad-realms-edit.php" method="get" class="sidebar">
			<?php   
				include_once('include/management/populate_selectbox.php');
				populate_realms($l['menu']['Select Realms'],"realmname","generic");
			?>
			</form></li>

		<li><a href="mng-rad-realms-del.php"><b>&raquo;</b><?php echo $l['button']['RemoveRealm'] ?></a></li>
	</ul>


	<h3><?php echo $l['menu']['Proxys Management'];?></h3>
	<ul class="subnav">

		<li><a href="mng-rad-proxys-list.php"><b>&raquo;</b><?php echo $l['button']['ListProxys'] ?></a></li>
		<li><a href="mng-rad-proxys-new.php"><b>&raquo;</b><?php echo $l['button']['NewProxy'] ?></a></li>
		<li><a href="javascript:document.mngradproxyedit.submit();""><b>&raquo;</b><?php echo $l['button']['EditProxy'] ?><a>
			<form name="mngradproxyedit" action="mng-rad-proxys-edit.php" method="get" class="sidebar">
			<?php   
				populate_proxys($l['menu']['Select Proxy'],"proxyname","generic");
			?>
			</form></li>

		<li><a href="mng-rad-proxys-del.php"><b>&raquo;</b><?php echo $l['button']['RemoveProxy'] ?></a></li>
	</ul>

</div>
