<?php

namespace App\Controllers\Api;

use App\Http\Request;
use App\Http\Response;

class Modals
{
	public static function returnModalContent (Request $req, Response $res): void
	{
		if(!isset($req->params->modal))
		{
			$res->json(400, [ 'err' => true, 'msg' => 'No param set.' ]);
		}

		$name = $req->params->modal;

		// Use absolute namespace 
		$content = \App\Models\Modals::getContentByName($name);

		$res->html($content);
	}
}

?>