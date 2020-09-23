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

/*
<script id="dsq-count-scr" src="//e107sk.disqus.com/count.js" async></script>
*/   
$hide_poweredby = e107::pref('disqus', 'hide_poweredby');
 
if (!ADMIN_AREA) {
 e107::js('disqus', 'js/jquery.disqusloader.js', 'jquery');
}

if (!ADMIN_AREA && $hide_poweredby ) {  
  $css = '
  #dsq-combo-logo {
      visibility: hidden;
      display: none;
  }
  ';
  
  e107::css('inline', $css);
}
 