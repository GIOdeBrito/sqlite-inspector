
import FileUploaderManager from "../managers/file-uploader-manager.js";
import { httpPostForm } from "../helpers/http.js";

class FileUploader
{
    #element = null;
    #fileinput = null;

	#options = Object.seal({
		sendoninput: false,
		multiple: false,
		accepts: [],
		url: "",
		httpobj: {},
		allowdrop: true
	});

    #afterinputfunc = function () { };
    #beforesendfunc = function () { };
    #aftersendfunc = function () { };
    #onerrorfunc = function () { };

    constructor (elem, options)
    {
		Object.keys(options).forEach(key =>
		{
			if(!(key in this.#options))
			{
				return;
			}

			this.#options[key] = options[key];
		});

		this.#element = elem;

		this.#setMainElement();
		this.#createFileInput();

		this.#setInputEvents();
    }

	set oninput (func)
	{
		this.#afterinputfunc = func;
	}

	set onbeforesend (func)
	{
		this.#beforesendfunc = func;
	}

	set onaftersend (func)
	{
		this.#aftersendfunc = func;
	}

	set onerrorsend (func)
	{
		this.#onerrorfunc = func;
	}

	async send ()
	{
		if(this.#options.url === "" || !this.#options.url)
		{
			throw new Error("Url not set for file uploader");
		}

		this.#beforesendfunc();

		let response = await httpPostForm(this.#options.url, this.#options.httpobj, this.#fileinput.files);

		this.#aftersendfunc(response);
	}

	#setInputEvents ()
	{
		this.#element.onclick = () =>
		{
			this.#fileinput.click();
		};

		this.#element.ondragover = (ev) =>
		{
			ev.preventDefault();
		};

		this.#element.ondrop = (ev) =>
		{
			ev.preventDefault();

			if(!this.#options.allowdrop)
			{
				return;
			}

			/**
			* Apparently there is a bug on the console/debugger that will
			* always show the event's dataTransfer property as null
			*/
			this.#fileinput.files = ev.dataTransfer.files;

			this.#filesHandler(ev);
		};

		this.#fileinput.addEventListener('input', (ev) =>
		{
			this.#filesHandler(ev);
		});
	}

	#filesHandler (ev)
	{
		let files = this.#fileinput.files;

		if(!this.#isFileAcceptable(files, this.#options.accepts))
		{
			throw new Error("File type not allowed");
		}

		this.#afterinputfunc(ev, files);

		if(!this.#options.sendoninput)
		{
			return;
		}

		this.send();
	}

	#setMainElement ()
	{
		let img = document.createElement('img');
		img.src = "public/assets/icon/upload-arrow.webp";
		img.alt = "upload-arrow";

		this.#element.appendChild(img);
		this.#element.draggable = true;
	}

	#createFileInput ()
	{
		let input = document.createElement('input');
		input.type = "file";
		input.multiple = this.#options.multiple;

		for(let i = 0; i < this.#options.accepts.length; i++)
		{
			let accept = this.#options.accepts[i];

			if(i !== 0 || (i + 1) < this.#options.accepts.length)
			{
				accept = "," + accept;
			}

			input.accept += accept.trim();
		}

		this.#element.appendChild(input);
		this.#fileinput = input;
	}

	/**
	* @param {string[]} files
	*/
	#isFileAcceptable (files)
	{
		let included = Array.from(files).some(file => !this.#options.accepts.includes(file.type));

		return included;
	}
}

export default FileUploader;
