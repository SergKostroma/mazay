function initSlider() {
    const sliders = $('.js-slider-about');
    const controlls = $('.js-slider-controls');
    const dots = $('.about__dots');
    for (var i = 0; i < sliders.length; i++) {
        $(sliders[i]).owlCarousel({
            items: 1,
            loop: false,
            center: false,
            margin: 6,
            autoWidth: false,
            nav: true,
            dots: false,
            smartSpeed: 700,
            lazyLoad: true,
            navText: ['<span></span>', '<span></span>'],
            navContainer: $(controlls[i]),
            onInitialized: counter,
            onChanged: counter,
        });
    }

    $('.js-reservation-slider').owlCarousel({
        items: 1,
        loop: false,
        center: false,
        margin: 6,
        autoWidth: false,
        dots: true,
        smartSpeed: 700,
    });

    function counter(event) {
        if (!event.namespace) {
            return;
        }
        var slides = event.relatedTarget;

        slides.$element.siblings('.about__slider-controls').find('.about__counter').html('<span> ' + (Number(slides._current) + 1) + '</span>/' + slides.items().length);
    }

}
