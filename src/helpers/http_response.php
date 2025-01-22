<?php

class Response
{
	private int $status = 200;
	private string $contenttype = "";
	private mixed $body;
	private array $viewparams = [];

	public function set_status_code (int $code): void
	{
		$this->status_code = $code;
	}

	public function render (string $body, array $params = []): void
	{
		$this->body = $body;
		$this->viewparams = $params;

		$this->viewparams['view'] = $body;

		$this->contenttype = "text/html";
		$this->send();
	}

	public function json (string $body): void
	{
		$this->body = $body;
		$this->contenttype = "application/json";
		$this->send();
	}

	public function redirect (string $url): void
	{
		header("Location: ${url}");
		die();
	}

	private function send (): void
	{
		http_response_code($this->status);
		header('Content-Type: '.$this->contenttype);

		switch($this->contenttype)
		{
			case 'text/html':
			{
				// Extract the array key value pair as local variables
				extract($this->viewparams);

				require "src/views/_layout.php";
			}
			break;
			case 'application/json':
			{
				echo json_encode($this->body);
			}
			break;
			case 'text/plain':
			default:
			{
				echo $this->body;
			}
			break;
		}

		die();
	}
}

?>