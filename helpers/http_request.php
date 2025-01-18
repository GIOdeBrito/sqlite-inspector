<?php

class Request
{
	private string $method = "";
	private string $uri = "";
	private ?array $params = NULL;

	public function __construct ()
	{
		$this->method = $_SERVER["REQUEST_METHOD"];
		$this->uri = $_SERVER["REQUEST_URI"];
	}

	public function __get (string $name): mixed
	{
		if(!property_exists($this, $name))
		{
			throw new Exception("Property ${$name} does not exist");
		}

		return $this->{$name}();
	}

	public function set_params (array $params): void
	{
		$this->params = $params;
	}

	private function method (): string
	{
		return strtoupper($this->method);
	}

	private function uri (): string
	{
		return parse_url($this->uri, PHP_URL_PATH);
	}

	private function params (): array|null
	{
		return $this->params;
	}
}

?>