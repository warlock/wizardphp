<?php
f("_open","","logoutform");
f("_hidden","action","logout");
f("_hidden","form_id","users");
print t('users','logged_with')." <b>".$user["mail"]."</b>";
/* ?> <b><a href="#" onclick="logoutform.submit()"><?php t('users','logout'); ?></a></b><br><?php */ 
f("_button","submit","users","logout");
f();
?>