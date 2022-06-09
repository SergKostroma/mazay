function burger() {
    $('.js-burger').on('click', function () {
        if (!$(this).hasClass('active')) {
            scrollLock.disablePageScroll();
        } else {
            scrollLock.enablePageScroll();
            scrollLock.clearQueueScrollLocks();
            scrollLock.getScrollState();
        }
        $(this).toggleClass('active');
        $(this).closest('.header__mobile').toggleClass('open');
        $(this).closest('.header__mobile').find('.header__opened-container').fadeToggle();
    })
}