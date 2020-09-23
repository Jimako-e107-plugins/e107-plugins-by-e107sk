<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_ADMIN') or !preg_match("/admin_old\.php\?SaveMail/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

$mid = intval($_GET['mid']);
$tp = e107::getParser();
$uname = $tp->toDB($_GET['uname']);
$address = $tp->toDB($_GET['address']);

if($uname !="" && $address !=""){
	$result = e107::getDb()->update("clan_wars_mail", "member='$uname', email='$address' where mid='$mid'");
	print '1';		
}
	
?>