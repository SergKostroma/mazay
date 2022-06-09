<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php' ?>
<? $APPLICATION->SetTitle('Бронирование номера. Мазай'); ?>
<? if (!$_GET["id"]) {
    header("location: /");
    exit;
} else {
    $arFilter = ["IBLOCK_ID" => IBLOCK_ORDER, "ACTIVE" => "Y", "ID" => $_GET["id"]];
    $arSelect = ["IBLOCK_ID", "ID", "NAME", "CODE", "PROPERTY_*"];
    $dbElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    if ($rsElement = $dbElement->GetNextElement()) {
        $arResult = $rsElement->GetFields();
        $arResult["PROPERTIES"] = $rsElement->GetProperties();
    }
    if (!$arResult) {
        header("location: /");
        exit;
    }
}

use YooKassa\Client;

$key = YOO_KEY;
$shopId = YOO_SHOPID;
$client = new Client();
$client->setAuth($shopId, $key);
$arOrder = ["SORT" => "ASC"];
$arFilter = [
    "IBLOCK_ID" => IBLOCK_ORDER,
    "ACTIVE" => "Y",
    "PROPERTY_STATUS" => 8,
    ">TIMESTAMP_X" => date("d.m.Y H:00:00"),
    "!PROPERTY_KASSA_ID" => false,
];

$arSelect = [
    "IBLOCK_ID", "ID", "NAME", "TIMESTAMP_X",
];
$db_res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
while ($res = $db_res->GetNextElement()) {
    $arItem = $res->GetFields();
    $arItem["PROPERTIES"] = $res->GetProperties();

    $kassaId = $arItem["PROPERTIES"]["KASSA_ID"]["VALUE"];
    $payment = $client->getPaymentInfo($kassaId); // Получаем информацию о платеже
    $pay_check = $payment->getstatus();
}
if ($pay_check == 'pending')
?>

<div class="success-pay">
    <div class="container">
        <div class="success-pay__top-svg">
            <svg>
                <use xlink:href="/app/img/svg/success-top.svg#icon"></use>
            </svg>
        </div>
        <div class="success-pay__title"><?= ($arResult["PROPERTIES"]["STATUS"]["VALUE"] == "Ожидает оплаты") ? 'Заказ успешно оформлен' : 'Оплата прошла успешно' ?></div>
        <div class="success-pay__order-number">Номер вашей брони <?= $arResult["ID"] ?>.</div>
        <div class="success-pay__desc">Мы ждем вас с <span><?= $arResult["PROPERTIES"]["ARRIVAL"]["VALUE"] ?></span> по
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
<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/footer.php' ?>
