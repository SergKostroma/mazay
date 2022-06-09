<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php' ;
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
$APPLICATION->SetTitle('Страница не найдена. Мазай'); ?>
    <div class="layout">
        <div class="layout__content">
            <div class="page404">
                <div class="container">
                    <div class="page404__404">
                        <div class="page404__text">404</div>
                        <div class="page404__top-svg">
                            <img src="/app/img/svg/404.svg" alt="" class="sm-hidden">
                            <img src="/app/img/svg/404-mobile.svg" alt="" class="sm-show">
                        </div>
                    </div>

                    <div class="page404__title">Страница не найдена</div>
                    <div class="page404__desc">Такой страницы не существует. Вы можете <a href="/">перейти на
                            главную</a> или
                        <a href="/reservation/">забронировать уютный номер</a>.
                    </div>
                    <div class="page404__bottom-logo">
                        <svg>
                            <use xlink:href="/dist/img/svg/sprite.svg#icon-hares"></use>
                        </svg>
                        <div class="page404__waves">
                            <img src="/app/img/svg/404-waves.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/footer.php' ?>