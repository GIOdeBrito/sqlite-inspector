<?php

namespace App\Controllers\Pages;

use App\Helpers\Controller;
use App\Http\Request;
use App\Http\Response;

class Home extends Controller
{
	public static function index (Request $req, Response $res): void
	{
		$data = [
			'title' => 'Home',
			'scripts' => [],
			'styles' => []
		];

		$res->render('home', $data);
	}
}

?>