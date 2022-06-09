<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="restaurants__list dots">
    <? foreach ($arResult["ITEMS"] as $key => $item) : ?>
        <div class="restaurants__item <?= ($key == 0) ? 'active' : '' ?>">
            <div class="restaurants__bg lozad"
                 data-background-image="<?= $item["PREVIEW_PICTURE"]["SRC"] ?>" <?= ($key == 0) ? 'style="display:block;"' : '' ?>></div>
            <div class="restaurants__bottom">
                <div class="restaurants__left">
                    <div class="restaurants__title"><?= $item["NAME"] ?></div>
                    <div class="restaurants__desc"><?= $item["PREVIEW_TEXT"] ?></div>
                </div>
                <div class="restaurants__right">
                    <div class="restaurants__arrow"></div>
                    <a href="<?= $item["DETAIL_TEXT"] ?>" target="_blank" class="restaurants__button btn">Меню ресторана</a>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>