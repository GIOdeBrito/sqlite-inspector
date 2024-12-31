<?php

require 'helpers/page_controller.php';

class HomeController extends PageController
{
	public static function index (): void
	{
		self::set_view('home.php');

		self::render();
	}
}

?>