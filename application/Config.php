<?php
define('BASE_URL', 'http://wzd.phpfogapp.com/');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'default');

define('APP_NAME','Wizard');
define('APP_SLOGAN','My application');
define('APP_COMPANY','app company');

define('SESSION_TIME', 20);
define('DEFAULT_ROLE', 'user');
define('HASH_KEY','4f6a6d832be79');

define('DB_HOST', getenv('MYSQL_DB_HOST'));
define('DB_USER', getenv('MYSQL_USERNAME'));
define('DB_PASS', getenv('MYSQL_PASSWORD'));
define('DB_NAME', getenv('MYSQL_DB_NAME'));
define('DB_CHAR', 'utf8');
?>