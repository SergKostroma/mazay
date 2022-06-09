<?
$arFilter = ["IBLOCK_ID" => IBLOCK_MODALS, "ID" => $arParams["MODAL_ID"]];
$arSelect = ["IBLOCK_ID", "ID", "NAME", "CODE", "PREVIEW_TEXT", "PROPERTY_*"];
$dbElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
if ($rsElement = $dbElement->GetNextElement()) {
    $arResult = $rsElement->GetFields();
    $arResult["PROPERTIES"] = $rsElement->GetProperties();
}
if ($arResult["PROPERTIES"]["EMPLOYEE"]["VALUE"]) {
    $arFilter = ["IBLOCK_ID" => IBLOCK_EMPLOYEE, "ID" => $arResult["PROPERTIES"]["EMPLOYEE"]["VALUE"]];
    $arSelect = ["IBLOCK_ID", "ID", "NAME", "CODE", "PREVIEW_PICTURE", "PREVIEW_TEXT"];
    $dbElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    if ($rsElement = $dbElement->GetNextElement()) {
        $arResult["EMPLOYEE"] = $rsElement->GetFields();
        $arResult["EMPLOYEE"]["PROPERTIES"] = $rsElement->GetProperties();
    }

    $arResult["EMPLOYEE"]["PHONE"] = preg_replace('!(\b\+?[0-9()\[\]./ -]{7,17}\b|\b\+?[0-9()\[\]./ -]{7,17}\s+(extension|x|#|-|code|ext)\s+[0-9]{1,6})!i', "<a href='tel:+$0'>+$0</a>", $arResult["EMPLOYEE"]["PROPERTIES"]["CONTACTS"]["VALUE"]);
    $arResult["EMPLOYEE"]["PHONE"] = str_replace('+<a ', '<a ', $arResult["EMPLOYEE"]["PHONE"]);

}

if ($arParams["TYPE"] == "house") {
    $arFilter = ["IBLOCK_ID" => IBLOCK_RESIDENCE, "ID" => $arParams["ID"]];
    $arSelect = ["IBLOCK_ID", "ID", "NAME", "CODE", "PROPERTY_*", "PREVIEW_TEXT"];
    $dbElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($rsElement = $dbElement->GetNextElement()) {
        $arResult["HOUSE"] = $rsElement->GetFields();
        $arResult["HOUSE"]["PROPERTIES"] = $rsElement->GetProperties();
    }
}