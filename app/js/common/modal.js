function modal() {
    $("a[data-modal]").on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            modal = $(this).attr('href'),
            type = $(this).data('type'),
            modalId = $(this).data('modal-id');
        if (!modalId) return;
        SendAjax("OPEN_MODAL", {"ID": id, "TYPE": type, "MODAL_ID": modalId}, function (data) {
            if (data) {
                $('.js-replace-modal').html(data);
                $('.js-modal-slider').owlCarousel({
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
                    navContainer: $('.js-modal-controls'),
                    onInitialized: counter,
                    onChanged: counter,
                });

                function counter(event) {
                    if (!event.namespace) {
                        return;
                    }
                    var slides = event.relatedTarget;

                    slides.$element.siblings('.about__slider-controls').find('.about__counter').html('<span> ' + (Number(slides._current) + 1) + '</span>/' + slides.items().length);
                }

                $(modal).modal({
                    fadeDuration: 700,
                    fadeDelay: 0.5
                });
            }
        });
    })
}