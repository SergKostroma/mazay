<script>
    var disabledDate = <?echo json_encode(checkCloseDates());?>
</script>
<section class="main" id="main">
    <div class="container">
        <h1 class="main__title">
            <?= $arMainPage["MAIN_BLOCK_NAME"]["VALUE"] ?>
        </h1>
        <div class="main__reservation-container dots">
            <div class="main__reservation">
                <img data-src="<?= CFile::GetPath($arMainPage["MAIN_BLOCK_IMG"]["VALUE"]) ?>" class="main__bg lozad" alt=""/>
                <?/*<form method="POST" class="main__reservation-bottom js-reservation-form-step-1 js-validate-form">
                    <label class="main__input-container">
                        <input class="main__date js-custom-calendar" type="text" name="ARRIVAL" id="arrival"/>
                        <span for="arrival" class="main__date-label">Заезд</span>
                        <span class="message-error sm-hidden">Обязательное поле!</span>
                    </label>
                    <label class="main__input-container">
                        <input class="main__date main__date--padding js-main-calendar" type="text" name="DEPARTURE" id="departure"/>
                        <span for="departure" class="main__date-label">Выезд</span>
                        <span class="message-error sm-hidden">Обязательное поле!</span>
                    </label>
                    <div class="main__select js-select-dropdown"><span class="quantity">2</span> взрослых
                        <div class="main__select-dropdown">
                            <div class="main__select-item">
                                <div class="main__select-title">Взрослые</div>
                                <div class="main__select-controls">
                                    <div class="main__select-down js-down-count"></div>
                                    <label class="main__select-quantity-label" for="adults">2</label>
                                    <input class="main__select-quantity" type="hidden" id="adults" name="ADULTS"
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
                                    <input class="main__select-quantity" type="hidden" id="child" name="CHILD"
                                           value="0">
                                    <div class="main__select-up js-up-count"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="main__button btn-with-bg" value="Проверить наличие номеров">
                </form>*/?>
            </div>
        </div>
        <div class="main__arrow-bottom">
            <img class="lozad" data-src="/app/img/svg/arrow-bottom.svg" alt="">
        </div>
    </div>
</section>