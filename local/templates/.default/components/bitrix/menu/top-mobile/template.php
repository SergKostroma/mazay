<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? foreach ($arResult as $item) : ?>
    <li class="header__mobile-item">
        <a href="<?= $item["LINK"] ?>" class="header__mobile-link js-menu-link">
            <?= $item["TEXT"] ?>
        </a>
    </li>
<? endforeach; ?>