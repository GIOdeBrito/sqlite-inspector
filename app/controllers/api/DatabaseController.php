<?php

require 'src/helpers/database.php';

class DatabaseController
{
	public static function get_table_names (Request $req, Response $res): void
	{
		$dbpath = glob('../uploads/*.db');

		if(count($dbpath) === 0)
		{
			die();
		}

		$db = new Database($dbpath[0]);

		$result = $db->query('SELECT name FROM sqlite_master where type = \'table\'');

		$tables = [];

		foreach($result as $item)
		{
			array_push($tables, $item['name']);
		}

		$res->json($tables);
	}
}

?>