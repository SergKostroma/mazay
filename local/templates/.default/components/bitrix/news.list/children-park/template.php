<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="children-park__items js-staged">
    <? foreach ($arResult["ITEMS"] as $item) : ?>
    <a href="#modal" data-modal data-modal-id="<?= $item["PROPERTIES"]["MODAL_ID"]["VALUE"] ?>" class="children-park__item">
        <div class="children-park__left lozad" data-background-image="<?= $item["PREVIEW_PICTURE"]["SRC"] ?>"></div>
        <div class="children-park__right">
            <div class="children-park__item-title"><?= $item["NAME"] ?></div>
            <div class="children-park__item-desc"><?= $item["PREVIEW_TEXT"] ?></div>
            <div class="children-park__item-age"><?= $item["PROPERTIES"]["AGE"]["VALUE"] ?></div>
            <div class="children-park__item-arrow"></div>
        </div>
    </a>
    <? endforeach; ?>
</div>