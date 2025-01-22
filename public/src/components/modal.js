
import Point from "../models/point.js";
import ModalManager from "../managers/modal-manager.js";

class Modal
{
    #root = null;
    #background = null;

	#name = "";
	#view = "";
	#point = Point.zero;
	#zdepth = 0;
	#draggable = false;

    #onloadfunc = function (ev) {  };
    #onclosefunc = function (ev) {  };

    constructor (name, view = "default", x = 600, y = 400)
    {
        this.#name = name;
        this.#view = view;
        this.#point = new Point(x, y);

        this.#root = createDialog(name, this.#point);
		this.#background = createBackground();

		this.#fetchContent();

		this.#root.open = true;

        this.#setControls();

        ModalManager.add(this);
    }

	set zDepth (value)
	{
		this.#root.style.zIndex = value;
		this.zdepth = value;
	}

    get zDepth ()
    {
        return parseInt(this.#zdepth);
    }

    set draggable (value)
    {
        this.#draggable = value;
    }

    get draggable ()
    {
        return this.#draggable;
    }

    /**
	* @param {Function} func
	*/
    set onload (func)
    {
        this.#onloadfunc = func;
    }

    /**
	* @param {Function} func
	*/
    set onclose (func)
    {
        this.#onclosefunc = func;
    }

    get root ()
    {
        return this.#root;
    }

    get background ()
    {
        return this.#background;
    }

    async #fetchContent ()
    {
        let data = await fetch('/api/v1/getmodal/' + this.#view);
        let content = await data.text();

        this.#root.innerHTML = content;

        if(!this.#onloadfunc)
        {
            return;
        }

        this.#onloadfunc();
    }

    #setControls ()
    {
        this.#background.onclick = () =>
        {
            this.close();
        };

        let isDragging = false;

        this.#root.addEventListener('mousedown', () =>
        {
            isDragging = true;
        });

        this.#root.addEventListener('mouseup', () =>
        {
            isDragging = false;

            document.body.style.cursor = '';
        });

        this.#root.addEventListener('mousemove', (ev) =>
        {
            if(this.draggable === false || !isDragging)
            {
                return;
            }

            this.#windowDragEvent(ev);
        });
    }

    #windowDragEvent ({ movementX, movementY })
    {
        document.body.style.cursor = 'move';

        let containerStyle = window.getComputedStyle(this.#root);

        let leftVal = parseInt(containerStyle.left);
        let topVal = parseInt(containerStyle.top);

        this.#root.style.left = `${leftVal + movementX}px`;
        this.#root.style.top = `${topVal + movementY}px`;
    }

    close ()
    {
        this.destroy();
    }

    destroy ()
    {
        this.#root.remove();
        this.#background.remove();

        document.body.style.cursor = '';

        ModalManager.erase(this);

        if(!this.#onclosefunc)
        {
            return;
        }

        this.#onclosefunc();
    }
}

function createDialog (name, point)
{
	let root = document.createElement('dialog');
	root.setAttribute('data-modal-name', name);
	root.style = `
		display: grid;
		width: ${point.X};
		height: ${point.Y};
		z-index: 1;
		position: fixed;
		left: calc(50% - ${point.X} / 2);
		top: calc(50% - ${point.Y} / 2);
		background-color: rgba(255, 255, 255, 0.8);
		border-style: solid;
		border-color: var(--main-light-green);
		border-radius: 1rem;
		border-width: 1rem 0 0 0;
		overflow: auto;
		transition: transform .2s ease;
		margin: 0;
		scrollbar-width: thin;
		box-sizing: border-box;
		box-shadow: rgba(0, 0, 0, 0.25) 0px 0px 2rem;
	`;

	document.body.appendChild(root);

	return root;
}

function createBackground ()
{
	let background = document.createElement('div');
	background.style = `
		position: fixed;
		width: 100%;
		height: 100%;
		z-index: 1;
		top: 0;
		left: 0;
		background-color: rgba(45, 45, 45, 0);
		transition: background-color 0.22s ease;
	`;

	setTimeout(() => background.style.backgroundColor = 'rgba(45, 45, 45, .75)', 0);

	document.body.appendChild(background);

	return background;
}

export default Modal;