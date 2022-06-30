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
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
</head>

<body>
    <div class="body-block"></div>
    <?php include('include/menu.php');?>
</body>
<script src="assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var session = <?php echo json_encode($session); ?>;
</script>
<script src="assets/js/menu.js" type="text/javascript"></script>
<script src="assets/js/content.js" type="text/javascript"></script>
<script src="assets/js/show-game.js" type="text/javascript"></script>

</html>