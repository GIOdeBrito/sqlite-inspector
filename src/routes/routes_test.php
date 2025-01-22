<?php

$router->add_route('GET', '/api/v1/time', function (Request $req, Response $res)
{
	echo date('d/m/Y H:i');
});

$router->add_route('GET', '/api/v1/paramtest/:id', function (Request $req, Response $res)
{
	var_dump($req);
});

$router->add_route('GET', '/api/v1/dump', function (Request $req, Response $res)
{
	var_dump($req);
});

/*$router->add_route('POST', '/api/v1/sendfile/test', function ()
{
	UploadController::handle_db_upload();
});*/

?>