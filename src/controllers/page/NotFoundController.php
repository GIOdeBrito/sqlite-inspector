<?php

require_once 'src/helpers/page_controller.php';

class NotFoundController extends PageController
{
	public static function index (Request $req, Response $res): void
	{
		$res->render('404.php');
	}
}

?>