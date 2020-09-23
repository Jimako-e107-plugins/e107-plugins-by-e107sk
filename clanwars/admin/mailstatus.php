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

if (!defined('WARS_ADMIN') or !preg_match("/admin_old\.php\?MailStatus/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

$mid = intval($_GET['mid']);
$status = intval($_GET['status']);

if($mid > 0 ){
	e107::getDb()->update("clan_wars_mail", "active='".(($status)?0:1)."', code='' WHERE mid='$mid'");					
	print '1';	
}
	
?>