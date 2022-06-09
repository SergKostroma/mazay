<div class="layout__footer">
    <footer class="footer">
        <div class="container">
            <div class="footer__top-block">
                <div class="footer__left">
                    <div class="footer__address-container">
                        <a href="<?= $arSettings["MAP_LINK"]["VALUE"] ?>" class="footer__address" target="_blank"><?= $arSettings["ADDRESS"]["VALUE"] ?></a>
                        <a href="<?= $arSettings["MAP_LINK"]["VALUE"] ?>" class="footer__button btn" target="_blank">Как проехать</a>
                    </div>
                    <div class="footer__pay">
                        <div class="footer__pay-title">Способы оплаты</div>
                        <div class="footer__pay-items">
                            <? foreach ($arSettings["PAY_METHODS"]["VALUE"] as $key => $payMethods) : ?>
                                <div class="footer__pay-item lozad"
                                     data-background-image="<?= CFile::GetPath($payMethods); ?>"></div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="footer__logo">
                    <svg>
                        <use xlink:href="/dist/img/svg/sprite.svg#icon-hares"></use>
                    </svg>
                </div>
                <div class="">
                    <div class="footer__social sm-hidden">
                        <ul class="footer__social-items">
                            <? foreach ($arSettings["SOCIAL"]["VALUE"] as $key => $social) : ?>
                                <li class="footer__social-item">
                                    <a href="<?= $arSettings["SOCIAL"]["DESCRIPTION"][$key] ?>" class="footer__social-link" target="_blank"><?= $social ?></a>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                    <div class="footer__pay-md">
                        <div class="footer__pay-title">Способы оплаты</div>
                        <div class="footer__pay-items">
                            <div class="footer__pay-item lozad"
                                 data-background-image="/app/img/svg/mastercard.svg"></div>
                            <div class="footer__pay-item lozad" data-background-image="/app/img/svg/mir.svg"></div>
                            <div class="footer__pay-item lozad"
                                 data-background-image="/app/img/svg/visa.svg"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom-block">
                <div class="footer__copyright">
                    <?= date('Y') ?>, Парк-отель «Мазай»
                </div>
                <div class="footer__policy">
                    <a href="<?= CFile::GetPath($arSettings["POLICY"]["VALUE"]) ?>" target="_blank">Политика обработки данных</a>
                </div>
                <div class="footer__policy">
                    <a href="#requisites" data-modal>Реквизиты компании</a>
                </div>
                <div class="footer__link-ms-net">
                    <a href="https://ms-net.ru/" target="_blank">
                        Заселяли в <span>Медиасеть</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>