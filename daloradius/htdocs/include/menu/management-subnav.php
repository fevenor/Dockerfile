
				<ul id="subnav">
						<li><a href="mng-users.php"><?php echo $l['menu']['Users'];?></a></li>
						<li><a href="mng-batch.php"><?php echo $l['menu']['Batch Users'];?></a></li>
						<li><a href="mng-hs.php"><?php echo $l['menu']['Hotspots'];?></a></li>
						<li><a href="mng-rad-nas.php"><?php echo $l['menu']['Nas'];?></a></li>
                        <li><a href="mng-rad-usergroup.php"><?php echo $l['menu']['User-Groups'];?></a></li>
                         <li><a href="mng-rad-profiles.php"><?php echo $l['menu']['Profiles'];?></a></li>
						<li><a href="mng-rad-hunt.php"><?php echo $l['menu']['HuntGroups'];?></a></li>
						<li><a href="mng-rad-attributes.php"><?php echo $l['menu']['Attributes'];?></a></li>
						<li><a href="mng-rad-realms.php"><?php echo $l['menu']['Realms/Proxys'];?>	</a></li>
						<li><a href="mng-rad-ippool.php"><?php echo $l['menu']['IP-Pool'];?>	</a></li>

<div id="logindiv" style="text-align: right;">

                                                <li><?php echo $l['menu']['Location'];?>: <b><?php echo $_SESSION['location_name'] ?></b></li><br/>
						<li><?php echo $l['menu']['Welcome'];?>, <?php echo $operator; ?></li>
						<li><a href="logout.php">[<?php echo $l['menu']['logout'];?>]</a></li>
				</ul>
		
		</div>
