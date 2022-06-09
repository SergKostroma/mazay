<!doctype html>
<html lang="ru">
<head>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <?

    use Bitrix\Main\Page\Asset;


    //string
    Asset::getInstance()->addString("<link rel='shortcut icon' href='/app/img/svg/favicon.svg' type='image/png' />");
    Asset::getInstance()->addString("<meta charset='UTF-8'>");
    Asset::getInstance()->addString("<meta http-equiv='X-UA-Compatible' content='ie=edge'>");
    Asset::getInstance()->addString("<meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>");

    //css
    Asset::getInstance()->addCss("/dist/css/vendor.min.css");
    Asset::getInstance()->addCss("/dist/css/styles.css");

    //js
    Asset::getInstance()->addJs("/dist/js/vendor.min.js");
    Asset::getInstance()->addJs("/dist/js/app.min.js");

    if (defined('RESERVATION_PAGE')) {
        Asset::getInstance()->addString("<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.21.1/daterangepicker.min.css\" integrity=\"sha512-nmvKZG8E3dANbZAsJXpdK6IqpfEXbPNbpe3M3Us1qTipq74IpTRShbpCf8lJFapB7e0MkDbNDKxLjS1VWt2vVg==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" />");
    }

    $APPLICATION->ShowHead();
    ?>
    <!--*******************Start Pixels*******************-->
    <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/include/pixels.php' ?>
    <!--********************End Pixels********************-->
</head>
<? $APPLICATION->ShowPanel(); ?>
<body>
<div class="layout">
    <div class="layout__content">
<? if (str_replace([$_SERVER["QUERY_STRING"], "?"], "", $_SERVER["REQUEST_URI"]) == '/') : ?>
    <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/layouts/header.php' ?>
<? else: ?>
    <? include $_SERVER["DOCUMENT_ROOT"] . '/_index/layouts/reservation-header.php' ?>
<? endif; ?>
