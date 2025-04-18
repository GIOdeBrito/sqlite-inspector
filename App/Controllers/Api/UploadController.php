<?php

require 'src/helpers/files.php';

class UploadController
{
	public static function handleDbUpload (): void
	{
		$file = get_http_files();

		empty_uploads_folder();

		// Only a binary file is allowed
		if($file->type !== "application/octet-stream")
		{
			http_response_code(403);
			die();
		}

		echo json_encode([ 'success' => moveFileToUploads($file) ]);
	}
}

?>