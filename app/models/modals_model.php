<?php

class ModalsModel
{
	public static function get_content_by_name (string $name)
	{
		switch($name)
		{
			case 'welcome': return 'modals/welcome_content'; break;
		}
	}
}

?>