<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("../include/config.php");

$monthes = array(
    1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
    5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
    9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
);

$days = array('Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб');

$row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM games ORDER BY date, time"));
$cnt = mysqli_fetch_array(mysqli_query($con, "SELECT count(*) FROM games"))[0];
$type_id = $row['type_id'];
$row_type = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM type_game WHERE id = '$type_id'"));
$type_name = $row_type['type_name'];

$date = date('d ', strtotime($row['date'])) . $monthes[(date('n'))] . date(' Y', strtotime($row['date'])) . ' (' . $days[(date('w', strtotime($row['date'])))] . ')';
$time = date('H:i ', strtotime($row['time']));

$id = $row['id'];

$aDate = time();
$bDate = strtotime($row['date']); // Установленная мною дата
 
$datediff = $bDate - $aDate;


function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%aд, %hч, %iм');
}

?>
<div class="wrap">
    <div class="space-header"></div>
    <div class="big-header">Ближайшая</div>
    <?php if ($row) { ?>
        <div class="header-title">Осталось <?php echo secondsToTime($datediff); ?></div>
    <?php } else { ?>
        <div class="header-title">Игру еще не создали</div>
    <?php }; ?>
    <div class="game-list">
        <div class="game-list-item near">
            <?php if ($row) { ?>
                <div class="game-main-info">
                    <div class="game-main">
                        <div class="game-name"><?php echo strtoupper($row['name']); ?></div>
                        <div class="game-type"><?php echo $type_name; ?></div>
                        <div class="game-data"><?php echo $date . ' - ' . $time; ?></div>
                    </div>
                    <div class="game-role">
                        <?php
                        $row_master = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM game_role WHERE $type_name = 'master'"));
                        if ($row_master) {
                            $user_id = $row_master['user_id'];
                            $row_photo = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$user_id'"));
                        ?>
                            <div class="master-img" style="background-image: url('<?php echo $row_photo['photo']; ?>');" title="<?php echo $row_photo['name']; ?>"></div>
                        <?php } else { ?>
                            <div class="master-img" style="background-image: url('../img/nophoto.jpg');" title="<?php echo $row_photo['name']; ?>"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="game-add-info">
                    <div class="game-add-info-grid">
                        <?php
                        $res_slave = mysqli_query($con, "SELECT * FROM game_role WHERE $type_name = 'slave'");

                        $go_list = [];
                        $indet_list = [];
                        $no_list = [];

                        while ($row_slave = mysqli_fetch_array($res_slave)) {

                            $user_id = 'user_id_' . $row_slave['user_id'];

                            $row = mysqli_fetch_array(mysqli_query($con, "SELECT $user_id FROM go_list WHERE game_id = '$id' AND $user_id = 1"));
                            if (isset($row[$user_id])) {
                                $id_name = explode("_", $user_id)[2];
                                $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$id_name'"));
                                array_push($go_list, $row['photo']);
                            }

                            $row = mysqli_fetch_array(mysqli_query($con, "SELECT $user_id FROM go_list WHERE game_id = '$id' AND $user_id = 0"));
                            if (isset($row[$user_id])) {
                                $id_name = explode("_", $user_id)[2];
                                $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$id_name'"));
                                array_push($indet_list, $row['photo']);
                            }

                            $row = mysqli_fetch_array(mysqli_query($con, "SELECT $user_id FROM go_list WHERE game_id = '$id' AND $user_id = -1"));
                            if (isset($row[$user_id])) {
                                $id_name = explode("_", $user_id)[2];
                                $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$id_name'"));
                                array_push($no_list, $row['photo']);
                            }
                        } ?>
                        <div class="go-game">Пойдут: </div>
                        <div class="go-list">
                            <?php
                            $i = 0;
                            foreach ($go_list as $photo) { ?>
                                <div class="circle" style="z-index: <?php echo (100 - $i) ?>; background-image: url('<?php echo $photo; ?>')"></div>
                            <?php $i++;
                            } ?>
                        </div>
                        <div class="indet-game">Не знают: </div>
                        <div class="go-list">
                            <?php
                            $i = 0;
                            foreach ($indet_list as $photo) { ?>
                                <div class="circle" style="z-index: <?php echo (100 - $i) ?>; background-image: url('<?php echo $photo; ?>')"></div>
                            <?php $i++;
                            } ?>
                        </div>
                        <div class="no-game">Не пойдут: </div>
                        <div class="go-list">
                            <?php
                            $i = 0;
                            foreach ($no_list as $photo) { ?>
                                <div class="circle" style="z-index: <?php echo (100 - $i) ?>; background-image: url('<?php echo $photo; ?>')"></div>
                            <?php $i++;
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="game-name">ИГРЫ НЕТ</div>
            <?php }; ?>

        </div>
    </div>
    <div class="dark-line"></div>
    <div class="big-header">Игры</div>

    <?php
    $res = mysqli_query($con,  "SELECT * FROM games ORDER BY date, time");

    if ($cnt > 1) { ?>
        <div class="header-title">Других игр: <?php echo $cnt - 1; ?> </div>
        <div class="game-list">
            <?php
            while ($row = mysqli_fetch_array($res)) {
                if ($row['id'] != $id) {
                    $id = $row['id'];
                    $type_id = $row['type_id'];
                    $row_type = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM type_game WHERE id = '$type_id'"));
                    $type_name = $row_type['type_name'];

                    $date = date('d ', strtotime($row['date'])) . $monthes[(date('n'))] . date(' Y', strtotime($row['date'])) . ' (' . $days[(date('w', strtotime($row['date'])))] . ')';
                    $time = date('H:i ', strtotime($row['time']));
            ?>
                    <div class="game-list-item">
                        <div class="game-main-info">
                            <div class="game-main">
                                <div class="game-name"><?php echo strtoupper($row['name']); ?></div>
                                <div class="game-type"><?php echo $type_name; ?></div>
                                <div class="game-data"><?php echo $date . ' - ' . $time; ?></div>
                            </div>
                            <div class="game-role">
                                <?php
                                $row_role = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM game_role WHERE $type_name = 'master'"));
                                if ($row_role and $row_photo['photo'] != NULL) {
                                    $user_id = $row_role['user_id'];
                                    $row_photo = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$user_id'"));
                                ?>
                                    <div class="master-img" style="background-image: url('<?php echo $row_photo['photo']; ?>');" title="<?php echo $row_photo['name']; ?>"></div>
                                <?php } else { ?>
                                    <div class="master-img" style="background-image: url('../img/nophoto.jpg');" title="<?php echo $row_photo['name']; ?>"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="game-add-info">
                            <div class="game-add-info-grid">
                                <?php
                                $res_slave = mysqli_query($con, "SELECT * FROM game_role WHERE $type_name = 'slave'");

                                $go_list = [];
                                $indet_list = [];
                                $no_list = [];

                                while ($row_slave = mysqli_fetch_array($res_slave)) {

                                    $user_id = 'user_id_' . $row_slave['user_id'];

                                    $row = mysqli_fetch_array(mysqli_query($con, "SELECT $user_id FROM go_list WHERE game_id = '$id' AND $user_id = 1"));
                                    if (isset($row[$user_id])) {
                                        $id_name = explode("_", $user_id)[2];
                                        $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$id_name'"));
                                        array_push($go_list, $row['photo']);
                                    }

                                    $row = mysqli_fetch_array(mysqli_query($con, "SELECT $user_id FROM go_list WHERE game_id = '$id' AND $user_id = 0"));
                                    if (isset($row[$user_id])) {
                                        $id_name = explode("_", $user_id)[2];
                                        $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$id_name'"));
                                        array_push($indet_list, $row['photo']);
                                    }

                                    $row = mysqli_fetch_array(mysqli_query($con, "SELECT $user_id FROM go_list WHERE game_id = '$id' AND $user_id = -1"));
                                    if (isset($row[$user_id])) {
                                        $id_name = explode("_", $user_id)[2];
                                        $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id = '$id_name'"));
                                        array_push($no_list, $row['photo']);
                                    }
                                } ?>
                                <div class="go-game">Пойдут: </div>
                                <div class="go-list">
                                    <?php
                                    $i = 0;
                                    foreach ($go_list as $photo) { ?>
                                        <div class="circle" style="z-index: <?php echo (100 - $i) ?>; background-image: url('<?php echo $photo; ?>')"></div>
                                    <?php $i++;
                                    } ?>
                                </div>
                                <div class="indet-game">Не знают: </div>
                                <div class="go-list">
                                    <?php
                                    $i = 0;
                                    foreach ($indet_list as $photo) { ?>
                                        <div class="circle" style="z-index: <?php echo (100 - $i) ?>; background-image: url('<?php echo $photo; ?>')"></div>
                                    <?php $i++;
                                    } ?>
                                </div>
                                <div class="no-game">Не пойдут: </div>
                                <div class="go-list">
                                    <?php
                                    $i = 0;
                                    foreach ($no_list as $photo) { ?>
                                        <div class="circle" style="z-index: <?php echo (100 - $i) ?>; background-image: url('<?php echo $photo; ?>')"></div>
                                    <?php $i++;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php }
            }
        } else { ?>
            <div class="header-title">Другие игры еще не создали</div>
            <div class="game-list">
                <div class="game-list-item">
                    <div class="game-name">ДРУГИХ ИГР НЕТ</div>
                </div>
            </div>
        <?php }; ?>
        </div>
</div>
<script src="assets/js/show-game.js" type="text/javascript"></script>