<?php

class User
{
    public $name;
    public $email;
    public $login;
    public $password;
    public $salt;

    function auth($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    function regist($name, $email, $login)
    {
        $this->login = $login;
        $this->name = $name;
        $this->email = $email;
    }

    function hash($pass)
    {
        $this->salt = sha1($this->login);
        $this->password = md5($pass . $this->salt);
    }

    function match($json)
    {
        for($i = 0; $i<count($json->data);$i++)
        {
            $salt = $json->data[$i]['salt'];
            $pass_hashed = md5($this->password . $salt);
            if($this->login === $json->data[$i]['login'])
            {
                if($pass_hashed === $json->data[$i]['password'])
                {
                    if (!isset($_COOKIE['user'])) { // создание куки
                        $this->set_cookie($i, $json);
                    }
                    //echo "Вы авторизовались";
                    return true;
                }
            }
        }
    }

    function uniq($json)
    {
        for($i = 0; $i<count($json->data);$i++) {
            if($this->login == $json->data[$i]['login'])
            {
                echo "Аккаунт с таким логином уже существует";
                return false;
            }
            else if($this->email == $json->data[$i]['email'])
            {
                echo "Аккаунт с таким email уже существует";
                return false;
            }
        }
        return true;
    }

    function set_cookie($num, $json)
    {
        setcookie('user', $json->data[$num]['name'], time() + 3600, "/");
        $_COOKIE['user'] = $json->data[$num]['name'];
        return 0;
    }
}
