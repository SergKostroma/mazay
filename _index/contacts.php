<section class="contacts" id="contacts">
    <div class="container">
        <div class="contacts__top-svg">
            <svg>
                <use xlink:href="/dist/img/svg/sprite.svg#icon-paddle"></use>
            </svg>
        </div>
        <h2 class="contacts__title">Контакты</h2>
        <div class="contacts__container">
            <div class="contacts__left">
                <div class="contacts__time"><?= $arSettings["WORK_TIME"]["VALUE"] ?></div>
                <div class="contacts__address">Путь к нам укажет навигатор по координатам:</div>
                <div class="contacts__coordinates js-copy">57.597917, 40.418353</div>
                <div class="contacts__address">Ярославская область, сельское поселение Некрасовское, д. Смирново, ул.
                    Лесная
                </div>
                <a href="<?= $arSettings["MAP_LINK"]["VALUE"] ?>" class="contacts__link link" target="_blank">Как
                    проехать</a><br>
				<a href="/upload/requisites.pdf" class="contacts__link link" target="_blank">Реквизиты</a>
            </div>
            <div class="contacts__right">
                <div class="contacts__social">
                    <? foreach ($arSettings["SOCIAL"]["VALUE"] as $key => $social) : ?>
                        <a href="<?= $arSettings["SOCIAL"]["DESCRIPTION"][$key] ?>" class="contacts__social-item"
                           target="_blank"><?= $social ?></a>
                    <? endforeach; ?>
                </div>
                <div class="contacts__right-block">
                    <div class="contacts__phones">
                        <div class="contacts__phone-block">
                            <a href="tel:<?= preg_replace("#\D#", "", $arSettings["PHONE_RECEPTION"]["VALUE"]) ?>"
                               class="contacts__phone"><?= $arSettings["PHONE_RECEPTION"]["VALUE"] ?></a>
                            <div class="contacts__phone-desc">Ресепшн</div>
                        </div>
                        <div class="contacts__phone-block">
                            <a href="tel:+79201122240"
                               class="contacts__phone">8-920-112-22-40
                            </a>
                            <div class="contacts__phone-desc">Ресторан</div>
                        </div>
                    </div>
                    <? if ($arSettings["EMAIL"]["VALUE"]) : ?>
                        <div class="contacts__emails">
                            <div class="contacts__email-block">
                                <a href="mailto:<?= $arSettings["EMAIL"]["VALUE"] ?>"
                                   class="contacts__email"><?= $arSettings["EMAIL"]["VALUE"] ?></a>
                                <div class="contacts__email-desc">Для предложений</div>
                            </div>
                        </div>
                    <? endif ?>
                </div>
            </div>
        </div>
        <form class="contacts__form js-contacts-form js-validate-form">
            <div class="contacts__form-title">Перезвоним и ответим на вопросы</div>
            <div class="contacts__inputs">
                <div class="contacts__input-container">
                    <input type="text" name="NAME" id="name"
                           class="contacts__input contacts__input--name"/>
                    <label for="name" class="contacts__label">Как к вам обращаться</label>
                    <span class="message-error">Обязательное поле!</span>
                </div>
                <div class="contacts__input-container">
                    <input type="text" name="PHONE" id="phone"
                           class="contacts__input contacts__input--phone"/>
                    <label for="phone" class="contacts__label">Телефон</label>
                    <span class="message-error">Обязательное поле!</span>
                </div>
                <input type="submit" value="Отправить" class="contacts__button btn">
            </div>
            <div class="contacts__policy">
                Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь c <a
                        href="<?= CFile::GetPath($arSettings["POLICY"]["VALUE"]) ?>" target="_blank">Пользовательским соглашением</a>.
            </div>

        </form>
        <div class="contacts__success">
            <div class="contacts__success-title">Спасибо за обращение</div>
            <div class="contacts__success-desc">Мы получили ваши данные. Скоро вам позвонит менеджер и все расскажет.
            </div>
            <div class="contacts__success-svg">
                <svg>
                    <use xlink:href="/app/img/svg/success-top.svg#icon"></use>
                </svg>
            </div>
        </div>
    </div>
</section>