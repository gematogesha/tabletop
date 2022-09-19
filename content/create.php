<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("../include/config.php");
$user_id  = $_SESSION['user_id'];

$game_role = mysqli_fetch_array($res = mysqli_query($con, "SELECT * FROM game_role WHERE user_id = '$user_id'"));
$game_name = ucfirst(array_flip($game_role)['master']);

$type = mysqli_fetch_array($res = mysqli_query($con, "SELECT * FROM type_game WHERE type_name = '$game_name'"));
$game_id = $type['id'];
?>
<div class="wrap">
    <div class="space-header"></div>
    <div class="big-header">Создать Игру</div>

    <?php
    $res = mysqli_query($con, "SELECT * FROM game_role WHERE user_id = '$user_id'");
    while ($row = mysqli_fetch_array($res)) {
        if (in_array('master', $row)) { ?>
            <div class="header-title" style="padding-bottom: 30px"><?php echo $game_name ?></div>

            <div class="input-data-row" style="display: none;">
                <i class="fa-regular fa-pencil"></i>
                <input class="input-data" type="text" id="type-game" placeholder="Название" maxlength="30" value="<?php echo $game_id; ?> ">
            </div>


            <div class="input-data-row">
                <i class="fa-regular fa-pencil"></i>
                <input class="input-data" type="text" id="name-game" placeholder="Название" maxlength="30">
            </div>

            <div class="input-data-row">
                <i class="fa-regular fa-pen"></i>
                <input class="input-data" type="text" id="description" placeholder="Описание">
            </div>

            <div class="input-data-row">
                <i class="fa-regular fa-calendar"></i>
                <input class="input-data" type="text" id="datepicker" placeholder="Выберете дату" autocomplete="off" readonly="readonly">
            </div>

            <div class="input-data-row input-group clockpicker" data-autoclose="true">
                <i class="fa-regular fa-clock"></i>
                <input class="input-data" type="text" id="timepicker" placeholder="Выберете время" autocomplete="off" readonly="readonly">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>



            <div class="yel-btn yel-btn-noindex">
                <button type="submit" name="create-game" class="btn" id="create-game">Создать игру</button>
            </div>

        <?php
        } else {
        ?>

            <div class="game-list">
                <div class="game-list-item">
                    <div class="game-name">Ты не можешь создавать игры</div>
                </div>
            </div>
    <?php } 
    } ?>
</div>


<script src="assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="assets/js/datepicker-rus.js" type="text/javascript"></script>
<script src="assets/js/clockpicker.js" type="text/javascript"></script>
<script src="assets/js/create-game.js" type="text/javascript"></script>

<script>
    $(function() {
        $("#datepicker").datepicker({
            minDate: 0
        });
    });

    $('.clockpicker').clockpicker();

    $(".input-data-row").click(function(e) {
        e.stopPropagation();
        $(this).addClass('active-input-data');
        $(".input-data-row").not(this).removeClass('active-input-data');
    });

    $(".input-data-row").focusout(function() {
        $(".input-data-row").removeClass('active-input-data');
    });
</script>