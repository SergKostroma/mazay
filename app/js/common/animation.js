function initAnimation() {

    document.querySelectorAll('.js-staged-container').forEach(function ($container) {
/*        if (window.innerWidth < 768) {
            if ($container.classList.contains('js-m-static')) return;
        }*/

        var $els = $container.querySelectorAll('.js-staged');

        var stringObj = $container.dataset.opts;
        eval('var obj=' + stringObj);


        var opts = {}
        for (var key in obj) {
            opts[key] = obj[key];
        }

        if (!opts['delay']) opts['delay'] = 0.3;
        if (!opts['opacity']) opts['opacity'] = 0;
        if (!opts['stagger']) opts['stagger'] = 0.3;
        if (!opts['scale']) opts['scale'] = 0;
        if (!opts['duration']) opts['duration'] = .8;
        if (!opts['ease']) opts['ease'] = 'power1.inOut';

        var t = gsap.from($els, opts);

        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene({
            triggerElement: $container,
            triggerHook: 0.7
        })
            .setTween(t)
            .addTo(controller);
    })

    var controller = new ScrollMagic.Controller();

    if ($(".js-parallax-text").length) {
        var scene = new ScrollMagic.Scene({triggerHook: 1, triggerElement: ".js-parallax-text", duration: 1800})
            .setTween(".js-parallax-text", {y: -150, ease: 'power1.inOut', stagger: 0.1})
            .addTo(controller);
        var scene = new ScrollMagic.Scene({triggerHook: 1, triggerElement: ".js-parallax-text-2", duration: 1800})
            .setTween(".js-parallax-text-2", {y: -150, ease: 'power1.inOut', stagger: 0.1})
            .addTo(controller);
    }

    if (window.screen.width > 576) {
        /*var scene = new ScrollMagic.Scene({triggerHook: 1, triggerElement: ".js-img-parallax", duration: 1800})
            .setTween(".js-img-parallax", {y: 30, ease: 'power1.inOut', stagger: 0.1})
            .addTo(controller);*/
    }
}