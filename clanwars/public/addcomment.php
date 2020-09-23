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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "addcomment.php")) {
    die ("You can't access this file directly...");
}

$wid = intval($_GET['wid']);                
$tp = e107::getParser();

$comment = $tp->toDB($_GET['comment']);

if($comment !="" && USERID !=""){
	$posttime = time();
	$result = e107::getDb()->insert("clan_wars_comments", array("wid" => $wid, "poster" => USERID, "comment" => $comment, "postdate" => time()));
	if(intval($result) > 0) echo $result;
}

?>