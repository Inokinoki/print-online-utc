<?php
// Application PATH is current path
define('APP_PATH', __DIR__ . '/');

// Debug mode
define('APP_DEBUG', false);

define('GET', 'GET');
if (APP_DEBUG){
    define('POST', 'GET');
} else {
    define('POST', 'POST');
}

// Load Fastphp
require(APP_PATH . 'fastphp/Fastphp.php');

// Load config
$config = require(APP_PATH . 'config/config.php');

// Run it!
(new Fastphp($config))->run();
?>