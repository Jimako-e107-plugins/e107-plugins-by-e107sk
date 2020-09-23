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

if (!defined('WARS_ADMIN')) {
    die ("You can't access this file directly...");
}

$wid = e107::getDb()->insert("clan_wars", array("status" => 0,"wardate" => -1,"opp_country" => "Unknown","active" => 0,"lastupdate" => time()));
header("Location: admin_old.php?EditWar&wid=$wid&new=1");
		
?>