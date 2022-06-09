function daterangepickerSettings() {
    let $container = $('.js-inputs');
    let $mainCalendar = $('.js-custom-calendar');
    let $twiceCalendar = $('.js-main-calendar');

    let year = new Date();
    year.setDate(year.getDate() + 364);

    $container.dateRangePicker({
        autoClose: false,
        format: 'DD.MM.YYYY',
        separator: '-',
        language: 'ru',
        startOfWeek: 'monday',// or monday
        startDate: new Date(),
        endDate: year,
        showShortcuts: false,
        customShortcuts: [],
        inline: false,
        container: 'body',
        alwaysOpen: false,
        singleDate: false,
        lookBehind: false,
        duration: 200,
        customOpenAnimation: function (cb) {
            $(this).fadeIn(300, cb);
        },
        customCloseAnimation: function (cb) {
            $(this).fadeOut(300, cb);
        },
        beforeShowDay: function (time) {
            let dd = String(time.getDate()).padStart(2, '0');
            let mm = String(time.getMonth() + 1).padStart(2, '0');
            let yyyy = time.getFullYear();
            let date = dd + '.' + mm + '.' + yyyy;
            let valid = true;
            let _class = 'date-green';
            let _tooltip = valid ? '' : 'Нет свободных номеров';
            console.log(disabledDate);
            console.log(date);
            console.log();
            if (inObject(disabledDate, date)) {
                valid = false;
                _class = 'day-disabled';
                console.log('disabled');

            }
            return [valid, _class, _tooltip];
        },
        stickyMonths: true,
        dayDivAttrs: [],
        dayTdAttrs: [],
        customArrowPrevSymbol: '<span class="reservation-calendar__prev-arrow"></span>',
        customArrowNextSymbol: '<span class="reservation-calendar__next-arrow"></span>',
        applyBtnClass: '',
        singleMonth: 'auto',
        showDateFilter: function(time, date)
        {
            let t = new Date(time);
            let dd = String(t.getDate()).padStart(2, '0');
            let mm = String(t.getMonth() + 1).padStart(2, '0');
            let yyyy = t.getFullYear();
            let day = dd + '.' + mm + '.' + yyyy;
            if (datesPrices[day]) {
                let sale = '';
                if (datesPrices[day].IS_SALE != false) sale = 'color: red;';
                return '<div class="div-date">\
					<span class="span-date">'+date+'</span>\
					<div class="div-price" style=" ' + sale + '">от ' + datesPrices[day].PRICE + ' ₽</div>\
				</div>';
            } else {
                return '<div class="div-date">\
					<span class="span-date">'+date+'</span>\
				</div>';
            }

        },
        showTopbar: false,
        swapTime: false,
        selectForward: true,
        showWeekNumbers: false,
        getWeekNumber: function (date) //date will be the first day of a week
        {
            return moment(date).format('w');
        },
        monthSelect: false,
        yearSelect: false,
        getValue: function () {
            if ($mainCalendar.val() && $twiceCalendar.val())
                return $mainCalendar.val() + ' to ' + $twiceCalendar.val();
            else
                return '';
        },
        setValue: function (s, s1, s2) {
            $mainCalendar.val(s1).addClass('focused');
            $twiceCalendar.val(s2).addClass('focused');
        }
    })

    // $twiceCalendar.on('click', function (e) {
    //     e.preventDefault();
    //     console.log('aaa');
    //     setTimeout(function () {
    //         $mainCalendar.data('dateRangePicker').open();
    //     }, 100);
    //
    // });

    // $mainCalendar.ready(function () {
    //     setTimeout(function () {
    //         $mainCalendar.val('')
    //     }, 500)
    // });

    // $mainCalendar.daterangepicker({
    //     minDate: new Date(),
    //     autoApply: true,
    //     locale: {
    //         "format": 'DD.MM.YYYY',
    //         "daysOfWeek": [
    //             "Вс",
    //             "Пн",
    //             "Вт",
    //             "Ср",
    //             "Чт",
    //             "Пт",
    //             "Сб"
    //         ],
    //         "monthNames": [
    //             "Январь", // заменяем на Январь
    //             "Февраль", // Февраль и т д
    //             "Март",
    //             "Апрель",
    //             "Май",
    //             "Июнь",
    //             "Июль",
    //             "Август",
    //             "Сентябрь",
    //             "Октябрь",
    //             "Ноябрь",
    //             "Декабрь"
    //         ],
    //         "firstDay": 1
    //     },
    //     "drops": "up",
    //     isCustomDate: function (date) {
    //         if ($.inArray(date.format('DD.MM.YYYY'), disabledDate) > -1) {
    //             return 'off disabled';
    //         }
    //     },
    //     isInvalidDate: function (date) {
    //         if ($.inArray(date.format('DD.MM.YYYY'), disabledDate) > -1) {
    //             return true;
    //         }
    //     }
    // });

}

function inObject(obj, val) {
    return Object.keys(obj).filter(function(key) {
        return obj[key] === val;
    }).length > 0;
}