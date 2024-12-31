<?php

abstract class PageController
{
	protected static ?object $args = NULL;
	protected static ?string $view = NULL;

	/* Must be implemented by child class */
	abstract public static function index (): void;

	protected static function set_view (string $viewname): void
	{
		self::$view = $viewname;
	}

	protected static function set_args (object $args): void
	{
		self::$args = $args;
	}

	protected static function render ()
	{
		require 'views/_layout.php';
	}

	protected static function render_body ()
	{
		require 'views/'.self::$view;
	}
}

?>