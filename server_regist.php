<?php
//работа сервера при регистрации
if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{
    if (!$_POST) exit('No direct script access allowed');

    require "CRUD.php";
    require "USER.php";

    $user = new User();
    $login = strip_tags(addslashes($_POST['login']));// защита от xss
    $pass = strip_tags(addslashes($_POST['password']));
    $name = strip_tags(addslashes($_POST['name']));
    $email = strip_tags(addslashes($_POST['email']));

    $user->regist($name, $email, $login);
    $user->hash($pass); //хешируем пароль

    $json = new Crud; //чтение бд
    $json->create();
    $json->read();

    $uniq = true;
    $uniq = $user->uniq($json); //проверка на уникальность

    if($uniq)
    {
        $json->setData($user);
        $json->write();

        $user->set_cookie(count($json->data)-1, $json); //куки
        $user->set_session(count($json->data)-1, $json); //сессия

        $response = array('name' => $user->name, 'email' => $user->email,
            'login' =>$user->login, 'password' => $user->password, 'salt' => $user->salt);
        echo json_encode($response);
    }
}
    else exit("Error! Only ajax requests");
?>