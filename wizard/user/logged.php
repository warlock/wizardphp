<?php
mkform("_open","","logoutform");
mkform("_hidden","action","logout");
mkform("_hidden","form_id","users");
print t('users','logged_with')." <b>".$user["mail"]."</b>";
/* ?> <b><a href="#" onclick="logoutform.submit()"><?php t('users','logout'); ?></a></b><br><?php */ 
mkform("_button","submit","users","logout");
mkform();
?>