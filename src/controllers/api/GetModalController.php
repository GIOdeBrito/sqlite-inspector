<?php

class GetModalController
{
	public static function return_modal_content (Request $req, Response $res)
	{
		if(!isset($_GET['name']))
		{
			http_response_code(404);
			die();
		}

		$name = $_GET['name'];

		switch($name)
		{
			case 'welcome': require 'src/views/modals/welcome_content.php'; break;
		}

		die();
	}
}

?>