<?php

require 'helpers/router.php';

$router = new Router();

require 'routes/web_pages.php';

require 'routes/web_test.php';
require 'routes/web_get.php';
require 'routes/web_database.php';

$router->handle_request();

?>