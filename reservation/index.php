<?
define('RESERVATION_PAGE', 'Y');
?>
<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php' ?>
<?php header('Location: /'); ?>
<? $APPLICATION->SetTitle('Бронирование номера. Мазай'); ?>
    <script>
        var step = '<?= json_encode($_SESSION["STEP"])?>';
    </script>
    <div class="breadcrumbs">
        <div class="container">
            <a href="javascript:void(0);" onclick="backClick()" class="breadcrumbs__back">Назад</a>
            <ul class="breadcrumbs__steps js-scroll-left">
                <li class="breadcrumbs__step <?= ($_GET["step"] == "1") ? 'active' : 'complete' ?>">
                    <span>Выбор даты</span></li>
                <li class="breadcrumbs__step <?= ($_GET["step"] == "2") ? 'active' : '' ?> <?= ($_GET["step"] == "3") ? 'complete' : '' ?>">
                    <span>Выбор апартаментов</span></li>
                <li class="breadcrumbs__step <?= ($_GET["step"] == "3") ? 'active' : '' ?>">
                    <span>Оформление номера</span>
                </li>
            </ul>
        </div>
    </div>

<?
if ($_SESSION["STEP"]) {
    include "_include/step-{$_SESSION["STEP"]}.php";
} elseif ($_GET["step"] != "1") {
    header('location:' . $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . '/reservation/?step=1');
} else {
    include "_include/step-{$_GET["step"]}.php";
}
?>

    <script>
        function backClick() {
            SendAjax("BACK", '', function (data) {
                if (data === "/") {
                    window.location.href = '/';
                } else {
                    window.location.href = window.location.origin + '/reservation/?step=' + data
                }

            })
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.21.1/jquery.daterangepicker.min.js" integrity="sha512-jM36zj/2doNDqDlSIJ+OAslGvZXkT+HrtMM+MMgVxCqax1AIm1XAfLuUFP7uMSavUxow+z/T2CRnSu7PDaYu2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<? require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/footer.php' ?>