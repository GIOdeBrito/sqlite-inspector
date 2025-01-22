<?php

abstract class PageController
{
	/* Must be implemented by child class */
	abstract public static function index (Request $req, Response $res): void;
}

?>