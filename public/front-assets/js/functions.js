class SliderHelpers {

    static mobileAgent() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
    }

    static isRequired(param, params) {

        if (params[param] === undefined)
            throw new Error(`'${param}' parameter is required`);
    }

    static setActiveClass(dom, oldIndex, newIndex) {

        if (!dom) return;

        let oldActiveDom = dom.children[oldIndex] || null;
        if (oldActiveDom) oldActiveDom.classList.remove('active');

        let newActiveDom = dom.children[newIndex] || null;
        if (newActiveDom) newActiveDom.classList.add('active');

    }
}

class Tabs extends SliderHelpers {

    constructor(params = {}) {

        super();

        const defaultParams = {
            slidesInView: 1,
            slidesInViewResponsive: null,
            onlyDesktop: false,
            currentActiveSlider: 0,
            sliderDom: null,
            navigationDom: null,
            navigationObject: null
        };

        if (params.navigationObject)
            params.navigation = params.navigationObject.params.slider;


        this.params = Object.assign(defaultParams, params);

        if (params.onlyDesktop && !SliderHelpers.mobileAgent()) return;

        this.init();

        window.addEventListener("resize", () => {

            if(window.innerWidth !== this.innerWidth){
                this.init()
            }
        });

    }

    init() {

        this.innerWidth = window.innerWidth;
        this.assignElements();
        this.setActive();
        this.initNavClick();
    }

    assignElements() {

        for (let type of ['slider', 'navigation']) {

            let elementClass = this.params[type];

            if (elementClass) {

                let element = document.querySelector(elementClass);

                if (element) {
                    this.params[type + 'Dom'] = element;

                    for (let sibling of element.parentElement.children) {
                        for (let direction of ['next', 'back']) {
                            if (sibling.classList.contains(direction))
                                this.params[direction] = sibling;
                        }
                    }
                }
                else {
                    throw new Error(`No element '${elementClass}' found specified in '${type}' slider parameters`)
                }

            }
        }
    }

    setActive(newActiveIndex, onSlideActive = true) {

        newActiveIndex = Math.round(parseInt(newActiveIndex)) || 0;

        let {slidesInView, sliderDom, navigationDom, navigationObject, currentActiveSlider} = this.params;

        let {children, clientWidth: sliderWidth} = sliderDom;

        let slidesLength = children.length;
        let lastSlideIndex = Math.round(slidesLength - slidesInView);

        newActiveIndex = (newActiveIndex !== undefined) ? newActiveIndex : currentActiveSlider;
        newActiveIndex = newActiveIndex > lastSlideIndex ? lastSlideIndex : newActiveIndex;
        newActiveIndex = newActiveIndex < 0 ? 0 : newActiveIndex;

        newActiveIndex === 0 ? sliderDom.classList.add('first') : sliderDom.classList.remove('first');
        newActiveIndex === lastSlideIndex ? sliderDom.classList.add('last') : sliderDom.classList.remove('last');

        if(this.params.isSlider){

            let slideWidth = sliderWidth / slidesInView;
            let totalSlides = Math.abs(slidesLength - slidesInView);
            let maxMove = totalSlides * slideWidth;

            let marginLeft = (newActiveIndex * sliderWidth) / slidesInView;

            if (marginLeft > maxMove) // out of range
                marginLeft = marginLeft - (marginLeft - maxMove);

            sliderDom.style.transition = null;
            sliderDom.style.transform = `translateX(${-marginLeft}px)`;

        }

        if (navigationObject) {

            if (newActiveIndex >= navigationObject.active + navigationObject.slidesInView) {
                navigationObject.active = (newActiveIndex + 1) - navigationObject.slidesInView;
            }

            if (newActiveIndex < navigationObject.active) {
                navigationObject.active = newActiveIndex;
                console.log('--')
            }

        }

        this.params.currentActiveSlider = newActiveIndex;

        SliderHelpers.setActiveClass(navigationDom, currentActiveSlider, newActiveIndex);


        if (!onSlideActive) return;
        SliderHelpers.setActiveClass(sliderDom, currentActiveSlider, newActiveIndex);


    }

    initNavClick() {

        let navs = this.params.navigationDom;


        if (!navs) return;


        for (let nav_id in navs.children) {


            if (!navs.children.hasOwnProperty(nav_id)) continue;


            let nav = navs.children[nav_id];

            let startX = null;
            let endX = null;

            let clickStart = event => {
                startX = event.clientX || event.targetTouches[0].pageX;

            };

            let clickMove = event => {
                endX = event.targetTouches[0].pageX;
            };

            let clickRelease = event => {

                endX = event.clientX || endX || startX;

                let move = startX - endX;

                startX = null;
                endX = null;

                if (move < -20 || move > +20) return;

                this.setActive(nav_id);
            };

            if (SliderHelpers.mobileAgent()) {

                nav.removeEventListener("touchstart", clickStart);
                nav.removeEventListener("touchmove", clickMove);
                nav.removeEventListener("touchend", clickRelease);
                nav.addEventListener("touchstart", clickStart);
                nav.addEventListener("touchmove", clickMove);
                nav.addEventListener("touchend", clickRelease);

            } else {

                nav.removeEventListener("mousedown", clickStart);
                nav.removeEventListener("mouseup", clickRelease);
                nav.addEventListener("mousedown", clickStart);
                nav.addEventListener("mouseup", clickRelease);
            }
        }

    }

    set active(index) {
        this.setActive(index, false);
    }

    get active() {
        return this.params.currentActiveSlider;
    }
}

class Accordion extends Tabs{

    constructor(params = {}) {

        SliderHelpers.isRequired('accordion', params);
        SliderHelpers.isRequired('items', params);

        const defaultDragOptions = {
            accordion: null,
            items: null
        };

        params = Object.assign(defaultDragOptions, params);
        params.slider = params.accordion;
        params.navigation = params.accordion;

        super(params);

    }

    init(){
        super.init();

        let articles = document.querySelectorAll(this.params.items);

        for (let article of articles){

            let maxHeight = `${article.scrollHeight}px`;

            Object.assign(article.style, {maxHeight})
        }
    }
}

class DraggableSlider extends Tabs {

    constructor(params = {}) {

        SliderHelpers.isRequired('slider', params);

        const defaultDragOptions = {
            isSlider: true,
            desktop: true,
            mobile: true,
            swipeDistance: 50,
            onSlideActive: true,
            startedSwiping: null,
            stopedSwiping: null,
        };

        params = Object.assign(defaultDragOptions, params);

        super(params);

    }

    init() {
        super.init();
        this.responsive();
        this.setStyles();
        this.setSlidesWidth();
        this.hideExtraNavs();
        this.initDragEvents();
        this.initArrowClick();
    }

    responsive() {

        let medias = this.params.slidesInViewResponsive;

        if (!medias) return;

        medias.sort((a, b) => (a.innerWidth > b.innerWidth) ? 1 : -1);


        for (let media of medias) {

            let {views, ...windowProperties} = media;

            for (let property in windowProperties) {
                if(!windowProperties.hasOwnProperty(property)) continue;

                if (window[property] < windowProperties[property]) {
                    return this.params.slidesInView = views;
                }
            }
        }

        return this.params.slidesInView = medias[medias.length - 1].views;

    }

    setStyles() {
        let {sliderDom, slidesInView} = this.params;

        sliderDom.classList.add('slider_working');

        let styles = {
            maxWidth: '100%',
            display: 'flex',
            flexWrap: 'nowrap',
            justifyContent: 'left',
        };


        Object.assign(sliderDom.style, styles);


        if (sliderDom.children.length < slidesInView) this.params.slidesInView = sliderDom.children.length
    }

    setSlidesWidth() {

        let {sliderDom, slidesInView} = this.params;

        let {children, clientWidth} = sliderDom;

        for (let i = 0; i < children.length; i++) {

            let slide = children[i];

            let slideWidth = clientWidth / slidesInView;


            slide.style.flex = `0 0 ${slideWidth}px`;

        }

    }

    hideExtraNavs() {

        let {sliderDom, navigationDom, slidesInView} = this.params;

        if (!navigationDom) return;

        let maxSlides = sliderDom.children.length - slidesInView;

        let navs = navigationDom.children;

        if (navs.length === 1) {

            navigationDom.style.display = 'none'

        } else {

            for (let i = 0; i < navs.length; i++) {
                navs[i].style.display = 'flex';

                if (i > Math.round(maxSlides)) {

                    navs[i].style.display = 'none';
                }
            }
        }
    }

    initDragEvents() {

        let isSwiping = false;
        let startX = null;
        let startY = null;
        let activeSlider = null;
        let mesureSpeed = null;
        let move = null;
        let scroll = null;
        let speed = 0;


        let startSwiping = (e) => {

            this.isClick = true;

            activeSlider = this.params.currentActiveSlider;

            startX = e.clientX || e.targetTouches[0].pageX;
            startY = e.clientY || e.targetTouches[0].pageY;

            isSwiping = true;

            let oldMove = 0;


            mesureSpeed = setInterval( () => {

                speed = (move - oldMove) * 2;
                oldMove = move

            }, 50);


            if (e.target.offsetParent === this.params.sliderDom) {

                if (this.params.startedSwiping)
                    this.params.startedSwiping(e, this)
            }


        };

        let stopSwiping = (e) => {


            if (isSwiping) {

                e.preventDefault();
                e.stopPropagation();

                this.setActive(activeSlider, this.params.onSlideActive);
                isSwiping = false;

                let rmcOrTouch = (!e.button || e.button < 2);
                let sliderClicked = e.target.offsetParent === this.params.sliderDom;

                if (rmcOrTouch && sliderClicked) {

                    if (e.target.firstElementChild && this.isClick) {
                        e.target.firstElementChild.click();
                    }

                    if (this.params.stopedSwiping)
                        this.params.stopedSwiping(e, this)
                }
            }

            clearInterval(mesureSpeed);

        };

        let whileSwiping = (e) => {

            if (!isSwiping) return;

            let {sliderDom, swipeDistance, currentActiveSlider, slidesInView} = this.params;


            let sliderChildren = sliderDom.children;
            let slidersLength = sliderChildren.length;
            let totalSlides = slidersLength - slidesInView;


            if (!e.clientX && !e.targetTouches) return;

            let moveX = e.clientX || e.targetTouches[0].pageX;
            let moveY = e.clientY || e.targetTouches[0].pageY;

            move = startX - moveX;
            scroll = startY - moveY;

            let sliderWidth = sliderDom.clientWidth;
            let slideWidth = sliderWidth / slidesInView;
            let startMargin = (sliderWidth * currentActiveSlider) / slidesInView;


            let moveFromEdge = move + startMargin;
            let maxMove = totalSlides * slideWidth;

            if (moveFromEdge < 0) {
                moveFromEdge = moveFromEdge / 4;
            }

            if (moveFromEdge > maxMove) {
                let outOfRange = moveFromEdge - maxMove;
                moveFromEdge = moveFromEdge - outOfRange * .75;
            }

            if(Math.abs(move) > swipeDistance || Math.abs(scroll) > swipeDistance)
                this.isClick = false;

            if ( Math.abs(move) > swipeDistance ) {


                e.preventDefault();
                e.stopPropagation();


                activeSlider = currentActiveSlider;
                activeSlider = move > swipeDistance ? activeSlider + 1 : activeSlider;
                activeSlider = move < -swipeDistance ? activeSlider - 1 : activeSlider;


                if (move + speed < -slideWidth || move + speed > slideWidth) {


                    activeSlider = Math.round((moveFromEdge > 0 ? speed + moveFromEdge : 0) / slideWidth);
                    activeSlider = Math.round(Math.min(Math.max(activeSlider, 0), totalSlides));

                }
            }


            sliderDom.style.transition = 'none';
            sliderDom.style.transform = `translateX(${-Math.round(moveFromEdge)}px)`;


        };

        let {desktop, mobile, sliderDom} = this.params;

        if (desktop && !Tabs.mobileAgent()) {


            sliderDom.removeEventListener('mousedown', startSwiping);
            sliderDom.addEventListener('mousedown', startSwiping);

            window.removeEventListener('mouseup', stopSwiping);
            window.addEventListener('mouseup', stopSwiping);

            window.removeEventListener('mousemove', whileSwiping);
            window.addEventListener('mousemove', whileSwiping);
        }

        if (mobile && Tabs.mobileAgent()) {

            sliderDom.removeEventListener('touchstart', startSwiping);
            sliderDom.addEventListener('touchstart', startSwiping);

            window.removeEventListener('touchend', stopSwiping);
            window.addEventListener('touchend', stopSwiping);

            window.removeEventListener('touchmove', whileSwiping);
            window.addEventListener('touchmove', whileSwiping);
        }

    }

    initArrowClick() {
        let slider = this;

        let move = {
            next() {
                slider.active++
            },

            back() {
                slider.active--
            },
        };

        for (let direction of ['back', 'next']) {

            let arrow = this.params[direction];

            if (arrow) {
                if (SliderHelpers.mobileAgent()) {

                    arrow.removeEventListener("touchend", move[direction]);
                    arrow.addEventListener("touchend", move[direction]);

                } else {

                    arrow.removeEventListener("click", move[direction]);
                    arrow.addEventListener("click", move[direction]);
                }
            }
        }
    }

    get slidesInView() {
        return this.params.slidesInView;
    }

}

class GallerySlider extends DraggableSlider{

    constructor(params = {}) {

        SliderHelpers.isRequired('slider', params);
        SliderHelpers.isRequired('miniSlider', params);

        const defaultParams = {
            slider: null,
            slidesInView: 1,

            slidesInViewMini: 4,
            miniSlider: null,
            miniSliderDots: null,
            miniSliderResponsive: null,
        };


        params = Object.assign(defaultParams, params);

        defaultParams.navigationObject = new DraggableSlider({
            slider: params.miniSlider,
            slidesInView: params.slidesInViewMini,
            slidesInViewResponsive: params.miniSliderResponsive,
            navigation: params.miniSliderDots,
            onSlideActive: false,
        });

        super(params);


    }
}

/**
 * @param {string} hash_trigger Hash string, that will be used to trigger open and close menu
 * @param {string} open_class Optional style class name when menu is opened, default 'menu-opened'
 * @param {string} close_class  Optional style class name when menu is closed, default menu-closed
 * */
class MenuOpenClose {

    constructor(hash_trigger, open_class = 'menu-opened', close_class = 'menu-closed') {
        this.hash_trigger = hash_trigger;
        this.open_class = open_class;
        this.close_class = close_class;
        this.open = false;
        this.init();
    }

    get openMenu() {
        const body_classList = document.body.classList;
        body_classList.add(this.open_class);
        body_classList.remove(this.close_class);
        this.open = true;

        return true;
    }

    get closeMenu() {
        const body_classList = document.body.classList;
        body_classList.add(this.close_class);
        body_classList.remove(this.open_class);
        this.open = false;

        return false;
    }


    get toggle(){
        if (location.hash.includes(this.hash_trigger)) {
            this.closeMenu;
            location.hash = '';
        }
        else {
            this.openMenu;
            location.hash = this.hash_trigger;
        }
    }

    hashTrigger(event) {

        if (event) event.preventDefault();

        if (location.hash.includes(this.hash_trigger))
            this.openMenu;
        else
            this.closeMenu;
    }

    init() {
        window.addEventListener("hashchange", event => this.hashTrigger(event));
        window.addEventListener("scroll", event => this.closeMenu());
        this.hashTrigger();
    }
}


