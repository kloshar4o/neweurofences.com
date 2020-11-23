"use strict";

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

class TabSlider extends SliderHelpers {

    constructor(params = {}) {

        super();

        SliderHelpers.isRequired('slider', params);


        const defaultParams = {
            slidesInView: 1,
            slidesInViewResponsive: null,
            currentActiveSlider: 0,
            NotClick: false,
        };

        if (params.navigationObject)
            params.navigation = params.navigationObject.params.slider;


        this.params = Object.assign(defaultParams, params);

        this.init();

        window.addEventListener("resize", _ => this.init());

    }

    init() {
        this.responsive();
        this.assignElements();
        this.setStyles();
        this.setSlidesWidth();
        this.hideExtraNavs();
        this.setActive();
        this.initNavClick();
    }

    responsive() {

        let medias = this.params.slidesInViewResponsive;

        if (!medias) return;

        medias.sort((a, b) => (a.maxWidth > b.maxWidth) ? -1 : 1);

        for (let media of medias) {

            let {views, maxWidth} = media;

            if (window.matchMedia(`(max-width: ${maxWidth}px)`).matches) {
                this.params.slidesInView = views;
            }

        }

    }

    assignElements() {

        for (let type of ['slider', 'navigation']) {

            let elementClass = this.params[type];

            if (elementClass) {

                let element = document.querySelector(elementClass);

                if (element) {
                    this.params[type + 'Dom'] = element;
                }
                else {
                    throw new Error(`No element '${elementClass}' found specified in '${type}' slider parameters`)
                }

            }
        }
    }

    setStyles() {
        let {sliderDom} = this.params;

        sliderDom.style.maxWidth = '100%';
        sliderDom.style.display = 'flex';


    }

    setSlidesWidth() {

        let {sliderDom, slidesInView} = this.params;

        let {children, clientWidth} = sliderDom;

        for (let slide_id in children) {

            if (children.hasOwnProperty(slide_id)) {

                children[slide_id].style.flex = `0 0 ${clientWidth / slidesInView}px`;
            }

        }

    }

    hideExtraNavs() {

        let {sliderDom, navigationDom, slidesInView} = this.params;

        if (!navigationDom) return;

        let maxSlides = sliderDom.children.length - slidesInView;


        let navs = navigationDom.children;

        for (let i = 0; i < navs.length; i++) {
            navs[i].style.display = 'block';

            if (i > maxSlides) {

                navs[i].style.display = 'none';
            }
        }

    }

    setActive(newActiveIndex, onSlideActive = true) {

        newActiveIndex = parseInt(newActiveIndex) || 0;


        let {slidesInView, sliderDom, navigationDom, navigationObject, currentActiveSlider} = this.params;


        let {children, clientWidth: sliderWidth} = sliderDom;

        let slidesLength = children.length;
        let lastSlideIndex = slidesLength - slidesInView;

        newActiveIndex = (newActiveIndex !== undefined) ? newActiveIndex : currentActiveSlider;
        newActiveIndex = newActiveIndex > lastSlideIndex ? lastSlideIndex : newActiveIndex;
        newActiveIndex = newActiveIndex < 0 ? 0 : newActiveIndex;

        let marginLeft = (newActiveIndex * sliderWidth) / slidesInView;

        sliderDom.style.transition = null;
        sliderDom.style.transform = `translateX(${-marginLeft}px)`;


        if (navigationObject) {
            if (newActiveIndex >= navigationObject.active + navigationObject.slidesInView) {
                navigationObject.active = (newActiveIndex + 1) - navigationObject.slidesInView;
            }

            if (newActiveIndex < navigationObject.active) {
                navigationObject.active = newActiveIndex;
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
            }

            let clickRelease = event => {

                endX = event.clientX || endX || startX;

                let move = startX - endX;

                startX = null;
                endX = null;

                if (move < -10 || move > +10) return;

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

                //nav.removeEventListener("mousedown", clickStart);
                //nav.removeEventListener("mouseup", clickRelease);
                //nav.addEventListener("mousedown", clickStart);
                //nav.addEventListener("mouseup", clickRelease);
            }
        }

    }

    set active(index) {
        this.setActive(index, false);
    }

    get active() {
        return this.params.currentActiveSlider;
    }

    get slidesInView() {
        return this.params.slidesInView;
    }

    get refresh() {
        this.init();
    }
}

class DraggableSlider extends TabSlider {

    constructor(params = {}) {

        const defaultDragOptions = {
            desktop: true,
            mobile: true,
            swipeDistance: 50,
            onSlideActive: true,
        };

        params = Object.assign(defaultDragOptions, params);

        super(params);

    }

    init() {
        super.init();
        this.initDragEvents();
    }

    setStyles() {
        super.setStyles();

        if (this.params.desktop)
            this.params.sliderDom.style.userSelect = 'none'

    }

    initDragEvents() {

        let isSwiping = false;
        let startX = null;
        let activeSlider = null;
        let mesureSpeed = null;
        let move = null;
        let speed = null;

        let startSwiping = (e) => {

            activeSlider = this.params.currentActiveSlider;

            if (!isSwiping) startX = e.clientX || e.targetTouches[0].pageX;
            isSwiping = true;

            let oldMove = 0;
            mesureSpeed = setInterval(_=> {

                speed = (move - oldMove) *2;
                oldMove = move

            }, 50);

        };

        let stopSwiping = () => {

            if (isSwiping) this.setActive(activeSlider, this.params.onSlideActive);
            isSwiping = false;

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

            move = startX - moveX;


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

            if (move < -swipeDistance || move > +swipeDistance) {


                activeSlider = currentActiveSlider;
                activeSlider = move > swipeDistance ? activeSlider + 1 : activeSlider;
                activeSlider = move < -swipeDistance ? activeSlider - 1 : activeSlider;


                if (move + speed < -slideWidth || move + speed > slideWidth ) {

                    activeSlider = Math.round((moveFromEdge > 0 ? speed + moveFromEdge : 0) / slideWidth);
                    activeSlider = Math.min(Math.max(activeSlider, 0), totalSlides);

                }
            }


            sliderDom.style.transition = 'none';
            sliderDom.style.transform = `translateX(${-Math.round(moveFromEdge)}px)`;


        };

        let {desktop, mobile, sliderDom} = this.params;


        if (desktop && !TabSlider.mobileAgent()) {

            sliderDom.removeEventListener('mousedown', startSwiping);
            sliderDom.addEventListener('mousedown', startSwiping);

            window.removeEventListener('mouseup', stopSwiping);
            window.addEventListener('mouseup', stopSwiping);

            window.removeEventListener('mousemove', whileSwiping);
            window.addEventListener('mousemove', whileSwiping);
        }

        if (mobile && TabSlider.mobileAgent()) {

            sliderDom.removeEventListener('touchstart', startSwiping);
            sliderDom.addEventListener('touchstart', startSwiping);

            window.removeEventListener('touchend', stopSwiping);
            window.addEventListener('touchend', stopSwiping);

            window.removeEventListener('touchmove', whileSwiping);
            window.addEventListener('touchmove', whileSwiping);
        }

    }

}




