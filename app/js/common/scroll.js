function scrollLink() {
    $(document).on('click', '.js-menu-link', function (e) {
        e.preventDefault();
        if (window.screen.width <= 576) {
            $('.js-burger').click();
        }
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 1000, 'linear');

    });
}

function zoomOnScroll() {
    if (window.screen.width > 991) {
        $(document).on("scroll", function (e) {
            if ($('body').hasClass('js-burger')) {
                e.preventDefault();
                return false;
            }
            if ($(this).scrollTop() <= 700) {
                $('.main__bg').css('transform', 'translate(-50%,-50%) scale(' + (1.2 - ($(this).scrollTop() / 3500)) + ')');
            }
        });
    }
}
