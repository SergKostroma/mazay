<header class="header">
    <div class="container">
        <div class="sm-hidden">
            <div class="header__top-block">
                <a href="<?= $arSettings["MAP_LINK"]["VALUE"] ?>" class="header__address">
                    <svg>
                        <use xlink:href="/dist/img/svg/sprite.svg#icon-mup"></use>
                    </svg>
                    <?= $arSettings["ADDRESS"]["VALUE"] ?>
                </a>
                <a href="/" class="header__logo" aria-label="Логотип Мазай">
                    <svg>
                        <use xlink:href="/dist/img/svg/sprite.svg#icon-logo"></use>
                </a>
                <a href="/reservation/" class="header__button btn">Забронировать</a>
            </div>
            <nav class="header__menu">
                <ul class="header__menu-list-items">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        array(
                            "ROOT_MENU_TYPE" => "header",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "360000",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_CACHE_GET_VARS" => "",
                            'CACHE_SELECTED_ITEMS' => 'N'
                        ),
                        false
                    );
                    ?>
                </ul>
            </nav>
        </div>
        <div class="header__mobile js-header-mobile">
            <div class="container">
                <div class="header__burger js-burger"><span></span></div>
                <a href="/" class="header__mobile-logo" aria-label="Логотип Мазай">
                    <svg>
                        <use xlink:href="/dist/img/svg/sprite.svg#icon-mobile-logo"></use>
                    </svg>
                </a>
                <a href="/reservation/" class="header__reservation">
                    <svg>
                        <use xlink:href="/dist/img/svg/sprite.svg#icon-reservation"></use>
                    </svg>
                </a>
                <div class="header__opened-container">
                    <div class="header__opened">
                        <ul class="header__mobile-menu">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top-mobile",
                                array(
                                    "ROOT_MENU_TYPE" => "header",
                                    "MAX_LEVEL" => "1",
                                    "CHILD_MENU_TYPE" => "left",
                                    "USE_EXT" => "N",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_TIME" => "360000",
                                    "MENU_CACHE_USE_GROUPS" => "N",
                                    "MENU_CACHE_GET_VARS" => "",
                                    'CACHE_SELECTED_ITEMS' => 'N'
                                ),
                                false
                            );
                            ?>
                        </ul>
                        <div class="header__opened-bottom">
                            <div class="header__mobile-address">
                                <svg>
                                    <use xlink:href="/dist/img/svg/sprite.svg#icon-mup"></use>
                                </svg>
                                <?= $arSettings["ADDRESS"]["VALUE"] ?>
                            </div>
                            <ul class="header__mobile-social">
                                <? foreach ($arSettings["SOCIAL"]["VALUE"] as $key => $social) : ?>
                                    <li class="header__mobile-social-item">
                                        <a href="<?= $arSettings["SOCIAL"]["DESCRIPTION"][$key] ?>"
                                           class="header__mobile-social-link"><?= $social ?></a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__fixed js-header hide">
            <div class="container">
                <div class="header__fixed-container">
                    <div class="header__logo header__logo--fixed">
                        <svg>
                            <use xlink:href="/dist/img/svg/sprite.svg#icon-logo"></use>
                        </svg>
                    </div>
                    <ul class="header__menu-list-items header__menu-list-items--fixed">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top",
                            array(
                                "ROOT_MENU_TYPE" => "header",
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "360000",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "MENU_CACHE_GET_VARS" => "",
                                'CACHE_SELECTED_ITEMS' => 'N'
                            ),
                            false
                        );
                        ?>
                    </ul>
                    <a href="/reservation/" class="btn header__button header__button--fixed">Забронировать</a>
                </div>
            </div>
        </div>
    </div>
</header>