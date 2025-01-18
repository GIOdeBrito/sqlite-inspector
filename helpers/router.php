<?php

require_once 'helpers/web_response.php';
require 'helpers/http_request.php';

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
		$req = new Request();

		if(!array_key_exists($req->method, $this->routes))
		{
			php_response('', 500);
		}

		$uri_params = $this->uri_cmp($req);

		if(!$uri_params)
		{
			php_response('', 500);
		}

		$req->set_params($uri_params->params);

		http_response_code(200);

		$this->routes[$req->method][$uri_params->uri]($req);

		die();
	}

	private function uri_cmp (Request $req): object|bool
	{
		$routes = array_keys($this->routes[$req->method]);

		foreach($routes as $route)
		{
			$params = $this->get_uri_params($route, $req->uri);

			if(!$params)
			{
				continue;
			}

			return $params;
		}

		return false;
	}

	private function get_uri_params (string $cmpuri, string $uri): object|bool
	{
		$cmpuri_arr = explode('/', $cmpuri);
		$i = -1;

		// Searches for a param pattern in the uri
		$params = array_map(function ($item) use (&$i)
		{
			$i++;

			if(!str_contains($item, ":"))
			{
				return NULL;
			}

			return [ 'param' => str_replace(':', '', $item), 'pos' => $i ];
		}, $cmpuri_arr);

		// Clears out NULL items and resets the array order
		$params = array_values(array_filter($params));

		// Splits the uri request for comparing
		$uri_arr = explode('/', $uri);

		for($i = 0; $i < count($params); $i++)
		{
			$position = $params[$i]['pos'];

			// Sets the parameter's value equals the uri's
			$params[$i]['value'] = $uri_arr[$position];

			// Replaces the values from the uri with the parameter names
			$uri_arr[$position] = ':'.$params[$i]['param'];
		}

		// If there is difference between them, returns false
		if(count(array_diff($uri_arr, $cmpuri_arr)) !== 0)
		{
			return false;
		}

		$object = [
			'uri' => $cmpuri,
			'params' => $params
		];

		return (object) $object;
	}
}

?>