<?php

namespace App\Http;

enum ResponseTypeEnum
{
	case VIEW;
	case JSON;
	case PLAINTEXT;
	case HTML;
}

class Response
{
	public int $status = 200;

	private string $contenttype = "";
	private mixed $body;
	private array $viewparams = [];
	private ResponseTypeEnum $type;

	public function render (string $body, array $params = []): void
	{
		$this->body = $body;
		$this->viewparams = $params;

		$this->viewparams['view'] = $body;

		$this->contenttype = "text/html";
		$this->type = ResponseTypeEnum::VIEW;
		$this->send();
	}

	public function set_status (int $code)
	{
		$this->status = $code;
	}

	public function html (string $body): void
	{
		$this->body = $body;
		$this->contenttype = "text/html";
		$this->type = ResponseTypeEnum::HTML;
		$this->send();
	}

	public function json (int $code, array|object $data): void
	{
		$this->body = json_encode($data);
		$this->contenttype = "application/json";
		$this->type = ResponseTypeEnum::JSON;
		$this->send();
	}

	public function plain (string $body): void
	{
		$this->body = $body;
		$this->contenttype = "text/plain";
		$this->type = ResponseTypeEnum::PLAINTEXT;
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

		switch($this->type)
		{
			case ResponseTypeEnum::VIEW:
			{
				// Extract the array key value pair as local variables
				extract($this->viewparams);

				require "app/template/_layout.php";
			}
			break;
			case ResponseTypeEnum::JSON:
			{
				echo json_encode($this->body);
			}
			break;
			case ResponseTypeEnum::HTML:
			{
				include 'app/views/'.$this->body.'.php';
			}
			break;
			case ResponseTypeEnum::PLAINTEXT:
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