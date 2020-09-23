<?php 

if(strpos(e_REQUEST_URI,'clanwars') !== false) {
 if(ADMIN_AREA ) {
  e107::css('clanwars', 'css/admin.css');
 }
   
  else {
    e107::css('clanwars', 'css/frontend.css');
  }
}

?>