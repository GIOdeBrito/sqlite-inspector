<?php

class UploadedFileModel
{
	public ?string $name = NULL;
	public ?string $fullpath = NULL;
	public ?string $type = NULL;
	public ?string $tempname = NULL;
	public ?string $error = NULL;
	public ?string $size = NULL;

	public function get_size_in_megabytes (): int
	{
		return $this->size * 1024 * 1024;
	}
}

?>