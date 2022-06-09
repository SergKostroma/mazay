<?
CModule::IncludeModule("iblock");

use YooKassa\Client;

function sendForm($data)
{
    $el = new CIBlockElement();
    $props = [
        "NAME" => $data["NAME"],
        "PHONE" => $data["PHONE"]
    ];
    $loadArray = [
        "IBLOCK_ID" => IBLOCK_FORMS,
        "NAME" => "Заявка с формы обратной связи - {$data["NAME"]}",
        "PROPERTY_VALUES" => $props
    ];
    CEvent::SendImmediate("CALLBACK", "s1", $props);

    if ($id = $el->Add($loadArray)) {
        return true;
    } else {
        return false;
    }
}

function back()
{
    if (!$_SESSION["STEP"]) {
        return '/';
    } elseif ($_SESSION["STEP"] == "2") {
        unset($_SESSION["STEP"]);
        return 1;
    } else {
        $_SESSION["STEP"] = (string)((int)$_SESSION["STEP"] - 1);
        return $_SESSION["STEP"];
    }
}

function getSettings()
{
    $arFilter = ["IBLOCK_ID" => IBLOCK_SETTINGS];
    $arSelect = ["*"];
    $dbElement = CIBlockElement::GetList([], $arFilter, false, ["nTopCount" => 1], $arSelect);
    if ($rsElement = $dbElement->GetNextElement()) {
        $arResult = $rsElement->GetProperties();
    }
    return $arResult;
}

function getMainPageContent()
{
    $arFilter = ["IBLOCK_ID" => IBLOCK_MAIN_PAGE];
    $arSelect = ["*"];
    $dbElement = CIBlockElement::GetList([], $arFilter, false, ["nTopCount" => 1], $arSelect);
    if ($rsElement = $dbElement->GetNextElement()) {
        $arResult = $rsElement->GetProperties();
    }
    return $arResult;
}

function getDates($data)
{
    $count = (int)$data["ADULTS"] + (int)$data["CHILD"];
    $date = $data["ARRIVAL"] = str_replace(' ', '', $data["ARRIVAL"]);
    $data["DEPARTURE"] = str_replace(' ', '', $data["DEPARTURE"]);
    $_SESSION["RESERVATION_INFO"] = $data;
    while ($data["DEPARTURE"] !== $date) {
        $arrDates[] = $date;
        $time = strtotime($date . "+1 day");
        $date = date('d.m.Y', $time);
    }
    $arrDates[] = $date;
    $arFilter = ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "NAME" => $arrDates, "PROPERTY_STATUS_VALUE" => "Свободен"];
    $arSelect = ["IBLOCK_ID", "ID", "NAME", "CODE", "IBLOCK_SECTION_ID", "PROPERTY_*"];
    $dbElement = CIBlockElement::GetList(["active_from" => "ASC"], $arFilter, false, false, $arSelect);
    while ($rsElement = $dbElement->GetNextElement()) {
        $arFields = $rsElement->GetFields();
        $arDatesResult[$arFields["IBLOCK_SECTION_ID"]][] = $arFields["NAME"];
    }
    $arResult = null;
    foreach ($arDatesResult as $key => $item) {
        if ($arrDates === $item) {
            $section = CIBlockSection::GetByID($key)->Fetch();
            if ($section) {
                $mainSection = CIBlockSection::GetList([], ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "ID" => $section["IBLOCK_SECTION_ID"]], false, ["ID", "NAME", "UF_*"])->Fetch();
                if (!$arResult[$mainSection["NAME"]]) {
                    $arResult[$mainSection["NAME"]] = $mainSection;
                }
                $arResult[$mainSection["NAME"]]["ITEMS"][] = $section;
                $sectionIds[] = $mainSection["UF_BINGING"];
            }
        }
    }
    $sectionIds = array_unique($sectionIds);
    $arFilter = ["IBLOCK_ID" => IBLOCK_RESIDENCE, "ID" => $sectionIds];
    $arSelect = ["IBLOCK_ID", "ID", "NAME", "PREVIEW_TEXT", "PROPERTY_"];
    $dbElement = CIBlockElement::GetList(["sort" => "asc"], $arFilter, false, false, $arSelect);
    while ($rsElement = $dbElement->GetNextElement()) {
        $arFieldsSection = $rsElement->GetFields();
        $arFieldsSection["PROPERTIES"] = $rsElement->GetProperties();
        $arSectionInfo[] = $arFieldsSection;
    }
    foreach ($arSectionInfo as $sectionInfo) {
        if ($arResult[$sectionInfo["NAME"]]["UF_BINGING"] == $sectionInfo["ID"]) {
            $arResult[$sectionInfo["NAME"]]["INFO"] = $sectionInfo["PROPERTIES"];
            $arResult[$sectionInfo["NAME"]]["INFO"]["PREVIEW_TEXT"] = $sectionInfo["PREVIEW_TEXT"];
        }
    }
    foreach ($arResult as $key => $elem) {
        if ($count > (int)$elem["INFO"]["COUNT"]["VALUE"] || (int)$data["CHILD"] > $elem["INFO"]["COUNT_CHILD"]["VALUE"]) {
            if (count($elem["ITEMS"]) < ceil($count / (int)$elem["INFO"]["COUNT"]["VALUE"]) || count($elem["ITEMS"]) < ceil((int)$data["CHILD"] / (int)$elem["INFO"]["COUNT_CHILD"]["VALUE"])) {
                unset($arResult[$key]);
                continue;
            }
        }

        $housesCountWithOutChild = ceil($count / (int)$elem["INFO"]["COUNT"]["VALUE"]);
        $housesCountWithChild = ceil((int)$data["CHILD"] / (int)$elem["INFO"]["COUNT_CHILD"]["VALUE"]);
        $housesCount = max($housesCountWithOutChild, $housesCountWithChild);
        $arResult[$key]["HOUSES_COUNT"] = $housesCount;
        $arResult[$key]["SUM"] = number_format($elem["INFO"]["PRICE"]["VALUE"] * $housesCount * ($data["DEPARTURE"] - $data["ARRIVAL"]), 0, '.', ' ');
        $arResult[$key]["COUNT_ADULTS"] = (int)$data["ADULTS"];
        $arResult[$key]["COUNT_CHILD"] = (int)$data["CHILD"];

    }
    return $arResult;
}

function checkedHouse($data)
{
    foreach ($_SESSION["RESERVATION"] as &$item) {
        if ($item["ID"] == $data["TYPE"]) {
            $_SESSION["RESERVATION_LAST"] = $item;
            $_SESSION["STEP"] = "3";
            return true;
        }
    }
}

function checkCloseDates()
{
    $arFilter = ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "PROPERTY_STATUS_VALUE" => "Забронирован"];
    $arSelect = ["NAME"];
    $dbElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($rsElement = $dbElement->GetNextElement()) {
        $arFields[] = $rsElement->GetFields()["NAME"];
    }
    $arFields = array_unique($arFields, SORT_STRING);
    $arFilter = ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "PROPERTY_STATUS_VALUE" => "Свободен", "NAME" => $arFields];
    $arSelect = ["NAME"];
    $dbElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($rsElement = $dbElement->GetNextElement()) {
        $arFields2[] = $rsElement->GetFields()["NAME"];
    }
    if (!$arFields2) {
        return $arFields;
    }
    $arFields2 = array_unique($arFields2);
    $result = array_diff($arFields, $arFields2);
    return $result;
}

function getPricesByHouseSection($min, $max, $section) {
    $db_res = CIBlockElement::GetList(
        [],
        ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "SECTION_ID" => $section, "INCLUDE_SUBSECTIONS" => "Y", ">=DATE_ACTIVE_FROM" => $min, "<DATE_ACTIVE_FROM" => $max], //$arFilter
        false,
        false,
        ["IBLOCK_ID", "ID", "NAME", "ACTIVE_FROM", "PROPERTY_PRICE", "PROPERTY_IS_SALE", "PROPERTY_SALE_PRICE"] //$arSelect
    );

    $dates = [];
    while ($res = $db_res->GetNextElement()) {
        $dates[] = $res->GetFields();
    }

    $arResult = [];
    foreach ($dates as $item) {

        if (array_key_exists($item['NAME'], $arResult)) {

            if (!$arResult[$item['NAME']]['IS_SALE'] && $item['PROPERTY_IS_SALE_VALUE']) {

                if ($arResult[$item['NAME']]['PRICE'] < $item['PROPERTY_SALE_PRICE_VALUE'])
                    continue;

                $arResult[$item['NAME']]['PRICE'] = $item['PROPERTY_SALE_PRICE_VALUE'];
                $arResult[$item['NAME']]['OLD_PRICE'] = $item['PROPERTY_PRICE_VALUE'];
                $arResult[$item['NAME']]['IS_SALE'] = true;

                continue;
            }

            $arResult[$item['NAME']]['PRICE'] = $arResult[$item['NAME']]['PRICE'] > $item['PROPERTY_PRICE_VALUE'] ? $item['PROPERTY_PRICE_VALUE'] : $arResult[$item['NAME']]['PRICE'];

            continue;
        }

        $arResult[$item['NAME']] = [
            'DATE' => $item['NAME'],
            'PRICE' => $item['PROPERTY_PRICE_VALUE'],
            'IS_SALE' => false
        ];

    }

    return $arResult;
}

function getDatesMinimalPrices()
{
    $today = new DateTime();
    $afterYear = clone $today;
    $today = $today->format("d.m.Y");
    $afterYear->modify("+1 year");
    $afterYear = $afterYear->format("d.m.Y");

    $db_res = CIBlockElement::GetList(
        [],
        ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, ">=DATE_ACTIVE_FROM" => $today, "<DATE_ACTIVE_FROM" => $afterYear], //$arFilter
        false,
        false,
        ["IBLOCK_ID", "ID", "NAME", "ACTIVE_FROM", "PROPERTY_PRICE", "PROPERTY_IS_SALE", "PROPERTY_SALE_PRICE"] //$arSelect
    );

    $dates = [];
    while ($res = $db_res->GetNextElement()) {
        $dates[] = $res->GetFields();
    }

    $arResult = [];
    foreach ($dates as $item) {

        if (array_key_exists($item['NAME'], $arResult)) {

            if (!$arResult[$item['NAME']]['IS_SALE'] && $item['PROPERTY_IS_SALE_VALUE']) {

                if ($arResult[$item['NAME']]['PRICE'] < $item['PROPERTY_SALE_PRICE_VALUE'])
                    continue;

                $arResult[$item['NAME']]['PRICE'] = $item['PROPERTY_SALE_PRICE_VALUE'];
                $arResult[$item['NAME']]['OLD_PRICE'] = $item['PROPERTY_PRICE_VALUE'];
                $arResult[$item['NAME']]['IS_SALE'] = true;

                continue;
            }

            $arResult[$item['NAME']]['PRICE'] = $arResult[$item['NAME']]['PRICE'] > $item['PROPERTY_PRICE_VALUE'] ? $item['PROPERTY_PRICE_VALUE'] : $arResult[$item['NAME']]['PRICE'];

            continue;
        }

        $arResult[$item['NAME']] = [
            'DATE' => $item['NAME'],
            'PRICE' => $item['PROPERTY_PRICE_VALUE'],
            'IS_SALE' => false
        ];

    }

    return $arResult;
}

function createOrder($data)
{
    $el = new CIBlockElement();
    $sortData = array_filter($data, function ($key) {
        return preg_match("/_\d/", $key);
    }, ARRAY_FILTER_USE_KEY);
    for ($i = 0; $i < count($sortData) / 4; $i++) {
        $fullName[] = "{$sortData["LAST_NAME_" . $i]} {$sortData["FIRST_NAME_" . $i]} {$sortData["MIDDLE_NAME_" . $i]}";
        $nationality[] = $sortData["NATIONALITY_" . $i];
    }

    $props = [
        "MAIN_LAST_NAME" => $data["LAST_NAME"],
        "MAIN_FIRST_NAME" => $data["FIRST_NAME"],
        "MAIN_MIDDLE_NAME" => $data["MIDDLE_NAME"],
        "EMAIL" => $data["EMAIL"],
        "PHONE" => $data["PHONE"],
        "COMMENTS" => $data["COMMENTS"],
        "PAY_METHOD" => $data["PAY_METHOD"],
        "FULL_NAME" => $fullName,
        "NATIONALITY" => $nationality,
        "TYPE" => $_SESSION["RESERVATION_LAST"]["NAME"],
        "HOUSES_COUNT" => $_SESSION["RESERVATION_LAST"]["HOUSES_COUNT"],
        "SUM" => $_SESSION["RESERVATION_LAST"]["SUM"],
        "ADULTS" => $_SESSION["RESERVATION_LAST"]["COUNT_ADULTS"],
        "CHILDREN" => $_SESSION["RESERVATION_LAST"]["COUNT_CHILD"],
        "ARRIVAL" => $_SESSION["RESERVATION_INFO"]["ARRIVAL"],
        "DEPARTURE" => $_SESSION["RESERVATION_INFO"]["DEPARTURE"],
        "NIGHTS_COUNT" => $_SESSION["RESERVATION_INFO"]["DEPARTURE"] - $_SESSION["RESERVATION_INFO"]["ARRIVAL"],
        "STATUS" => 8,
    ];

    $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => IBLOCK_ORDER, "CODE" => "ANOTHER_MAN"));
    $enum_fields = $property_enums->GetNext();

    if ($data["ANOTHER_MAN"]) {
        $props["ANOTHER_MAN"] = $enum_fields["ID"];
    }

    $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => IBLOCK_ORDER, "CODE" => "PAY_METHOD"));
    while ($enum_fields = $property_enums->GetNext()) {
        $payMethods[] = $enum_fields;
    }

    foreach ($payMethods as $payMethod) {
        if ($payMethod["ID"] == $data["PAY_METHOD"]) {
            $payName = $payMethod["VALUE"];
        }
    }

    if ($data["PAY_METHOD"] == 6) {
        $props["STATUS"] = 8;
    }

    $loadArray = [
        "IBLOCK_ID" => IBLOCK_ORDER,
        "NAME" => "Заказ на имя - {$data["LAST_NAME"]} {$data["FIRST_NAME"]} {$data["MIDDLE_NAME"]}",
        "PROPERTY_VALUES" => $props
    ];

    $id = $el->Add($loadArray);

    $props["PAY_METHOD"] = $payName;

    CEvent::SendImmediate("ORDER", "s1", $props);

    $_SESSION["RESERVATION_INFO"]["ID"] = $id;
    $_SESSION["RESERVATION_INFO"]["NAME"] = $_SESSION["RESERVATION_LAST"]["NAME"];

    unset($_SESSION["STEP"], $_SESSION["RESERVATION"], $_SESSION["NOT_FOUND"], $_SESSION["RESERVATION_LAST"]);

    $res["STATUS"] = ($data["PAY_METHOD"] != 6) ? 'finish' : '';
    $res["ID"] = $id;

    return $res;
}

function getInstagram()
{
    $accessToken = CIBlockElement::GetProperty(3, 7, [], ["CODE" => "TOKEN_INST"])->Fetch()["VALUE"];

    $dateLastUpdateToken = strtotime(CIBlockElement::GetProperty(3, 7, [], ["CODE" => "DATE_LAST_UPDATE_TOKEN"])->Fetch()["VALUE"]);
    $dateNow = strtotime(date('d.m.Y'));

    /*    if (($dateNow - $dateLastUpdateToken) / (60 * 60 * 24) > 30) {

            $url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=" . $accessToken;

            $instagramCnct = curl_init(); // инициализация cURL подключения
            curl_setopt($instagramCnct, CURLOPT_URL, $url); // адрес запроса
            curl_setopt($instagramCnct, CURLOPT_RETURNTRANSFER, 1); // просим вернуть результат
            $response = json_decode(curl_exec($instagramCnct)); // получаем и декодируем данные из JSON
            curl_close($instagramCnct); // закрываем соединение
            $accessToken = $response->access_token; // обновленный токен
            CIBlockElement::SetPropertyValues(7, 3, ["TOKEN_INST" => $accessToken, "DATE_LAST_UPDATE_TOKEN" => date('d.m.Y')]);
        }*/


    $url = "https://graph.instagram.com/me/media?fields=id,media_type,media_url,caption,timestamp,thumbnail_url,permalink&access_token=" . $accessToken;
    $instagramCnct = curl_init(); // инициализация cURL подключения
    curl_setopt($instagramCnct, CURLOPT_URL, $url); // адрес запроса
    curl_setopt($instagramCnct, CURLOPT_RETURNTRANSFER, 1); // просим вернуть результат
    $media = json_decode(curl_exec($instagramCnct)); // получаем и декодируем данные из JSON
    curl_close($instagramCnct); // закрываем соединение
    return $media->data;
}

function svg($p)
{
    $p = $_SERVER['DOCUMENT_ROOT'] . $p;
    return file_exists($p) ? preg_replace('/<[?|!].*?>/', '', str_replace(array("\r\n", "\r", "\n", "\t", '  '), '', file_get_contents($p))) : '';
}

function getPayUrl($id)
{

    if (!$id) {
        return false;
    }

    CModule::IncludeModule("iblock");
    $arOrder = ["SORT" => "ASC"];
    $arFilter = [
        "IBLOCK_ID" => IBLOCK_ORDER,
        "ACTIVE" => "Y",
        "ID" => $id,
    ];
    $arSelect = [
        "IBLOCK_ID", "ID", "NAME"
    ];
    $db_res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
    if ($res = $db_res->GetNextElement()) {
        $arItem = $res->GetFields();
        $arItem["PROPERTIES"] = $res->GetProperties();
    }


    $host = $_SERVER["HTTP_HOST"];
    $scheme = $_SERVER["REQUEST_SCHEME"];
    $backurl = $scheme . "://" . $host . "/yoomoney/payment-check.php?id=" . $arItem["ID"];
    $arItem["PROPERTIES"]["SUM"]["VALUE"] = str_replace(' ', '', $arItem["PROPERTIES"]["SUM"]["VALUE"]);
    $key = YOO_KEY;
    $shopId = YOO_SHOPID;
    $client = new Client();
    $client->setAuth($shopId, $key);
    $arParams = array(
        'amount' => array(
            'value' => intval($arItem["PROPERTIES"]["SUM"]["VALUE"]),
            'currency' => 'RUB',
        ),
        'confirmation' => array(
            'type' => 'redirect',
            'return_url' => $backurl,
        ),
        'capture' => true,
        'description' => 'Заказ №' . $id,
    );

    $payment = $client->createPayment($arParams, uniqid('', true));

    $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();
    $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

    CIBlockElement::SetPropertyValuesEx($id, IBLOCK_ORDER, ["KASSA_ID" => $payment->getid()]);


    return $confirmationUrl;
}

if (!function_exists('mb_ucfirst') && extension_loaded('mbstring')) {
    /**
     * mb_lcfirst - преобразует первый символ в верхний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
    function mb_lcfirst($str, $encoding = 'UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtolower(mb_substr($str, 0, 1, $encoding), $encoding) .
            mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}
