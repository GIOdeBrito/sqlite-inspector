
import { httpGet } from "../helpers/http.js";

window.addEventListener('DOMContentLoaded', function()
{
	FileUploaderManager.start();
});

class FileUploaderManager
{
	static #maxSz = 0;

	static async start ()
	{
		let response = await httpGet('/api/v1/maxuploadsize/');

		FileUploaderManager.maxUploadSize = response.size;
	}

	static get maxUploadSize ()
	{
		return this.#maxSz;
	}

	static set maxUploadSize (value)
	{
		this.#maxSz = value;
	}
}

export default FileUploaderManager;
