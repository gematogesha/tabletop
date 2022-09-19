<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.html');
} else {
    $session = $_GET['p'];
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="favicon" rel="icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>Вход | Регистрация</title>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/color.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/datepicker.css">
    <link rel="stylesheet" href="assets/css/clockpicker.css">
    <link rel="stylesheet" href="assets/css/standalone.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <script src="assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
</head>

<body>
    <div class="preloader">
        <svg class="preloader__image" version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#fff" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
            
            </path>
        </svg>
    </div>
    <div class="body-block"></div>
    <?php include('include/menu.php'); ?>
</body>

<script type="text/javascript">
    var session = <?php echo json_encode($session); ?>;
</script>
<script src="assets/js/menu.js" type="text/javascript"></script>
<script src="assets/js/content.js" type="text/javascript"></script>
<script src="assets/js/show-game.js" type="text/javascript"></script>

</html>