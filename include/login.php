<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("config.php");
if (isset($_POST['login_submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $res = mysqli_query($con, "SELECT * FROM users WHERE login='$login' and password='$password'");
    $row = mysqli_fetch_array($res);

    if ($row > 0) {
        $_SESSION['login'] = $login;
        $_SESSION['user_id'] = $row['id'];
        echo "Успешно!";
    } elseif ($login == '' or $password == '') {
        echo "Не все данные были введены";
        exit();
    } else {
        echo "Неправильное имя пользователя или пароль";
        exit();
    }
}

if (isset($_POST['reg_submit'])) {
    $login = rtrim($_POST['login']);
    $name = rtrim($_POST['name']);
    $password = $_POST['password'];
    $second_password = $_POST['second_password'];
    $res = mysqli_query($con, "SELECT login FROM users");
    $log_name = [];
    while ($row = mysqli_fetch_array($res)) {
        array_push($log_name, $row[0]); 
    }
    if (in_array($login, $log_name)) {
        echo "Аккаунт с таким логином уже зарегистрирован";
        exit();
    } else {
        if ($password == $second_password and preg_match("/^[\w ]+$/i", $login) == 1 and $login != '' and $name != '' and $password != '') {

            $sql = mysqli_query($con, "INSERT INTO users (login, name, password, photo) VALUES ('$login', '$name', '$password', 'https://api.multiavatar.com/".$login.".svg')");

            $res_role = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE login = '$login'"));
            $role_id = $res_role['id'];

            $role_sql = mysqli_query($con, "INSERT INTO game_role (user_id) VALUES ('$role_id')");
            
            $go_sql = mysqli_query($con, "ALTER TABLE go_list ADD user_id_$role_id INT(11) NOT NULL DEFAULT '0'");
            if ($sql and $role_sql and $go_sql) {
                $user_id = mysqli_insert_id($con);
                $_SESSION['login'] = $login;
                $_SESSION['user_id'] = $user_id;
                echo "Успешно!";
            } else {
                echo "Не удалось зарегистрироваться";
                exit();
            }
        } elseif ($login == '' or $name == '' or $password == '' or $second_password == '') {
            echo "Не все данные были введены";
            exit();
        } elseif ($password != $second_password) {
            echo "Пароли не совпадают";
            exit();
        } elseif (preg_match("/^[\w ]+$/i", $login) == 0) {
            echo "Логин должен быть написан латинскими буквами";
            exit();
        }
    }
}
?>