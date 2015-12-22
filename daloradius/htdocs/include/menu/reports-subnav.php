
                                <ul id="subnav">

                                                <li><a href="rep-main.php"><?php echo $l['menu']['General']; ?></a></li>
                                                <li><a href="rep-logs.php"><?php echo $l['menu']['Logs']; ?></a></li>
                                                <li><a href="rep-status.php"><?php echo $l['menu']['Status']; ?></a></li>
												<li><a href="rep-batch.php"><?php echo $l['menu']['Batch Users']; ?></a></li>
												<li><a href="rep-hb.php"><?php echo $l['menu']['Dashboard']; ?></a></li>

<div id="logindiv" style="text-align: right;">

                                                <li><?php echo $l['menu']['Location'];?>: <b><?php echo $_SESSION['location_name'] ?></b></li><br/>
                                                <li><?php echo $l['menu']['Welcome'];?>, <?php echo $operator; ?></li>
                                                <li><a href="logout.php">[<?php echo $l['menu']['logout'];?>]</a></li>
                                </ul>

                </div>
