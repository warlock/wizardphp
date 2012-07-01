<?php
/*
	WizardPHP Framework
	Josep Subils Rigau - mail: jsubils@iberonline.com
	http://www.wizardphp.com
*/
include('tools/tools.php'); // Basic tools.
include('model/model.php'); // Configuration loader.
include('config/config.php'); // Configuration loader.
include('db/db.php'); // Autocreate tables in development mode.
include('trans/trans.php'); // Translation system.
include('user/user.php'); // User management.
include('post/post.php'); // POST catcher.
include('contr/contr.php'); // Controlers loader.
include('view/view.php'); // View loader.
start_wizard();
?>
