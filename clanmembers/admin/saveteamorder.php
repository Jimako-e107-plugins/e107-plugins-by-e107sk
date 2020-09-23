<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
/******  REPLACE OLD GLOBALS END  *********************************************/


$neworder = $_GET['neworder'];
if($neworder !=""){
	$neworder = explode("(amp)",$neworder);
	
	for($i=1;$i<=count($neworder);$i++){
		$result = $sql->update("clan_teams", "position='$i' WHERE tid='".$neworder[$i-1]."'");
	}

}
?>