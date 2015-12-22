
                                <ul id="subnav">

					<li><a href="config-main.php"><?php echo $l['menu']['General'];?></a></li>
					<li><a href="config-reports.php"><?php echo $l['menu']['Reporting'];?></a></li>
					<li><a href="config-maint.php"><?php echo $l['menu']['Maintenance'];?></a></li>
					<li><a href="config-operators.php"><?php echo $l['menu']['Operators'];?></a></li>
					<li><a href="config-backup.php"><?php echo $l['menu']['Backup'];?></a></li>
				<div id="logindiv" style="text-align: right;">
                                                <li><?php echo $l['menu']['Location'];?>: <b><?php echo $_SESSION['location_name'] ?></b></li><br/>
                                                <li><?php echo $l['menu']['Welcome'];?>, <?php echo $operator; ?></li>
                                                <li><a href="logout.php">[<?php echo $l['menu']['logout'];?>]</a></li>
                                </ul>

                </div>
	
