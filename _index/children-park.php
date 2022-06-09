<section class="children-park" id="children-park">
    <div class="container">
        <div class="children-park__top-svg">
            <svg>
                <use xlink:href="/dist/img/svg/sprite.svg#icon-hares-3"></use>
            </svg>
        </div>
        <h2 class="children-park__title"><?= $arMainPage["CHILDREN_NAME"]["VALUE"] ?></h2>
        <div class="children-park__desc"><?= $arMainPage["CHILDREN_DESC"]["VALUE"] ?></div>
        <div class="children-park__slider-container dots">
            <div class="children-park__slider js-slider-about">
                <? foreach ($arMainPage["CHILDREN_SLIDER"]["VALUE"] as $childrenSlider) : ?>
                    <div class="children-park__slide lozad"
                         data-background-image="<?= CFile::GetPath($childrenSlider) ?>"></div>
                <? endforeach; ?>
            </div>
            <div class="about__slider-controls js-slider-controls">
                <div class="about__counter"></div>
            </div>
        </div>
        <div class="js-staged-container js-m-static"
             data-opts='{delay: 0.1, opacity: 0, y: 100, stagger: 1, duration: 1, scale: 0.9}'>

            <? $APPLICATION->IncludeComponent("bitrix:news.list", "children-park", Array(
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => IBLOCK_CHILDREN_PARK,
                    "NEWS_COUNT" => "4",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER2" => "DESC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => Array("SORT"),
                    "PROPERTY_CODE" => Array("DESCRIPTION"),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "Y",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "Y",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "Y",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "Y",
                    "PAGER_BASE_LINK_ENABLE" => "Y",
                    "SET_STATUS_404" => "Y",
                    "SHOW_404" => "Y",
                    "MESSAGE_404" => "",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => ""
                )
            ); ?>

        </div>
    </div>
</section>