<div id="modal" class="modal">
    <div class="modal__container js-replace-modal">
        <div class="modal__main-title">{Заголовок}</div>
        <div class="modal__main-desc">{Основное описание}</div>
        <div class="modal__slider dots">
            <div class="modal__slider-container">
                <div class="modal__slider js-modal-slider">
                    <div class="modal__slide lozad"
                         data-background-image="{Картинка слайдера}"></div>
                </div>
                <div class="about__slider-controls modal-controls">
                    <div class="about__counter"></div>
                </div>
            </div>
        </div>
        <div class="modal__text-container">
            <div class="modal__left">
                <div class="modal__title">{Подзаголовок}</div>
                <div class="modal__desc">
                    <p class="modal__desc-1">{Описание подзаголовка 1}</p>
                    <p class="modal__desc-2">{Описание подзаголовка 2}</p>
                </div>
            </div>
            <div class="modal__right">
                <div class="modal__right-title">Мария Соловьева</div>
                <div class="modal__specialization">организатор</div>
                <div class="modal__right-phone">Для записи и консультаций <a href="tel:+79106770909">+7 910
                        677-09-09</a></div>
                <div class="modal__photo">
                    <svg>
                        <use xlink:href="/dist/img/svg/sprite.svg#icon-chef"></use>
                    </svg>
                    <img src="/app/img/modal-photo.jpg" alt="" class="lozad">
                </div>
                <div class="modal__right-bottom-title">Следит чтобы все было идеально</div>
                <div class="modal__right-desc">Проконсультирует по всем вопросам, расскажет как лучше расставить
                    столы и
                    какой декор выбрать на этот сезон.
                </div>
            </div>
        </div>
    </div>
    <div class="modal__contacts">
        <div class="modal__container">
            <form class="contacts__form js-contacts-form js-validate-form">
                <div class="contacts__form-title">Перезвоним и ответим на&nbsp;вопросы</div>
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
                            href="#">политикой конфиденциальности</a>.
                </div>
            </form>
            <div class="contacts__success">
                <div class="contacts__success-title">Спасибо за обращение</div>
                <div class="contacts__success-desc">Мы получили ваши данные. Скоро вам позвонит менеджер и все
                    расскажет.
                </div>
                <div class="contacts__success-svg">
                    <svg>
                        <use xlink:href="/app/img/svg/success-top.svg#icon"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="requisites" class="modal-requisites">
    <div class="modal-requisites__title">Реквизиты компании</div>
    <div class="modal-requisites__desc">ИП Аваков А. А.</div>
    <div class="modal-requisites__table">
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">ИНН:</div>
            <div class="modal-requisites__item-desc">771528967345</div>
        </div>
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">ОГРНИП:</div>
            <div class="modal-requisites__item-desc">314443732200066</div>
        </div>
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">ОКПО:</div>
            <div class="modal-requisites__item-desc">0195270681</div>
        </div>
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">Расчетный счет:</div>
            <div class="modal-requisites__item-desc">40802810729000004017</div>
        </div>
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">Банк:</div>
            <div class="modal-requisites__item-desc">КОСТРОМСКОЕ ОТДЕЛЕНИЕ N 8640 ПАО СБЕРБАНК</div>
        </div>
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">БИК:</div>
            <div class="modal-requisites__item-desc">043469623</div>
        </div>
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">Корр. счет:</div>
            <div class="modal-requisites__item-desc">30101810200000000623</div>
        </div>
        <div class="modal-requisites__item">
            <div class="modal-requisites__item-title">Свидетельство</div>
            <div class="modal-requisites__item-desc">44 №000890142 от 18.11.2014</div>
        </div>
    </div>
</div>

<div id="custom-modal-error" class="custom-modal-error" style="  display: none !important;">
    <div class="custom-modal-error__wrapper">
        <div class="custom-modal-error__text">
            Принимаем бронирование только по телефону
        </div>
    </div>
</div>