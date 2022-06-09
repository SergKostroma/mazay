<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="events__items dots">
    <? foreach ($arResult["ITEMS"] as $item) : ?>
        <a href="#modal" class="events__item lozad" data-background-image="<?= $item["PREVIEW_PICTURE"]["SRC"]?>" data-modal data-modal-id="<?= $item["PROPERTIES"]["MODAL_ID"]["VALUE"] ?>">
            <div class="events__item-bottom">
                <div class="events__item-title"><?= $item["NAME"]?></div>
                <div class="events__item-desc"><?= $item["PREVIEW_TEXT"]?></div>
                <div class="events__item-arrow"></div>
            </div>
        </a>
    <? endforeach; ?>
</div>