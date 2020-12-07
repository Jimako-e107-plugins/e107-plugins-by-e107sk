<?php
//<li><a href="#"><img src="http://preview.byaviators.com/template/realsite/assets/img/flags/fr.png" alt="French"> French</a></li>

$ULFLAGS_TEMPLATE['version01']['start'] = "<ul class='header-topbar-links'>";; 
$ULFLAGS_TEMPLATE['version01']['body'] = '{ULF_LANGITEM:flagsize=16&flagtype=2}';
$ULFLAGS_TEMPLATE['version01']['end'] = '</ul>';
         
$ULFLAGS_TEMPLATE['version01']['item'] = "
<li> 
<form method='post' action='{ULF_ACTION}' style='display:inline;'>
  <p style='display:inline;'><input type='hidden' name='setlanguage' value='".USLFM_P_5."' />
  <input type='hidden' name='sitelanguage' value='{ULF_LANGVAL}' />
  <input type='image' style='display:inline' src='".e_PLUGIN."userlanguage_flags_menu/flags/{ULF_FLAGTYPE}/{ULF_LANGVAL}.png' 
  alt='{ULF_LANGVAL}' title='{ULF_LANGVAL}' width='{ULF_FLAGSIZE}' '> 
  <input type='submit' class='no-button'  style='display:inline' value='{ULF_LANGVAL}' title='{ULF_LANGVAL}' > 
  </p> 
</form>  
</li>
  
";             

?>

                                                         