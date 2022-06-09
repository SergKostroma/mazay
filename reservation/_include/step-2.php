<form action="" method="POST" class="js-reservation-form-step-2">
    <div class="container">
        <div class="reservation__main-title reservation__main-title--step-2">Выберите апартаменты</div>
        <? $arAdvantages = null; ?>
        <? foreach ($_SESSION["RESERVATION"] as $key => $item) : ?>
            <div class="reservation__item">
                <div class="reservation__item-left">
                    <div class="reservation__item-top">
                        <div class="reservation__item-title"><?= $key ?></div>
                        <div class="reservation__item-desc"><?= $item["INFO"]["PREVIEW_TEXT"] ?></div>
                        <div class="reservation__item-advantages">
                            <?
                            if ($arAdvantages) {
                                $arUniqAdvantages = array_diff($item["INFO"]["ADVANTAGES"]["VALUE"], $arAdvantages);
                                $arNotUniqAdvantages = array_intersect($item["INFO"]["ADVANTAGES"]["VALUE"], $arAdvantages);
                                foreach ($arNotUniqAdvantages as $advantage) : ?>
                                    <div class="reservation__item-advantages-item"><?= $advantage ?></div>
                                <? endforeach; ?>
                                <? foreach ($arUniqAdvantages as $advantage) : ?>
                                    <div class="reservation__item-advantages-item active"><?= $advantage ?></div>
                                <? endforeach;
                            } else { ?>
                                <? foreach ($item["INFO"]["ADVANTAGES"]["VALUE"] as $advantage) : ?>
                                    <div class="reservation__item-advantages-item"><?= $advantage ?></div>
                                <? endforeach;
                            } ?>
                            <? $arAdvantages = $item["INFO"]["ADVANTAGES"]["VALUE"]; ?>
                        </div>
                    </div>
                    <div class="reservation__item-bottom sm-hidden">
                        <div class="reservation__item-bottom-text">
                            <div class="reservation__item-footage"><?= $item["INFO"]["FOOTAGE"]["VALUE"] ?>
                                м<sup>2</sup></div>
                            <div class="reservation__item-count">до <?= $item["INFO"]["COUNT"]["VALUE"] ?> мест</div>
                        </div>
                        <div class="reservation__item-price-block">
                            <div class="reservation__item-price-container">
<!--                                <div class="reservation__item-price-title">Стоимость-->
<!--                                    за --><?//= $_SESSION["RESERVATION_INFO"]["DEPARTURE"] - $_SESSION["RESERVATION_INFO"]["ARRIVAL"] ?>
<!--                                    ночи-->
<!--                                </div>-->
<!--                                <div class="reservation__item-price">--><?//= $item["SUM"] ?><!-- <span class="ruble">С</span>-->
<!--                                </div>-->
                            </div>
                            <input type="radio" name="TYPE" value="<?= $item["ID"] ?>" hidden>
                            <input type="submit" class="btn-with-bg reservation__item-submit js-submit-step-2" value="Забронировать">
                        </div>
                    </div>
                </div>
                <div class="reservation__item-right">
                    <div class="reservation__item-slider js-reservation-slider">
                        <? foreach ($item["INFO"]["IMAGES_DETAIL"]["VALUE"] as $image) : ?>
                            <img src="<?= CFile::GetPath($image) ?>" alt="" class="reservation__item-slide">
                        <? endforeach; ?>
                    </div>
                </div>
                <div class="reservation__item-bottom sm-show">
                    <div class="reservation__item-bottom-text">
                        <div class="reservation__item-footage"><?= $item["INFO"]["FOOTAGE"]["VALUE"] ?>
                            м<sup>2</sup></div>
                        <div class="reservation__item-count">до <?= $item["INFO"]["COUNT"]["VALUE"] ?> мест</div>
                    </div>
                    <div class="reservation__item-price-block">
                        <div class="reservation__item-price-container">
                            <div class="reservation__item-price-title">Стоимость
                                за <?= $_SESSION["RESERVATION_INFO"]["DEPARTURE"] - $_SESSION["RESERVATION_INFO"]["ARRIVAL"] ?>
                                ночи
                            </div>
                            <div class="reservation__item-price"><?= $item["SUM"] ?> <span class="ruble">С</span>
                            </div>
                        </div>
                        <input type="radio" name="TYPE" value="<?= $item["ID"] ?>" hidden>
                        <input type="submit" class="btn-with-bg reservation__item-submit js-submit-step-2 m-hidden" value="Забронировать">
                    </div>
                    <input type="submit" class="btn-with-bg reservation__item-submit js-submit-step-2 m-show" value="Забронировать">
                </div>

            </div>
        <? endforeach; ?>
    </div>
</form>