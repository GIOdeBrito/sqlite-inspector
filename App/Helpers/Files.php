<?php

function getFileRandomName (string $name): string
{
	$ext = pathinfo($name, PATHINFO_EXTENSION);

	return date('Ymd_his').'.'.$ext;
}

function getHttpFiles (): array|object
{
	$uploaded_files = $_FILES['uploaded_file'];
	$filecount = count($uploaded_files['name']);

	$objectarray = [];

	for($i = 0; $i < $filecount; $i++)
	{
		$object = new UploadedFileModel();

		$object->name 		= $uploaded_files['name'][$i];
		$object->fullpath 	= $uploaded_files['full_path'][$i];
		$object->type 		= $uploaded_files['type'][$i];
		$object->tempname 	= $uploaded_files['tmp_name'][$i];
		$object->error 		= $uploaded_files['error'][$i];
		$object->size 		= $uploaded_files['size'][$i];

		array_push($objectarray, $object);
	}

	/* If there is only a single object, then
	returns the first object instead of an array */
	if(count($objectarray) === 1)
	{
		return $objectarray[0];
	}

	return $objectarray;
}

function emptyUploadsFolder (): void
{
	$files = glob('../uploads/*.*');

	foreach ($files as $file)
	{
		unlink($file);
	}
}

function moveFileToUploads (UploadedFileModel $file): bool
{
	if(!is_uploaded_file($file->tempname))
	{
		return false;
	}

	$destination = '../uploads/';
	$randname = getFileRandomName($file->name);

	if(!move_uploaded_file($file->tempname, $destination.$randname))
	{
		return false;
	}

	chmod($destination.$randname, 0600);

	return true;
}

?>