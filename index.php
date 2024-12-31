<?php

/* Index file */

header('Access-Control-Allow-Methods: POST, GET');

require 'core/autoloader.php';
require 'routes/routing.php';

session_start();

date_default_timezone_set('America/Fortaleza');

?>