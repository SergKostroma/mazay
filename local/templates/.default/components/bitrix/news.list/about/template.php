<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? foreach ($arResult["ITEMS"] as $item): ?>
    <? if ($item["SORT"] == "10" || $item["SORT"] == "40"): ?>
        <div class="js-staged-container js-m-static"
             data-opts='{delay: 0.1, opacity: 0.2, y: 100, stagger: 1, duration: 1, scale: 1}'>
            <div class="about__container about__container--slider js-staged">
                <div class="about__slider-container <?= ($item["SORT"] == "40") ? 'order' : '' ?>">
                    <div class="about__slider js-slider-about">
                        <? foreach ($item["PROPERTIES"]["PHOTOS"]["VALUE"] as $photo) : ?>
                            <div class="about__slider-item lozad"
                                 data-background-image="<?= CFile::GetPath($photo); ?>"></div>
                        <? endforeach; ?>

                    </div>
                    <div class="about__slider-controls js-slider-controls">
                        <div class="about__counter"></div>
                    </div>

                </div>
                <div class="about__text-block">
                    <div class="about__tag"><?= $item["PROPERTIES"]["TAG"]["VALUE"] ?></div>
                    <h3 class="about__title"><?= $item["NAME"] ?></h3>
                    <div class="about__description"><?= $item["PREVIEW_TEXT"] ?></div>
                    <? if ($item["PROPERTIES"]["LINK_NAME"]["VALUE"] || $item["PROPERTIES"]["FILE"]["VALUE"]) : ?>
                        <a href="<?= ($item["PROPERTIES"]["LINK"]["VALUE"]) ? $item["PROPERTIES"]["LINK"]["VALUE"] : CFile::GetPath($item["PROPERTIES"]["FILE"]["VALUE"]) ?>"
                           class="about__link link" target="_blank"><?= $item["PROPERTIES"]["LINK_NAME"]["VALUE"] ?></a>
                    <? endif; ?>
                </div>
            </div>
        </div>
    <? else: ?>

        <div class="about__container">
            <div class="about__text-block js-staged-container js-m-static"
                 data-opts='{delay: 0.1, opacity: 0.2, y: 100, stagger: 1, duration: 1, scale: 1}'>
                <div class="js-staged">
                    <div class="about__tag"><?= $item["PROPERTIES"]["TAG"]["VALUE"] ?></div>
                    <h3 class="about__title"><?= $item["NAME"] ?></h3>
                    <div class="about__description"><?= $item["PREVIEW_TEXT"] ?></div>
                    <? if ($item["PROPERTIES"]["LINK_NAME"]["VALUE"] || $item["PROPERTIES"]["FILE"]["VALUE"]) : ?>
                        <a href="<?= ($item["PROPERTIES"]["LINK"]["VALUE"]) ? $item["PROPERTIES"]["LINK"]["VALUE"] : CFile::GetPath($item["PROPERTIES"]["FILE"]["VALUE"]) ?>"
                           class="link" target="_blank"><?= $item["PROPERTIES"]["LINK_NAME"]["VALUE"] ?></a>
                    <? endif; ?>
                </div>
            </div>
            <div class="about__img-block">
                <div class="about__stump-container m-hidden js-staged-container js-m-static"
                     data-opts='{delay: 0.1, opacity: 0.2, y: 100, stagger: 1, duration: 1, scale: 1}'>
                    <span class="about__stump js-staged"></span>
                </div>


                <div class="about__first-img <?= ($item["SORT"] == "30") ? 'about__first-img--border' : '' ?> js-staged-container js-m-static"
                     data-opts='{delay: 0.1, opacity: 0.2, y: 100, stagger: 1, duration: 1.5, scale: 1}'>
                    <div class="about__first-img-block js-staged">
                        <img data-src="<?= CFile::GetPath($item["PROPERTIES"]["PHOTOS"]["VALUE"][0]) ?>" alt=""
                             class="m-hidden lozad">
                        <img data-src="<?= CFile::GetPath($item["PROPERTIES"]["PHOTOS_MOBILE"]["VALUE"][0]) ?>" alt=""
                             class="m-show lozad">
                    </div>
                </div>
                <div class="about__last-img <?= ($item["SORT"] == "30") ? 'about__last-img--border' : '' ?> js-staged-container js-m-static"
                     data-opts='{delay: 0.1, opacity: 0.2, y: 100,  stagger: 1, duration: 1.5, scale: 1}'>
                    <div class="about__last-img-block js-staged">
                        <img data-src="<?= CFile::GetPath($item["PROPERTIES"]["PHOTOS"]["VALUE"][1]) ?>" alt=""
                             class="m-hidden lozad">
                        <img data-src="<?= CFile::GetPath($item["PROPERTIES"]["PHOTOS_MOBILE"]["VALUE"][1]) ?>" alt=""
                             class="m-show lozad">
                    </div>
                </div>
            </div>
        </div>
    <? endif; ?>
<? endforeach; ?>