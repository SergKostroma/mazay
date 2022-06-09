<?

chdir(__DIR__);
chdir('../');
$_SERVER["DOCUMENT_ROOT"] = getcwd();
chdir(__DIR__);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use YooKassa\Client;

$key = YOO_KEY;
$shopId = YOO_SHOPID;
$client = new Client();
$client->setAuth($shopId, $key);


CModule::IncludeModule("iblock");
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


    if ($pay_check == 'waiting_for_capture' or $pay_check == 'succeeded') {
        CIBlockElement::SetPropertyValuesEx($arItem["ID"], $arItem["IBLOCK_ID"], ["STATUS" => 9]);
    }

}