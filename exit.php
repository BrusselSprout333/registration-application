<?php
/// выход из аккаунта
setcookie('user', $_COOKIE['user'], time() - 3600, "/");
session_start();
unset($_SESSION['user']);
$_SESSION['auth'] = false;

header('Location: index.php');