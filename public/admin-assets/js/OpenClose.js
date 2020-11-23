class OpenClose {
    /**
     * @param {string} props.open_class Adds class to body when opened
     * @param {string} props.close_class Adds class to body when closed
     * */
    constructor(props = {}) {
        const defaultProps = {
            open_class: 'opened',
            close_class: 'closed',
        }

        props = {
            ...defaultProps,
            ...props
        }

        this.open_class = props.open_class;
        this.close_class = props.close_class;
    }

    setOpenClassesToBody() {
        const body_classList = document.body.classList;
        body_classList.add(this.open_class);
        body_classList.remove(this.close_class);
    }

    setCloseClassesToBody() {
        const body_classList = document.body.classList;
        body_classList.add(this.close_class);
        body_classList.remove(this.open_class);
    }

    get openedClasses(){
        const body_classList = document.body.classList;
        return body_classList.contains(this.open_class)
    }

    toggleClasses(){
        if(this.openedClasses)
            this.setCloseClassesToBody()
        else
            this.setOpenClassesToBody()
    }

}


class OpenCloseWithHash extends OpenClose{

    /**
     * @param {string} props.hash_trigger Hash which will trigger open method
     * @param {string} props.open_class Adds class to body when opened
     * @param {string} props.close_class Adds class to body when closed
     * */
    constructor(props = {}) {
        const defaultProps = {
            hash_trigger: 'open',
        }

        props = {
            ...defaultProps,
            ...props
        }

        super(props);

        this.hash_trigger = props.hash_trigger;
        this.hashchangeListen();
    }

    hashchangeListen() {
        window.addEventListener("hashchange", _ => this.hashTrigger());
        this.hashTrigger();
    }

    hashTrigger() {

        if (this.isOpenHash)
            this.setOpenClassesToBody();
        else
            this.setCloseClassesToBody();
    }

    get isOpenHash() {
        return location.hash === `#${this.hash_trigger}`;
    }

    toggleHash() {

        if (this.isOpenHash)
            location.hash = ''
        else
            this.setOpenHash();
    }

    setOpenHash() {
        location.hash = this.hash_trigger;
    }
}

const menu = new OpenCloseWithHash({
    hash_trigger: 'open-menu',
    open_class: 'menu-opened',
    close_class: 'menu-closed'
});
