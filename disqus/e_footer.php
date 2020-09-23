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
$activate_counts = e107::pref('disqus', 'activate_counts'  );

if (!ADMIN_AREA && $activate_counts ) {
  $forum_shortname = e107::pref('disqus', 'forum_shortname'  );
  $url = "//".$forum_shortname.".disqus.com/count.js";
  //e107::js('footer', $url, 'jquery');
  $code = '
  <script id="dsq-count-scr" src="//'.$url.'disqus.com/count.js" ></script>';
  echo  $code;
  $code = '
  DISQUSWIDGETS.getCount({reset: true}); ';
  e107::js('footer-inline', $code);
}