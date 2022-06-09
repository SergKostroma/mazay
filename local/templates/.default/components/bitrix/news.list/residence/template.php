<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="residence__items">
    <? foreach ($arResult["ITEMS"] as $key => $item) : ?>
        <a href="#modal" data-modal data-type="house" data-modal-id="<?= $item["PROPERTIES"]["MODAL_ID"]["VALUE"] ?>"
           data-id="<?= $item["ID"] ?>" class="residence__item lozad"
           data-background-image="<?= $item["PREVIEW_PICTURE"]["SRC"] ?>">
            <div class="residence__bottom">
                <div class="residence__bottom-text-block">
                    <div class="residence__item-title"><?= $item["NAME"] ?></div>
                    <div class="residence__item-desc">от <?= $item["PROPERTIES"]["PRICE"]["VALUE"] ?> <span
                                class="ruble">С</span> в сутки
                    </div>
                </div>
                <div class="residence__item-icons">
                    <div class="residence__houses"><?= $item["PROPERTIES"]["COUNT_HOUSES"]["VALUE"] ?></div>
                    <div class="residence__humans">до <?= $item["PROPERTIES"]["COUNT"]["VALUE"] ?></div>
                </div>
            </div>
        </a>
    <? endforeach; ?>
</div>
