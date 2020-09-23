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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "savecomment.php")) {
    die ("You can't access this file directly...");
}

$cid = intval($_GET['cid']);
$wid = intval($_GET['wid']);

$tp = e107::getParser();

$comment = $tp->toDB($_GET['comment']);

if($comment !="" && USERID !=""){
	$result = e107::getDb()->update("clan_wars_comments", "comment='$comment' WHERE cid='$cid' AND wid='$wid' AND poster='".USERID."'");						
	if($result){
		print '1';		
	}
}

		
?>