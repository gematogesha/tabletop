<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("config.php");
session_unset();
echo 'Успешно!';
?>