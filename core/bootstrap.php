<?php
// 1. Define a ROOT constant
define('ROOT', '/var/www/example.com');

//2. Call common files
require ROOT . '/core/session.php';
require ROOT . '/config/keys.php';