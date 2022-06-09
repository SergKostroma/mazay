<div class="header-reservation">
    <div class="container">
        <div class="header-reservation__container">
            <div class="header-reservation__phones">
                <div class="header-reservation__phone">
                    <a href="tel:<?= preg_replace("#\D#", "", $arSettings["PHONE_RECEPTION"]["VALUE"]) ?>" class="header-reservation__phone-number"><?= $arSettings["PHONE_RECEPTION"]["VALUE"]?></a>
                    <div class="header-reservation__phone-desc">Ресепшн и Бронирование</div>
                </div>
            </div>
            <a href="/" class="header-reservation__logo">
                <svg>
                    <use xlink:href="/dist/img/svg/sprite.svg#icon-logo"></use>
                </svg>
            </a>
        </div>
    </div>
</div>