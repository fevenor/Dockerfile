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
 *              Database naming conventions for table fields.
 * 		Required for easier customization and adoption between FR1.x to FR2.x
 *
 *********************************************************************************************************
 */

// Syntax:
// $row['TABLE']['FIELD'] = 'mysql';

if (isset($configValues['FREERADIUS_VERSION']) && ($configValues['FREERADIUS_VERSION'] == '2')) {
	$row['postauth']['user'] = 'username';
	$row['postauth']['date'] = 'authdate';
} elseif (isset($configValues['FREERADIUS_VERSION']) && ($configValues['FREERADIUS_VERSION'] == '1')) {
	$row['postauth']['user'] = 'user';
	$row['postauth']['date'] = 'date';
}
