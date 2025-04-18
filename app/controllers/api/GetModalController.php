<?php

require 'src/models/modals_model.php';

class GetModalController
{
	public static function return_modal_content (Request $req, Response $res): void
	{
		if(!isset($req->params->modal))
		{
			$res->json(400, [ 'err' => true ]);
		}

		$name = $req->params->modal;

		$content = ModalsModel::get_content_by_name($name);

		$res->html($content);
	}
}

?>