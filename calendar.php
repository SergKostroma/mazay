<? require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!$USER->isAdmin()) die;


CModule::IncludeModule("iblock");

$arFilter = ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "DEPTH_LEVEL" => 2];
$arSelect = ["ID"];

$dbRes = CIBlockSection::GetList([], $arFilter, false, $arSelect);
while ($rsRes = $dbRes->GetNextElement()) {
    $arFields = $rsRes->GetFields();
    $arResult[$arFields["ID"]] = $arFields["ID"];
}

$arFilter = ["IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "IBLOCK_SECTION_ID" => $arResult];
$arSelect = ["ID", "NAME", "CODE", "IBLOCK_SECTION_ID"];
$dbElement = CIBlockElement::GetList(["active_from" => "DESC"], $arFilter, false, false, $arSelect);
while ($rsElement = $dbElement->GetNextElement()) {
    $arFields = $rsElement->GetFields();
    if ($arFields) {
        if (is_string($arResult[$arFields["IBLOCK_SECTION_ID"]])) {
            unset($arResult[$arFields["IBLOCK_SECTION_ID"]]);
        }
        $arResult[$arFields["IBLOCK_SECTION_ID"]][] = $arFields["NAME"];
    }
}

$dates = [];
$start = strtotime(date('d.m.Y'));
if ($_REQUEST["DATE"]) {
    try {
        $dateTime = new DateTime($_REQUEST["DATE"]);
    } catch (Exception $e) {
        echo 'Выброшено исключение: ', $e->getMessage(), "\n";
    }
} else {
    $dateTime = new DateTime('last day of December this year');
}
$end = strtotime($dateTime->format('d.m.Y'));
for ($i = $start; $i <= $end; $i += 86400) {
    $dates[] = date('d.m.Y', $i);
}

$el = new CIBlockElement();
foreach ($arResult as $key => $item) {
    if (is_array($item)) {
        $diff[$key] = array_diff($dates, $item);
    } else {
        $diff[$key] = $dates;
    }
}

?>

<form action="" method="POST">
    До какой даты заполнить базу данных?
    <input type="date" name="DATE" min="<?= date('Y-m-d') ?>">
    <input type="submit" value="Выбрать">
</form>

<?
$property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES, "CODE" => "STATUS"));
while ($enum_fields = $property_enums->GetNext()) {
    $enum[$enum_fields["XML_ID"]] = $enum_fields["ID"];
}

foreach ($diff as $diffKey => $diffItem) {
    $warning = (empty($diffItem)) ? true : false;
    foreach ($diffItem as $diffChild) {
        $props = [
            "STATUS" => $enum["Y"]
        ];
        $loadArray = [
            "IBLOCK_ID" => IBLOCK_RESERVATION_HOUSES,
            "NAME" => $diffChild,
            "IBLOCK_SECTION_ID" => $diffKey,
            "ACTIVE_FROM" => $diffChild,
            "PROPERTY_VALUES" => $props
        ];
        if ($id = $el->Add($loadArray))
            echo "Создана новая дата: " . $diffChild . "<br>";
        else
            echo "Error: " . $el->LAST_ERROR;
    }
}
if ($warning && $_REQUEST["DATE"]) {
    echo 'Выбранные даты уже заполнены. Вы можете выбрать даты более поздние для заполнения';
}
?>
