
class ModalManager
{
    static #modalCollection = [];

    static #zIndexValue = 12;
    static #eventSet = false;

    static add (item)
    {
        this.#modalCollection.push(item);
        this.resortModals();

        if(this.#eventSet)
        {
            return;
        }

        this.#setKeyEvent();
    }

    static erase (item)
    {
        let toremove = this.all.findIndex(collected => item === collected);

        if(toremove < 0)
        {
            return;
        }

        this.#modalCollection.splice(toremove, 1);
    }

    static resortModals ()
    {
        let zvalue = this.#zIndexValue;

        this.all.forEach(modalitem =>
        {
            modalitem.background.style.zIndex = zvalue;
            modalitem.root.style.zIndex = zvalue + 2;

            zvalue += 3;
        });
    }

    static #setKeyEvent ()
    {
        window.addEventListener('keydown', (ev) =>
        {
            if(ev.key !== 'Escape')
            {
                return;
            }

            this.#escapeKeyEvent();
        });

        this.#eventSet = true;
    }

    static #escapeKeyEvent ()
    {
        let modalitems = this.all.reverse();

        modalitems[0].close();
    }

    static get all ()
    {
        return this.#modalCollection;
    }
}

export default ModalManager;
