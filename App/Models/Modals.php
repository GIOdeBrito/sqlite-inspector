<?php

namespace App\Models;

class Modals
{
	public static function getContentByName (string $name)
	{
		switch($name)
		{
			case 'welcome': return 'Modals/welcome_content'; break;
		}
	}
}

?>