<?php
// Configuration template — copy to config.php and fill in real values.
// NEVER commit config.php to git.

define('DB_HOST', 'localhost');            // local: localhost | server: sql309.epizy.com
define('DB_USER', 'your_db_user');         // local: root | server: epiz_XXXXXXXX
define('DB_PASS', 'your_db_password');     // local: '' (empty) | server: your password
define('DB_NAME', 'your_db_name');         // local: railcon | server: epiz_XXXXXXXX_railcon

define('SMTP_HOST',      'smtp.gmail.com');
define('SMTP_USERNAME',  'your_email@gmail.com');
define('SMTP_PASSWORD',  'your_16char_app_password'); // Google App Password
define('SMTP_PORT',      587);
define('SMTP_FROM',      'your_email@gmail.com');
define('SMTP_FROM_NAME', 'Your App Name');
