<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php' ?>
<? $APPLICATION->SetTitle('Бронирование номера. Мазай');

$arFilter = ["IBLOCK_ID" => IBLOCK_ORDER, "ACTIVE" => "Y", "ID" => $_GET["id"]];
$arSelect = ["IBLOCK_ID", "ID", "NAME", "CODE", "PROPERTY_*"];
$dbElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
if ($rsElement = $dbElement->GetNextElement()) {
    $arResult = $rsElement->GetFields();
    $arResult["PROPERTIES"] = $rsElement->GetProperties();
}

use YooKassa\Client;

$denied = false; //переменная для определения статуса оплаты

$key = YOO_KEY;
$shopId = YOO_SHOPID;

$client = new Client();

$client->setAuth($shopId, $key);

$pay = CIBlockElement::GetList(
    ["SORT" => "ASC"],
    ["IBLOCK_ID" => IBLOCK_ORDER,  "ID" => $_GET['id']],
    false,
    false,
    ['PROPERTY_STATUS', 'PROPERTY_KASSA_ID', 'ID', 'NAME']
)->Fetch();

$kassaId = $pay["PROPERTY_KASSA_ID_VALUE"];

$payment = $client->getPaymentInfo($kassaId); // Получаем информацию о платеже

$pay_check = $payment->getstatus();

// если статус == ожидание действий от пользователя(просто нажал на кнопку "вернуться в магазин" или вышел назад со страницы оплаты)
if ($pay_check == 'pending')
    $denied = true;
?>
<?php if (!$denied): ?>
    <div class="success-pay">
        <div class="container">
            <div class="success-pay__top-svg">
                <svg>
                    <use xlink:href="/app/img/svg/success-top.svg#icon"></use>
                </svg>
            </div>
            <div class="success-pay__title"><?= ($arResult["PROPERTIES"]["STATUS"]["VALUE"] == "Ожидает оплаты") ? 'Заказ успешно оформлен' : 'Оплата прошла успешно' ?></div>
            <div class="success-pay__order-number">Номер вашей брони <?= $arResult["ID"] ?>.</div>
            <div class="success-pay__desc">Мы ждем вас с <span><?= $arResult["PROPERTIES"]["ARRIVAL"]["VALUE"] ?></span>
                по
                <span><?= $arResult["PROPERTIES"]["DEPARTURE"]["VALUE"] ?></span>
                в <?= $arResult["PROPERTIES"]["TYPE"]["VALUE"] ?>.
                Стандартное время заезда в 16:00. Возьмите с собой паспорта, заселение в номер происходит только по
                документам. С нетерпением ждем вас, хорошего пути!
            </div>
            <div class="success-pay__bottom-svg">
                <svg>
                    <use xlink:href="/app/img/svg/success-pay-bottom.svg#icon"></use>
                </svg>
            </div>
        </div>
    </div>
    <? unset($_SESSION["RESERVATION_INFO"]) ?>
<?php else : ?>
    <div class="success-pay">
        <div class="container">
            <div class="success-pay__top-svg" style="display: flex; justify-content: center; margin-bottom: 30px">
                <div style="width: 132px; height: 125px; background: url('/app/img/svg/error.svg') no-repeat;"></div>
            </div>
            <div class="success-pay__title">Оплата не прошла</div>
            <div class="success-pay__desc">
                При оплате произошла ошибка. Попробуйте использовать другую карту или выбрать другой способ оплаты.
            </div>
            <div class="success-pay__bottom-svg">
                <svg>
                    <use xlink:href="/app/img/svg/success-pay-bottom.svg#icon"></use>
                </svg>
            </div>
            <div class="try-more">
                <a href="/yoomoney/pay.php?id=<?= $_GET['id'] ?>">Попробовать ещё раз</a>
                <div style="background: url('/app/img/svg/arrow-link.svg') no-repeat; width: 8px; height: 15px"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/footer.php' ?>
