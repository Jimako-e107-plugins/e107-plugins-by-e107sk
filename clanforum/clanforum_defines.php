<?php
if (!defined('e107_INIT')) { exit; }
 
if (!defined(("CLAN_FORUM_TABLE"))) { define("CLAN_FORUM_TABLE", "#clanforum"); } 
if (!defined(("CLAN_FORUM_THREAD"))) { define("CLAN_FORUM_THREAD", "#clanforum_t"); } 

/* without # */
if (!defined(("CLAN_FORUM_TABLE_NOPREFIX"))) { define("CLAN_FORUM_TABLE_NOPREFIX", "clanforum"); } 
if (!defined(("CLAN_FORUM_THREAD_NOPREFIX"))) { define("CLAN_FORUM_THREAD_NOPREFIX", "clanforum_t"); }


define("CLAN_FORUM_APP", e_PLUGIN.'clanforum/');
define("CLAN_FORUM_APP_ABS", e_PLUGIN_ABS.'clanforum/');
define("CLAN_FORUM_LANGUAGES", e_PLUGIN.'clanforum/languages/'.e_LANGUAGE.'/');
define("CLAN_FORUM_FOLDER",  'clanforum');     //=plugin name
define("CLAN_FORUM_ADMINFILE",  'forum_admin.php');
define("CLAN_FORUM_SITEURL",  CLAN_FORUM_APP.'forum.php' );
define("CLAN_FORUM_FORUMCLASS",  CLAN_FORUM_APP.'forum_class.php' );

// to avoid word 'forum' during replacement
define("CLAN_FORUM_TIMEFORMAT",  "forum" );



 
