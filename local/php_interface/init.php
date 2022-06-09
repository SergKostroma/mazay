<?

include_once("include/const.php");
include_once("include/handlers.php");
include_once("include/functions.php");
require($_SERVER["DOCUMENT_ROOT"] . "/yoomoney/yookassa-sdk-php-master/lib/autoload.php");

$arSettings = getSettings();

if (str_replace([$_SERVER["QUERY_STRING"], "?"], "", $_SERVER["REQUEST_URI"]) == '/') {
    $arMainPage = getMainPageContent();
}
