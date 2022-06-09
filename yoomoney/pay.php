<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use YooKassa\Client;

$id = intval($_GET["id"]);
if ($id) {
    $url = getPayUrl($id);
    LocalRedirect($url);
}
