<?php    
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 Disqus Plugin
 *
 * #######################################
 * #     e107 website system plugin      #
 * #     by Jimako                    	 #
 * #     https://www.e107sk.com          #
 * #######################################
 */

// Warning. This way works only until they don't forbid it. It is not officially supported. API should be used.


if (!defined('e107_INIT')) { exit; }

$text = "";

$parm = eHelper::scParams($parm);
 
if(isset($parm['block_title'][e_LANGUAGE]))
{
	$caption = $parm['block_title'][e_LANGUAGE];
}
else $caption = $parm['block_title'];   
  
$forum_shortname = e107::pref('disqus', 'forum_shortname'  );

$limit            = varset($parm['block_num_items'], 10); 
$hide_avatars     = varset($parm['block_hide_avatars'], 0); 
$avatar_size      = varset($parm['block_avatar_size'], 40); 
$excerpt_length   = varset($parm['block_excerpt_length'], 200);
 
$text =  '<script type="text/javascript" src="https://'.$forum_shortname.'.disqus.com/recent_comments_widget.js?num_items='.$limit.'&hide_avatars='.$hide_avatars.'&avatar_size='.$avatar_size.'&excerpt_length='.$excerpt_length.'"></script>';

$styleid =  $parm['block_tablestyle']; 
        
$s = $parm['block_style'];     
                        
if(is_string($s) && strlen($s) > 0) 
{
   e107::getRender()->setStyle($s);
}                                           
e107::getRender()->tablerender($caption, $text,  $styleid);
