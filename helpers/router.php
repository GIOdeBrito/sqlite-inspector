<?php

require_once 'helpers/web_response.php';

class Router
{
	private ?array $routes = NULL;

	public function __construct ()
	{
		$this->routes = [
			'GET' => [],
			'POST' => []
		];
	}

	public function add_route (string $method, string $route, object $callback): void
	{
		if(!array_key_exists($method, $this->routes))
		{
			php_response('Method not set', 500);
		}

		if(!is_callable($callback))
		{
			php_response('Callback function is not callable', 500);
		}

		$this->routes[$method][$route] = $callback;
	}

	public function handle_request (): void
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if(!array_key_exists($method, $this->routes))
		{
			php_response('', 500);
		}

		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

		//echo "URI: ".$uri;

		if(!array_key_exists($uri, $this->routes[$method]))
		{
			php_response('', 500);
		}

		http_response_code(200);

		$this->routes[$method][$uri]();

		die();
	}
}

?>