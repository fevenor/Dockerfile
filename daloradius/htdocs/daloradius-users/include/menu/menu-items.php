                <div id="header">

                                <form action="">
                                <input value="<?php echo $l['menu']['Search']; ?>" />
                                </form>

                                <h1><a href="index.php"> <img src="images/daloradius_small.png" border=0/></a></h1>

                                <h2>
                                
                                <? echo $l['all']['copyright1']; ?>
                                
				                                </h2>

                                <ul id="nav">
				<a name='top'></a>

				<li><a href="index.php" <?php echo ($m_active == "Home") ? "class=\"active\"" : ""?>><?php echo $l['menu']['Home']; ?></a></li>
				<li><a href="pref-main.php" <?php echo ($m_active == "Preferences") ? "class=\"active\"" : ""?>><?php echo $l['menu']['Preferences']; ?></li>
				<li><a href="acct-main.php" <?php echo ($m_active == "Accounting") ? "class=\"active\"" : "" ?>><?php echo $l['menu']['Accounting']; ?></a></li>
				<li><a href="billing-main.php" <?php echo ($m_active == "Billing") ? "class=\"active\"" : "" ?>><?php echo $l['menu']['Billing']; ?></a></li>
				<li><a href="graph-main.php" <?php echo ($m_active == "Graphs") ? "class=\"active\"" : ""?>><?php echo $l['menu']['Graphs']; ?></li>

                                </ul>

