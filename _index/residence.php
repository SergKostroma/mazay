<section class="residence js-staged-container js-m-static"
         data-opts='{delay: 0.1, opacity: 0, y: 100, stagger: 1, duration: 1, scale: 0.9}' id="residence">
    <div class="container js-staged">
        <div class="residence__top-svg">
            <svg>
                <use xlink:href="/dist/img/svg/sprite.svg#icon-window"></use>
            </svg>
        </div>
        <h2 class="residence__title"><?= $arMainPage["RESIDENCE_NAME"]["VALUE"] ?></h2>
        <div class="residence__desc"><?= $arMainPage["RESIDENCE_DESC"]["VALUE"]["TEXT"] ?></div>
        <? $APPLICATION->IncludeComponent("bitrix:news.list", "residence", Array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => IBLOCK_RESIDENCE,
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
        <div class="residence__bottom-block dots">
            <div class="residence__bottom-bg"></div>
            <video loop="loop" muted="muted" autoplay="autoplay" playsinline class="lozad">
                <source data-src="<?= CFile::GetPath($arMainPage["VIDEO_2"]["VALUE"]) ?>"
                        type="video/mp4">
            </video>
            <div class="residence__bottom-text"><?= $arMainPage["TEXT_VIDEO_2"]["VALUE"] ?></div>
        </div>
    </div>
</section>