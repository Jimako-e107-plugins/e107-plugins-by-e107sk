<?php
/* $Id: e_search.php 11346 2010-02-17 18:56:14Z secretr $ */
if (!defined('e107_INIT')) { exit(); }

include_lan(CLAN_FORUM_LANGUAGES."/lan_forum_search.php");

$search_info[] = array(
	'sfile' => CLAN_FORUM_APP.'search/search_parser.php', 
	'qtype' => FOR_SCH_LAN_1, 
	'refpage' => CLAN_FORUM_FOLDER, 
	'advanced' => CLAN_FORUM_APP.'search/search_advanced.php', 
	'id' => CLAN_FORUM_FOLDER
	);

?>