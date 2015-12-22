
                                <ul id="subnav">
                                                <li><a href="acct-main.php"><?php echo $l['menu']['General'];?></a></li>
                                                <li><a href="acct-plans.php"><?php echo $l['menu']['Plans'];?></a></li>
                                                <li><a href="acct-custom.php"><?php echo $l['menu']['Custom'];?></a></li>
                                                <li><a href="acct-hotspot.php"><?php echo $l['menu']['Hotspot'];?></a></li>
                                                <li><a href="acct-maintenance.php"><?php echo $l['menu']['Maintenance'];?></a></li>

<div id="logindiv" style="text-align: right;">

                                                <li><?php echo $l['menu']['Location'];?>: <b><?php echo $_SESSION['location_name'] ?></b></li><br/>
                                                <li><?php echo $l['menu']['Welcome'];?>, <?php echo $operator; ?></li>
                                                <li><a href="logout.php">[<?php echo $l['menu']['logout'];?>]</a></li>
                                </ul>

                </div>

