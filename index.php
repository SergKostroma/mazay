<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php' ?>
<? $APPLICATION->SetTitle('Мазай - Парк-отель'); ?>
<? $APPLICATION->SetPageProperty('description', 'Мазай - Парк-отель, ресторан  и детский парк в лесу'); ?>
<? /*  include $_SERVER["DOCUMENT_ROOT"] . '/_index/include/preloader.php' */ ?>
<div class="layout">
    <div class="layout__content">
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/main.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/about-text.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/about.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/restaurants.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/events.php' ?>




            <section class="poster">
                
        <div class="container">
                <div class="poster__top"><img src="/app/img/svg/icons/hare-in-boat.svg" alt="заяц в лодке"></div>
                <h2 class="poster__title">Афиша</h2>
                <div class="poster__events">

                    <div class="poster__event">

                        <div class="poster__event-image"><img src="/app/img/russian-day.png" alt="день России"></div>

                        <div class="poster__event-text-content">
                            <div class="poster__event-title">День России</div>
                            <div class="poster__event-description">Квесты, танцы и игры, танцевальный флешмоб,
                                концертная программа Четыре двора </div>
                            <div class="poster__event-footer">
                                <div class="poster__event-date">12 июня в 17:00</div>
                                <div class="poster__event-forward-button"><img src="" alt=""></div>
                            </div>
                        </div>

                    </div>

                    <div class="poster__event">

                        <div class="poster__event-image"><img src="/app/img/dinner-party.png" alt="званый ужин"></div>

                        <div class="poster__event-text-content">
                            <div class="poster__event-title">Званый ужин</div>
                            <div class="poster__event-description">В ресторане Мазай гастрономический квиз, мясные деликатесы сочетаемые с вином! детская анимация для гостей с детьми! Welcome зона и зеркальное шоу! </div>
                            <div class="poster__event-footer">
                                <div class="poster__event-date">4 июня в 17:30</div>
                                <div class="poster__event-forward-button"><img src="" alt=""></div>
                            </div>
                        </div>

                    </div>

                    

                    <div class="poster__event">

                        <div class="poster__event-image"><img src="/app/img/cheese-tasting.png" alt="сырная дегустация"></div>

                        <div class="poster__event-text-content">
                            <div class="poster__event-title">Сырная дегустация</div>
                            <div class="poster__event-description">Гастрономический вечер, посвященный сыру </div>
                            <div class="poster__event-footer">
                                <div class="poster__event-date">16 апреля в 18:00</div>
                                <div class="poster__event-forward-button"><img src="" alt=""></div>
                            </div>
                        </div>

                    </div>

                </div>
                </div>
            </section>
       








        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/map.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/residence.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/children-park.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/contacts.php' ?>
        <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/about-text-instagram.php' ?>
    </div>
    <? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/footer.php' ?>