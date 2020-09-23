<?php 

if(strpos(e_REQUEST_URI,'clanmembers') !== false) {
 if(ADMIN_AREA ) {
  e107::css('clanmembers', 'css/admin.css');
 }
   
  else {
    e107::css('clanmembers', 'css/frontend.css');
  }
}

?>