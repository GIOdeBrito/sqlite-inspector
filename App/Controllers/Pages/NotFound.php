<?php

namespace App\Controllers\Pages;

use App\Helpers\Controller;
use App\Http\Request;
use App\Http\Response;

class NotFound extends Controller
{
	public static function index (Request $req, Response $res): void
	{
		$data = [
			'title' => '404'
		];

		$res->render('404', $data);
	}
}

?>