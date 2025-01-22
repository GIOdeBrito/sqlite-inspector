<?php

require_once 'src/helpers/page_controller.php';

class HomeController extends PageController
{
	public static function index (Request $req, Response $res): void
	{
		$res->render('home');
	}
}

?>