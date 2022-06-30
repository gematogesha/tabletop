<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("../include/config.php");

$login = $_SESSION['login'];

$row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE login = '$login'"));

$name = $row['name'];
$user_id = $row['id'];
$photo = $row['photo'];

$row_role = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM game_role WHERE user_id = '$user_id'"));

?>
<script src="assets/js/logout.js" type="text/javascript"></script>
<div class="header-profile">
    <div class="wrap">
        <div class="space-header"></div>
        <div class="profile-main-info">
            <div class="profile-main">

                <div class="big-header"><?php echo ucfirst($name); ?></div>
                <div class="header-title"><i style="color: #000;">@<?php echo strtolower($login); ?></i></div>
            </div>
            <div class="game-role">
                <?php

                if (in_array('master', $row_role)) {
                ?>
                    <div class="master-img" style="background-image: url('<?php echo $photo; ?>');" title="<?php echo $name; ?>"></div>
                <?php } elseif (in_array('slave', $row_role)) { ?>
                    <div class="slave-img" style="background-image: url('<?php echo $photo; ?>');" title="<?php echo $name; ?>"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="wrap">
<div class="big-header">Выбери роль</div>
    <div class="logout">Выход</div>

</div>
