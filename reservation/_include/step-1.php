<script>
    let disabledDate = <?= json_encode(checkCloseDates());?>;
    let datesPrices = <?= json_encode(getDatesMinimalPrices());?>;
</script>


<div class="reservation">
    <div class="container" data-has-calendar="y">
        <h1 class="reservation__main-title">Выберите даты пребывания</h1>
        <form method="POST" class="reservation__form js-reservation-form-step-1 js-validate-form">
            <div class="js-inputs" style="display: flex">
                <div class="main__input-container">
                    <input class="main__date js-custom-calendar" type="text" name="ARRIVAL" id="arrival"/>
                    <label for="arrival" class="main__date-label">Заезд</label>
                    <span class="message-error sm-hidden">Обязательное поле!</span>
                </div>
                <div class="main__input-container">
                    <input class="main__date main__date--padding js-main-calendar" type="text" name="DEPARTURE" id="departure"/>
                    <label for="departure" class="main__date-label">Выезд</label>
                    <span class="message-error sm-hidden">Обязательное поле!</span>
                </div>
            </div>
            <div class="main__select js-select-dropdown"><span class="quantity">2</span> взрослых
                <div class="main__select-dropdown">
                    <div class="main__select-item">
                        <div class="main__select-title">Взрослые</div>
                        <div class="main__select-controls">
                            <div class="main__select-down js-down-count"></div>
                            <label class="main__select-quantity-label" for="adults">2</label>
                            <input class="main__select-quantity" type="hidden" id="adults" name="ADULTS" readonly
                                   value="2">
                            <div class="main__select-up js-up-count"></div>
                        </div>
                    </div>
                    <div class="main__select-item">
                        <div class="main__select-item-text">
                            <div class="main__select-title">Дети</div>
                            <div class="main__select-desc">от 0 до 17 лет</div>
                        </div>
                        <div class="main__select-controls" data-child="true">
                            <div class="main__select-down js-down-count disabled"></div>
                            <label class="main__select-quantity-label " for="child">0</label>
                            <input class="main__select-quantity" type="hidden" id="child" name="CHILD" readonly
                                   value="0">
                            <div class="main__select-up js-up-count"></div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="main__button btn-with-bg" value="Проверить наличие номеров">
        </form>
        <div class="js-not-found"></div>
    </div>
</div>