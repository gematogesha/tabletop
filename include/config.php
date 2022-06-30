<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tabletop');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($con == false) {
    echo "Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error();
}
?> 

