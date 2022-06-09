<? $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => IBLOCK_ORDER, "CODE" => "PAY_METHOD"));
while ($enum_fields = $property_enums->GetNext()) {
    $pay_methods[] = $enum_fields;
}

$arrival = $_SESSION['RESERVATION_INFO']['ARRIVAL'];
$departure = $_SESSION['RESERVATION_INFO']['DEPARTURE'];

$availablePlaces = (int)$_SESSION['RESERVATION_LAST']['INFO']['COUNT']['VALUE'];
$persons = (int)$_SESSION['RESERVATION_LAST']['COUNT_ADULTS'] + (int)$_SESSION['RESERVATION_LAST']['COUNT_CHILD'];
$neededHouses = ceil($persons / $availablePlaces);

$dates = getPricesByHouseSection($arrival, $departure, $_SESSION['RESERVATION_LAST']['ID']);

$totalPrice = 0;

foreach ($dates as $date) {
    $totalPrice += $date['PRICE'];
}

$_SESSION["RESERVATION_LAST"]["SUM"] = $totalPrice * $neededHouses;

?>
<div class="reservation">
    <div class="reservation__main-title reservation__main-title--step-3 sm-show">Оформление бронирования</div>
    <div class="container reservation__step-3-container">
        <div class="reservation__container">
            <div class="reservation__main-title sm-hidden">Оформление бронирования</div>
            <form method="POST" action="" class="reservation__form-3 js-reservation-form-step-3 js-validate-form">
                <div class="reservation__title">Контактные данные</div>
                <div class="reservation__inputs">
                    <div class="reservation__input-container">
                        <input type="text" class="reservation__input" id="lastName" name="LAST_NAME">
                        <label for="lastName" class="reservation__label">Фамилия</label>
                        <span class="message-error">Обязательное поле!</span>
                    </div>
                    <div class="reservation__input-container">
                        <input type="text" class="reservation__input" id="firstName" name="FIRST_NAME">
                        <label for="firstName" class="reservation__label">Имя</label>
                        <span class="message-error">Обязательное поле!</span>
                    </div>
                    <div class="reservation__input-container">
                        <input type="text" class="reservation__input not-req" id="middleName" name="MIDDLE_NAME">
                        <label for="middleName" class="reservation__label">Отчество</label>
                        <span class="message-error">Обязательное поле!</span>
                    </div>
                    <div class="reservation__input-container">
                        <input type="email" class="reservation__input" id="email" name="EMAIL">
                        <label for="email" class="reservation__label">Эл. почта</label>
                        <span class="message-error">Обязательное поле!</span>
                    </div>
                    <div class="reservation__input-container">
                        <input type="text" class="reservation__input" id="phone" name="PHONE">
                        <label for="phone" class="reservation__label">Телефон</label>
                        <span class="message-error">Обязательное поле!</span>
                    </div>
                </div>
                <input type="checkbox" class="reservation__checkbox" name="ANOTHER_MAN" id="anotherMan">
                <label for="anotherMan" class="reservation__checkbox-label">Я бронирую для другого человека</label>
<!--                <div class="reservation__title">Информация о гостях</div>-->
<!--                --><?// for ($i = 0; $i < ($_SESSION["RESERVATION_INFO"]["ADULTS"] + $_SESSION["RESERVATION_INFO"]["CHILD"]); $i++) : ?>
<!--                    <div class="reservation__inputs">-->
<!--                        <div class="reservation__input-container">-->
<!--                            <input type="text" class="reservation__input" id="lastName_--><?//= $i ?><!--"-->
<!--                                   name="LAST_NAME_--><?//= $i ?><!--">-->
<!--                            <label for="lastName_--><?//= $i ?><!--" class="reservation__label">Фамилия</label>-->
<!--                            <span class="message-error">Обязательное поле!</span>-->
<!--                        </div>-->
<!--                        <div class="reservation__input-container">-->
<!--                            <input type="text" class="reservation__input" id="firstName_--><?//= $i ?><!--"-->
<!--                                   name="FIRST_NAME_--><?//= $i ?><!--">-->
<!--                            <label for="firstName_--><?//= $i ?><!--" class="reservation__label">Имя</label>-->
<!--                            <span class="message-error">Обязательное поле!</span>-->
<!--                        </div>-->
<!--                        <div class="reservation__input-container">-->
<!--                            <input type="text" class="reservation__input not-req" id="middleName_--><?//= $i ?><!--"-->
<!--                                   name="MIDDLE_NAME_--><?//= $i ?><!--">-->
<!--                            <label for="middleName_--><?//= $i ?><!--" class="reservation__label">Отчество</label>-->
<!--                            <span class="message-error">Обязательное поле!</span>-->
<!--                        </div>-->
<!--                        <div class="reservation__input-container">-->
<!--                            <input type="text" class="reservation__input" id="nationality" name="NATIONALITY_--><?//= $i ?><!--">-->
<!--                            <label for="nationality" class="reservation__label">Гражданство</label>-->
<!--                            <span class="message-error">Обязательное поле!</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?// endfor; ?>
                <div class="reservation__warning">
                    Пожалуйста, на забудьте взять с собой паспорт. Заселение производится при наличии паспорта у каждого
                    Гостя. Для детей — копии свидетельства о рождении.
                </div>
                <div class="reservation__title">Время заезда</div>
                <div class="reservation__time">Стандартное время заезда — 16:00, выезда — 13:00.</div>
                <div class="reservation__title">Дополнительные комментарии</div>
                <div class="reservation__comments-container">
                    <textarea name="COMMENTS" id="comments" class="reservation__comments reservation__input"></textarea>
                    <label for="comments" class="reservation__label">Если есть какие-то пожелания, укажите их
                        здесь</label>
                </div>
                <div class="reservation__title">Выбор способа оплаты</div>
                <div class="reservation__pay-methods">
                    <? foreach ($pay_methods as $key => $item) : ?>
                        <div class="reservation__pay-method">
                            <input type="radio" name="PAY_METHOD" id="pay-method-<?= $item["ID"] ?>"
                                   value=" <?= $item["ID"] ?>" <?= ($key == 0) ? 'checked' : '' ?>>
                            <label for="pay-method-<?= $item["ID"] ?>">
                                <?= $item["VALUE"] ?>
                            </label>
                        </div>
                    <? endforeach; ?>
                </div>
                <div class="reservation__bottom-price-block">
                    <div class="reservation__bottom-price-text">
                        <div class="reservation__bottom-price-title">
                            Стоимость
                            за <?= count($dates) ?>
                            ночи
                        </div>
                        <div class="reservation__bottom-price">
                            <?= $totalPrice * $neededHouses ?> <span class="ruble">С</span>
                        </div>
                    </div>
                    <input type="submit" value="Забронировать" class="btn-with-bg reservation__submit">
                </div>
            </form>
        </div>
        <div class="reservation__info-container js-sticky" data-margin-top="40">
            <div class="reservation__info-title"><?= $_SESSION["RESERVATION_LAST"]["NAME"] ?></div>
            <div class="reservation__info-list">
                <div class="reservation__info-item">
                    <span>гости</span>
                    <?= ($_SESSION["RESERVATION_INFO"]["ADULTS"] == "1") ? "{$_SESSION["RESERVATION_INFO"]["ADULTS"]} взрослый" : "{$_SESSION["RESERVATION_INFO"]["ADULTS"]} взрослых" ?>
                    <? if ($_SESSION["RESERVATION_INFO"]["CHILD"]) : ?>
                        , <?= ($_SESSION["RESERVATION_INFO"]["CHILD"] == "1") ? "{$_SESSION["RESERVATION_INFO"]["CHILD"]} ребенок" : "{$_SESSION["RESERVATION_INFO"]["CHILD"]} детей" ?>
                    <? endif; ?>
                </div>
                <div class="reservation__info-item">
                    <span>заезд</span>
                    <?= $_SESSION["RESERVATION_INFO"]["ARRIVAL"] ?>
                </div>
                <div class="reservation__info-item">
                    <span>выезд</span>
                    <?= $_SESSION["RESERVATION_INFO"]["DEPARTURE"] ?>
                </div>
            </div>
            <div class="reservation__info-price-title">Стоимость
                за <?= count($dates) ?> ночи
            </div>
            <div class="reservation__info-price js-price-button"><?= $totalPrice * $neededHouses ?> <span
                        class="ruble">С</span> за <?= $neededHouses ?> <?= $_SESSION["RESERVATION_LAST"]["ID"] == 1 ? ' номер(а)' : ' дом(а)'?></div>
            <div class="reservation__info-price-list js-list-content">
                <? foreach ($dates as $day => $date) : ?>
                    <div class="reservation__info-price-list__item <?= $date['IS_SALE'] == true ? 'hot' : ''?>">
                        <span><?= $day ?></span>
                            <?= $date['PRICE'] * $neededHouses ?> ₽
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>