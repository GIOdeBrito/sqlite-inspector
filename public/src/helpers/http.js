
/**
 * Make a simple http request to post form data to an endpoint.
 * @param {string} url
 * @param {object} args
 * @param {FileList[]} files
 * @returns {Promise<object | string>}
 */
async function httpPostForm (url, args = Object(), files = Array())
{
	const fdata = new FormData();

	fdata.append('args', JSON.stringify(args));

	// Append files
	if(files.length > 0)
	{
		Array.from(files).forEach(file => fdata.append('uploaded_file[]', file));
	}

	let response = await fetch(url,
	{
		"method": "POST",
		"Content-Type": "multipart/form-data",
		"body": fdata
	});

	return parseResponse(response);
}

/**
 * Makes a simple http post.
 * @param {string} url
 * @param {object} body
 * @returns {Promise<object | string>}
 */
async function httpPost (url, body = Object(), files = Array())
{
	let response = await fetch(url,
	{
		"method": "POST",
		"Content-Type": "application/json",
		"body": JSON.stringify(body)
	});

	return parseResponse(response);
}

/**
 * Performs a simple http request that fetchs a resource.
 * @param {string} url
 * @returns {Promise<object | string>}
 */
async function httpGet (url = String())
{
	let response = await fetch(url);

	return parseResponse(response);
}

/**
 * Retrieves the data from the fetch response.
 * @param {Response} response
 * @returns {Promise<object | string>}
 */
async function parseResponse (response)
{
	let responseClone = response.clone();

	try
	{
		return await response.text();
	}
	catch(ex)
	{
		return await responseClone.json();
	}
}

export {
	httpPost,
	httpPostForm,
	httpGet
}
