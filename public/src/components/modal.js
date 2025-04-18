
import Point from "../models/point.js";
import ModalManager from "../managers/modal-manager.js";
import { createDialog, createBackground } from "../helpers/modal-helpers.js";

class Modal
{
    #root = null;
    #background = null;

	#name = "";
	#view = "";
	#point = Point.zero;
	#zdepth = 0;
	#draggable = false;

    #onloadfunc = function (ev) { };
    #onclosefunc = function (ev) { };

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
        let data = await fetch('/api/v1/modal/' + this.#view);
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

		this.#root.addEventListener('click', (ev) => ev.stopPropagation());
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

export default Modal;