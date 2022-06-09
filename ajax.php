<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$action = $_REQUEST['action'];
$data = $_REQUEST['data'];

switch ($action) {
    case "SEND_FORM" :
        $result = sendForm($data);
        echo json_encode($result);
        break;
    case "OPEN_MODAL":
        ob_start();
        $APPLICATION->IncludeComponent('msnet:modal', 'modal', $data);
        $result = ob_get_clean();
        ob_end_clean();
        echo json_encode($result);
        break;
    case "BACK" :
        $result = back();
        echo json_encode($result);
        break;
    case "GET_DATES":
        $result = getDates($data);
        if ($result) {
            $_SESSION["STEP"] = "2";
            $_SESSION["RESERVATION"] = $result;
        } else {
            ob_start();
            include $_SERVER["DOCUMENT_ROOT"] . '/reservation/_include/notFound.php';
            $result["NOT_FOUND"] = ob_get_clean();
            ob_end_clean();
        }
        echo json_encode($result);
        break;
    case "CHECKED_HOUSE":
        $result = checkedHouse($data);
        echo json_encode($result);
        break;
    case "ORDER":
        $result = createOrder($data);
        echo json_encode($result);
        break;
}