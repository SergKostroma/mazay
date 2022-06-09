<section class="about-text">
    <div class="container">
        <div class="about-text__hares js-staged-container js-m-static"
             data-opts='{delay: 0.1, opacity: 0, y: 50, stagger: 1, duration: 1, scale: 1}'>
            <svg class="js-staged">
                <use xlink:href="/dist/img/svg/sprite.svg#icon-hares"></use>
            </svg>
        </div>
        <div class="about-text__container js-staged-container js-m-static"
             data-opts='{delay: 0.1, opacity: 0, y: 50, stagger: 1, duration: 1, scale: 1}'>
            <div class="ovh js-staged">
                <div class="about-text__background js-parallax-text lozad"
                     data-background-image="<?= CFile::GetPath($arMainPage["IMG_FOR_TEXT_BG_1"]["VALUE"]) ?>"></div>
                <div class="about-text__content">
                    <?= $arMainPage["TEXT_IMG_BG_1"]["VALUE"]["TEXT"] ?>
                </div>
            </div>
        </div>
    </div>
</section>