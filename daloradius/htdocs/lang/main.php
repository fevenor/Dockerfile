<?php
/*
 *********************************************************************************************************
 * daloRADIUS - RADIUS Web Platform
 * Copyright (C) 2007 - Liran Tal <liran@enginx.com> All Rights Reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *********************************************************************************************************
 * Description:
 *		Main language file control
 *
 * Authors:	Liran Tal <liran@enginx.com>
 *
 *********************************************************************************************************
 */

	include_once('library/config_read.php');

	switch($configValues['CONFIG_LANG']) {

		case "English":
			include ("lang/en.php");
			break;
		case "Russian":
			include ("lang/ru.php");
			break;
		case "Hungarian":
			include ("lang/hu.php");
			break;
		case "Italian":
			include ("lang/it.php");
			break;
		case "Chinese":
			include ("lang/zh-cn.php");
			break;
		default:
			include ("lang/en.php");
			break;
	}

?>
