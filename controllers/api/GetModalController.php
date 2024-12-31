<?php

class GetModalController
{
	public static function return_modal_content ()
	{
		if(!isset($_GET['name']))
		{
			http_response_code(404);
			die();
		}

		$name = $_GET['name'];

		switch($name)
		{
			case 'welcome': require 'views/modals/welcome_content.php'; break;
		}

		die();
	}
}

?>