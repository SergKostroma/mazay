function loader() {
    var loaded = false;
    var animationend = false;
    $(window).on('load', function () {
        loaded = true;
        if (animationend) {
            $('.preloader').fadeOut(3000);
        }
    });
    $('.js-preloader-logo').on('animationend', function () {
        animationend = true;
        if (loaded) {
            $('.preloader').fadeOut(3000);
        }
    });
}