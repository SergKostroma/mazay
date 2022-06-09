<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="modal__main-title"><?= $arResult["NAME"] ?></div>
<div class="modal__main-desc"><?= $arResult["PREVIEW_TEXT"] ?></div>
<div class="modal__slider dots">
    <div class="modal__slider-container">
        <div class="modal__slider js-modal-slider">
            <? foreach ($arResult["PROPERTIES"]["SLIDER_IMG"]["VALUE"] as $slider): ?>
                <div class="modal__slide"
                     style="background-image: url(<?= CFile::GetPath($slider) ?>)"></div>
            <? endforeach; ?>
        </div>
        <div class="about__slider-controls js-modal-controls">
            <div class="about__counter"></div>
        </div>
    </div>
</div>
<div class="modal__text-container">
    <div class="modal__left">
        <div class="modal__title <?= ($arResult["HOUSE"]) ? 'm-hidden' : '' ?>"><?= $arResult["PROPERTIES"]["SUBTITLE"]["VALUE"] ?></div>
        <div class="modal__desc">
            <p class="modal__desc-1"><?= htmlspecialcharsBack($arResult["PROPERTIES"]["SUBTITLE_DESC_1"]["VALUE"]["TEXT"]) ?></p>
            <p class="modal__desc-2"><?= htmlspecialcharsBack($arResult["PROPERTIES"]["SUBTITLE_DESC_2"]["VALUE"]["TEXT"]) ?></p>
        </div>
    </div>
    <div class="modal__right">
        <? if ($arResult["HOUSE"]) : ?>
            <div class="modal__icons">
                <div class="modal__footage"><?= $arResult["HOUSE"]["PROPERTIES"]["FOOTAGE"]["VALUE"] ?> м<sup>2</sup>
                </div>
                <div class="modal__mans-count">до <?= $arResult["HOUSE"]["PROPERTIES"]["COUNT"]["VALUE"] ?> мест</div>
            </div>
            <div class="modal__advantages">
                <? foreach ($arResult["HOUSE"]["PROPERTIES"]["ADVANTAGES"]["VALUE"] as $advantage) : ?>
                    <div class="modal__advantage-item"><?= $advantage ?></div>
                <? endforeach; ?>
            </div>
            <div class="modal__price-container">
                <div class="modal__price-block">
<!--                    <div class="modal__price-title">Стоимость за 1 ночь</div>-->
<!--                    <div class="modal__price">--><?//= number_format($arResult["HOUSE"]["PROPERTIES"]["PRICE"]["VALUE"], 0, '.', ' '); ?>
<!--                        <span class="ruble">С</span></div>-->
                </div>
                <a href="/reservation/" class="btn-with-bg modal__btn-res">Забронировать</a>
            </div>
        <? else : ?>
            <? if ($arResult["EMPLOYEE"]) : ?>
                <div class="modal__right-title"><?= $arResult["EMPLOYEE"]["NAME"] ?></div>
                <div class="modal__specialization"><?= $arResult["EMPLOYEE"]["PROPERTIES"]["POSITION"]["VALUE"] ?></div>
                <div class="modal__right-phone"><?= $arResult["EMPLOYEE"]["PHONE"] ?></div>
                <div class="modal__photo">
                    <svg>
                        <use xlink:href="/dist/img/svg/sprite.svg#icon-chef"></use>
                    </svg>
                    <img src="<?= CFile::GetPath($arResult["EMPLOYEE"]["PREVIEW_PICTURE"]) ?>" alt="">
                </div>
                <div class="modal__right-bottom-title"><?= $arResult["EMPLOYEE"]["PROPERTIES"]["TITLE"]["VALUE"] ?></div>
                <div class="modal__right-desc"><?= $arResult["EMPLOYEE"]["PREVIEW_TEXT"] ?></div>
            <? endif; ?>
        <? endif; ?>
    </div>
</div>