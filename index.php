<?php

/* Index file */

header('Access-Control-Allow-Methods: POST, GET');

session_start();
date_default_timezone_set('America/Fortaleza');

require 'src/core/autoloader.php';
require 'src/routes/routing.php';

?>