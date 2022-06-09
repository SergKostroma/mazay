function forms() {
    $('.js-contacts-form').on('submit', function (e) {
        e.preventDefault();
        var _data = $(this).serializeObject(),
            canSendForm = true;

        for (var key in _data) {
            if (_data[key] === "") {
                canSendForm = false;
                $(this).find('input[name=' + key + ']').addClass('error');
                if (window.screen.width < 992) {
                    $(this).find('input[name=' + key + ']').closest('.contacts__input-container').css('margin-bottom', "28px");
                }
                $(this).find('input[name=' + key + ']').closest('.contacts__input-container').find('.message-error').text('Поле обязательно для заполнения').fadeIn();
            }
        }
        const self = $(this);
        if (canSendForm) {
            SendAjax("SEND_FORM", _data, function (data) {
                if (data) {
                    self.fadeOut('400');
                    setTimeout(function () {
                        self.siblings('.contacts__success').fadeIn()
                    }, 400);
                }
            })
        }

    });
    $('.js-validate-form input, .js-validate-form textarea').on('input, change', function () {
        focusInput($(this));
    });

    $('.js-validate-form input').on('input, change', function () {
        hideError($(this), '.contacts__input-container, .reservation__input-container');
    });

    $('.js-reservation-form-step-1').on('submit', function (e) {
        e.preventDefault();
        if ($('.js-custom-calendar.error').length > 0) {
            return false;
        }
        var _data = $(this).serializeObject(),
            canSendForm = true;

        for (var key in _data) {
            if (_data[key] === "") {
                canSendForm = false;
                $(this).find('input[name=' + key + ']').addClass('error');
                $(this).find('input[name=' + key + ']').closest('.main__input-container').find('.message-error').text('Поле обязательно для заполнения').fadeIn();
                if (window.screen.width < 992) {
                    $(this).find('input[name=' + key + ']').siblings('.main__date-label').css("color", "#D77846");
                    $(this).find('input[name=' + key + ']').closest('.main__input-container').addClass("error")
                }
                const self = $(this);
                setTimeout(function (i_local) {
                    return function () {
                        self.find('input[name=' + i_local + ']').removeClass('error');
                        self.find('input[name=' + i_local + ']').closest('.main__input-container').find('.message-error').fadeOut();
                        if (window.screen.width < 992) {
                            self.find('input[name=' + i_local + ']').siblings('.main__date-label').removeAttr('style');
                            self.find('input[name=' + i_local + ']').closest('.main__input-container').removeClass("error")
                        }
                    }
                }(key), 3000);
            }
        }

        if (canSendForm) {
            SendAjax("GET_DATES", _data, function (data) {
                if (!data["NOT_FOUND"]) {
                    window.location.href = window.location.origin + '/reservation/?step=2'
                } else {
                    $('.js-not-found').html(data["NOT_FOUND"]);
                }
            })
        }
    });
    $('.js-reservation-form-step-2').on('submit', function (e) {
        e.preventDefault();
        $(e.originalEvent.submitter).closest('.reservation__item').find('input[type=radio]').click();
        var _data = $(this).serializeObject();
        SendAjax("CHECKED_HOUSE", _data, function (data) {
            if (data) {
                window.location.href = window.location.origin + window.location.pathname + '?step=3'
            }
        });
    })
    $('.js-reservation-form-step-3').on('submit', function (e) {
        e.preventDefault();
        var _data = $(this).serializeObject(),
            canSendForm = true;

        for (var key in _data) {
            if (_data[key] === "" && key.indexOf("MIDDLE_NAME") == -1 && key !== "COMMENTS") {
                canSendForm = false;
                $(this).find('input[name=' + key + ']').addClass('error');
                $(this).find('input[name=' + key + ']').closest('.reservation__input-container').find('.message-error').text('Поле обязательно для заполнения').fadeIn();
            }
        }

        if (canSendForm) {
            SendAjax("ORDER", _data, function (data) {
                console.log(data);

                // window.location.href = window.location.origin + '/yoomoney/pay.php?id=' + data["ID"];

                if (data["STATUS"] !== "finish") {
                    window.location.href = window.location.origin + '/yoomoney/pay.php?id=' + data["ID"];
                } else {
                    window.location.href = window.location.origin + '/yoomoney/success.php?id=' + data["ID"];
                }
            })
        }
    });

    $('#firstName, #middleName, #lastName').on('keyup', function () {
        if (!$('#anotherMan').is(":checked")) {
            $('#' + $(this).attr('id') + '_0').val($(this).val()).trigger('change');
            focusInput($('#' + $(this).attr('id') + '_0'));
        }
    });

    $('#anotherMan').on('click', function () {
        if ($(this).is(":checked")) {
            $('#lastName_0, #middleName_0, #firstName_0').val('').removeClass('focused');
        } else {
            $('#lastName_0').val($('#lastName').val()).trigger('change');
            $('#middleName_0').val($('#middleName').val()).trigger('change');
            $('#firstName_0').val($('#firstName').val()).trigger('change');
        }
    });

    function focusInput(item) {
        if (item.val() === "") {
            // if (item.hasClass('js-custom-calendar')) {
            //     $('.js-main-calendar').removeClass('focused');
            // }
            item.removeClass('focused');
        } else {
            // if (item.hasClass('js-custom-calendar')) {
            //     $('.js-main-calendar').addClass('focused');
            // }
            item.addClass('focused');
        }
    }

    function hideError(item, child) {
        if (item.hasClass('error')) {
            item.removeClass('error');
            item.closest(child).find('.message-error').fadeOut();
            if (window.screen.width < 992) {
                item.closest(child).removeAttr('style');
            }
        }
    }
}