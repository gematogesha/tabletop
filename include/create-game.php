<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("config.php");
if (isset($_POST['create_submit'])) {
    $type_game = rtrim($_POST['type_game']);
    $name_game = rtrim($_POST['name_game']);
    $description = rtrim($_POST['description']);
    $date_game = rtrim($_POST['date_game']);
    $time_game = rtrim(($_POST['time_game']));
    $res = mysqli_query($con, "SELECT date FROM games");
    $date_check = [];
    $format_date = rtrim(date('Y-m-d ', strtotime($date_game)));
    while ($row = mysqli_fetch_array($res)) {
        array_push($date_check, $row[0]); 
    }
    if (in_array($format_date, $date_check)) {
        echo "Игра с такой датой уже есть";
        exit();
    } else {
        if($type_game == '' or $name_game == '' or $date_game == '' or $time_game == ''){
            echo "Не все данные были введены";
            exit();
        }else{

            $sql = mysqli_query($con, "INSERT INTO games (type_id, name, description, date, time) VALUES ('$type_game', '$name_game', '$description', '$format_date', '$time_game')");

            $go_id = mysqli_insert_id($con);

            $go_sql = mysqli_query($con, "INSERT INTO go_list (game_id) VALUES ('$go_id')");
            if ($sql and $go_sql) {
                echo "Успешно!";
            } else {
                echo "Не удалось создать игру";
                exit();
            }
        }
    } 
}
?>