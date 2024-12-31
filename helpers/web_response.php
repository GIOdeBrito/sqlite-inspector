<?php

function json_response (mixed $body, $code = 200): void
{
	http_response_code($code);
	echo json_encode($body);
	die();
}

function php_response (mixed $response, $code = 200): void
{
	http_response_code($code);
	echo $response;
	die();
}

?>