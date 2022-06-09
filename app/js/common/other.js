function other() {
    $('input[name=PHONE]').mask('+7(999)-999-99-99');
    $('.js-select-dropdown').on('click', function () {
        $(this).addClass('active');
        $(this).find('.main__select-dropdown').fadeIn();
    });
    $(document).click(function (e) {
        if (!($(e.target).closest('.js-select-dropdown').length) && $('.js-select-dropdown').hasClass('active')) {
            $(this).find('.main__select-dropdown').fadeOut();
        }
    });
    $('.js-down-count').on('click', function () {
        var $selectCount = $(this).closest('.main__select-controls').find('.main__select-quantity'),
            $selectCountLabel = $(this).closest('.main__select-controls').find('.main__select-quantity-label'),
            $selectCountMain = $(this).closest('.js-select-dropdown').find('span.quantity'),
            disabled = [];

        if ($selectCount.attr('name') === "CHILD") {
            disabled = ['0', '1'];
        } else {
            disabled = ['1', '2'];
        }

        if ($selectCount.val() === disabled[0]) {
            return false
        }
        if ($selectCount.val() === disabled[1]) {
            $(this).addClass('disabled');
            $selectCountLabel.addClass('disabled');
        }
        if ($selectCount.text() === '0') return false;
        $selectCount.val(Number($selectCount.val()) - 1);
        $selectCountLabel.text(Number($selectCountLabel.text()) - 1);
        if (!$(this).closest('.main__select-controls').data('child')) {
            $selectCountMain.text(Number($selectCount.val()));
        }
    });
    $('.js-up-count').on('click', function () {
        var $selectCount = $(this).closest('.main__select-controls').find('.main__select-quantity'),
            $selectCountLabel = $(this).closest('.main__select-controls').find('.main__select-quantity-label'),
            $selectDown = $(this).closest('.main__select-controls').find('.js-down-count'),
            $selectCountMain = $(this).closest('.js-select-dropdown').find('span.quantity'),
            disabled = '';

        if ($selectCount.attr('name') === "CHILD") {
            disabled = '0';
        } else {
            disabled = '1';
        }

        if ($selectCount.val() === disabled) {
            $selectDown.removeClass('disabled');
            $selectCountLabel.removeClass('disabled');
        }
        $selectCount.val(Number($selectCount.val()) + 1);
        $selectCountLabel.text(Number($selectCountLabel.text()) + 1);
        if (!$(this).closest('.main__select-controls').data('child')) {
            $selectCountMain.text(Number($selectCount.val()));
        }
    });
    const observer = lozad('.lozad', {
        threshold: 0.1,
        enableAutoReload: true
    });
    observer.observe();
    if (window.screen.width > 991) {
        new Sticky('.js-sticky');
    }

    $('.js-price-button').on('click', function () {
        $(this).toggleClass('active');
        $(this).siblings('.js-list-content').slideToggle(300);
    });

    if (window.screen.width < 991 && $('.breadcrumbs__step.active').length > 0) {
        $(".js-scroll-left").animate({scrollLeft: $('.breadcrumbs__step.active').position().left}, 1500);
    }
    $('.js-copy').on('click', function () {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(this).text()).select();
        document.execCommand("copy");
        $temp.remove();
        $(this).addClass('copied');
        self = $(this);
        setTimeout(function () {
            self.removeClass('copied')
        }, 7000)
    });

    $('body').on('click', '[href="/reservation/"]', function (event) {
        event.preventDefault();
        $('#custom-modal-error').modal();
        $('.jquery-modal').addClass('no-before');
        if ($(window).width() < 992) {
            $('#custom-modal-error').removeClass('modal');
        }

        console.log('без брони');
    })
}

