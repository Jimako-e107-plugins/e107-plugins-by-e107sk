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

function canaddwars(){
	global $conf;
	if(USER){
    if(e107::getUser()->checkClass($conf['addwarlist'], false)) {
     return true;
    }
  }
}

function canlineup($id = 0, $wholineup = 0){
	global $conf;
	$sqlf = e107::getDb();
	if(USER && $sqlf->count($conf['tablename'], "(*)", "WHERE ".$conf['fieldname']."='".USERNAME."' or ".$conf['fieldname']."='".USERID."'")>0){
		if($conf['tablename'] == "clan_members_info" && $conf['fieldname'] == "userid" && $wholineup > 0){
			if($wholineup == 1 && $id > 0){
				if($sqlf->count("clan_members_teamlink", "(*)", "WHERE userid='".USERID."' AND tid='$id'")>0)
				return true;
			}elseif($wholineup == 2 && $id > 0){
				if($sqlf->count("clan_members_gamelink", "(*)", "WHERE userid='".USERID."' AND gid='$id'")>0)
				return true;
			}
		}else{
			return true;
		}
	}
	return false;
}
function cansubscribe(){
	global $conf;
	$sqlf = e107::getDb();
	if(USER && $sqlf->count($conf['tablename'], "(*)", "WHERE ".$conf['fieldname']."='".USERNAME."' or ".$conf['fieldname']."='".USERID."'")>0){
		return true;
	}
	return false;
}
function canviewserver(){
	return cansubscribe();
}

function cw_getuser_name($userid){
	$sqlf = e107::getDb();
	$user_name = $sqlf->retrieve("user", "user_name", "user_id='$userid'");
	return $user_name;
}

function cw_getuser_id($username){
	$sqlf = e107::getDb();
	$user_id  =  $sqlf->retrieve("user", "user_id", "user_name='$username'");
	return $user_id;
}

function multisort($array, $sort_by, $key1, $key2=NULL, $key3=NULL){
     // sort by ?
     foreach ($array as $pos =>  $val)
         $tmp_array[$pos] = $val[$sort_by];
     asort($tmp_array);
     
    // display however you want
     foreach ($tmp_array as $pos =>  $val){
         $return_array[$pos][$sort_by] = $array[$pos][$sort_by];
         $return_array[$pos][$key1] = $array[$pos][$key1];
         if (isset($key2)){
             $return_array[$pos][$key2] = $array[$pos][$key2];
             }
         if (isset($key3)){
             $return_array[$pos][$key3] = $array[$pos][$key3];
             }
         }
     return $return_array;
     }
 
?>