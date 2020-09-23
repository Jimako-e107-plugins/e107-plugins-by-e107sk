<?php
if (!defined('e107_INIT')) { exit; }

$forum_posts = $sql -> db_Count(CLAN_FORUM_THREAD_NOPREFIX);
$text .= "<div style='padding-bottom: 2px;'>".E_16_FORUM." ".ADLAN_113.": ".$forum_posts."</div>";
?>