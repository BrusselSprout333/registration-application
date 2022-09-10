<?php
//работа сервера при авторизации
if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{
    if (!$_POST) exit('No direct script access allowed');

    require "CRUD.php";
    require "USER.php";

    $login = strip_tags(addslashes($_POST['login']));
    $pass = strip_tags(addslashes($_POST['password']));// защита от xss
    $user = new User();
    $user->auth($login, $pass);

    $json = new Crud;
    $json->create();
    $json->read();   //чтение бд

    $account_matches = false;
    $account_matches = $user->match($json);   //поиск аккаунта в бд

    if(!$account_matches)
    {
        echo "Пользователь не найден";
        exit();
    }

}
else echo "Error! Only ajax requests";

?>