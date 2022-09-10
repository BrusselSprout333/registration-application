<?php
/// выход из аккаунта - удаление cookie
$user = $_COOKIE['user'];
setcookie('user', $user['login'], time() - 3600, "/");
header('Location: index.php');