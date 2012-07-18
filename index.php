<?php
/*
	WizardPHP Framework
	Josep Subils Rigau - mail: jsubils@iberonline.com
	http://www.wizardphp.com
*/
include('wizard/tools/tools.php'); // Basic tools.
include('wizard/model/model.php'); // Configuration loader.
include('wizard/config/config.php'); // Configuration loader.
include('wizard/db/db.php'); // Autocreate tables in development mode.
include('wizard/trans/trans.php'); // Translation system.
include('wizard/user/user.php'); // User management.
include('wizard/post/post.php'); // POST catcher.
include('wizard/contr/contr.php'); // Controlers loader.
include('wizard/view/view.php'); // View loader.
start_wizard();
?>