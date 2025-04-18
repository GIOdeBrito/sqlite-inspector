<?php

/* Index file */

header('Access-Control-Allow-Methods: POST, GET');

session_start();
date_default_timezone_set('America/Fortaleza');

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'app/core/autoloader.php';
require 'app/routes/routing.php';

?>