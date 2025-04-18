<?php

use App\Controllers\Api\Modals;

$router->addRoute('GET', '/api/v1/modal/:modal', [Modals::class, 'returnModalContent']);

/*
$router->add_route('GET', '/api/v1/database/alltables/', 'DatabaseController::get_table_names');

$router->add_route('GET', '/api/v1/maxuploadsize', function()
{
	$size = intval(ini_get('upload_max_filesize'));

	$size *= 1024 * 1024;

	echo json_encode([ 'size' => $size ]);
});

$router->add_route('GET', '/api/v1/time', function (Request $req, Response $res): void
{
	echo date('d/m/Y H:i');
});

$router->add_route('GET', '/api/v1/paramtest/:id', function (Request $req, Response $res): void
{
	var_dump($req->params);
});

$router->add_route('POST', '/api/v1/sendfile/test', function (Request $req, Response $res): void
{
	UploadController::handle_db_upload();
});
*/

?>