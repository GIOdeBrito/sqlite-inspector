<?php

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

	public function add_route (string $method, string $route, object|string $callback): void
	{
		if(!array_key_exists($method, $this->routes))
		{
			http_response_code(500);
			echo 'Method not set';
			die();
		}

		if(!is_callable($callback))
		{
			http_response_code(500);
			echo 'Callback function not set';
			die();
		}

		$this->routes[$method][$route] = $callback;
	}

	public function handle_request (Request $req, Response $res): void
	{
		// Checks if the request method does exist in the router
		if(!array_key_exists($req->method, $this->routes))
		{
			$res->redirect("/");
		}

		$route = NULL;

		// Looks for the registered route
		foreach($this->routes[$req->method] as $key => $value)
		{
			if(!$req->parse_route($key, $req->uri))
			{
				continue;
			}

			$route = $key;
		}

		if(is_null($route))
		{
			$res->redirect("/");
		}

		$this->routes[$req->method][$route]($req, $res);
	}
}

?>