<?php

/**
* The autoloader is responsible for keeping many classes
* globally available to be instantiated.
*/

spl_autoload_register(function ($classname)
{
	$abspath = __DIR__.'/../../'.$classname.'.php';
	$abspath = str_replace('\\', '/', $abspath);

	if(!file_exists($abspath))
	{
		throw new Exception("Class '{$classname}' not found at: {$abspath}");
	}

	require_once $abspath;
});

?>