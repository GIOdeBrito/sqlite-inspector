<?php

namespace App\Helpers;

use App\Http\Request;
use App\Http\Response;

abstract class Controller
{
	/* Must be implemented by child class */
	abstract public static function index (Request $req, Response $res): void;
}

?>