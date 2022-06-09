<section class="about-text about-text--long-padding">
    <div class="container">
        <div class="about-text__hares-with-tree">
            <svg class="m-hidden">
                <use xlink:href="/dist/img/svg/sprite.svg#icon-hares-with-tree"></use>
            </svg>
            <svg class="m-show">
                <use xlink:href="/app/img/svg/hares-with-tree-mobile.svg#hares"></use>
            </svg>
        </div>
        <div class="about-text__container">
            <div class="about-text__background js-parallax-text-2 lozad"
                 data-background-image="<?= CFile::GetPath($arMainPage["IMG_FOR_TEXT_BG_2"]["VALUE"]) ?>"></div>
            <div class="about-text__content">
                <?= $arMainPage["TEXT_IMG_BG_2"]["VALUE"]["TEXT"] ?>
            </div>
        </div>

        <div class="about-text__button-container">
            <a href="https://www.instagram.com/mazai_park.hotel/"  target="_blank" class="about-text__button btn">Посмотреть</a>
        </div>
        <div class="about-text__images">
            <? $instagram = getInstagram() ;
            foreach ($instagram as $key => $item) : ?>
            <? if ($key > 3) break; ?>
            <div class="about-text__img">
                <img class="lozad" data-src="<?= $item->media_url ?>" alt="">
            </div>
            <? endforeach; ?>
        </div>
    </div>
</section>