function initAccordion() {
    $('.restaurants__bottom').on('click', function () {
        $('.restaurants__item.active').find('.restaurants__bg').slideToggle('slow');
        $('.restaurants__item').removeClass('active');
        $(this).closest('.restaurants__item').addClass('active');
        $(this).closest('.restaurants__item.active').find('.restaurants__bg').slideToggle('slow');
    });
}
