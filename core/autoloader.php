<?php

/**
* The autoloader is responsible for keeping many classes
* globally available to be instantiated.
*/

spl_autoload_register(function ($classname)
{
	$paths = [
		"/../controllers/api/",
		"/../controllers/page/",
		"/../models/"
	];

	foreach($paths as $path)
	{
		$abspath = __DIR__.$path.str_replace('\\', DIRECTORY_SEPARATOR, $classname).'.php';

		if(!file_exists($abspath))
		{
			continue;
		}

		require $abspath;

		return;
	}

	throw new Exception("Class '{$classname}' not found");
});

?>