<?php

class Crud
{
    public $data;
    private $url = 'json/users.json';

    public function create()
    {
        if (!file_exists($this->url) || empty($this->url)) {
            file_put_contents($this->url, json_encode([]));
        }
    }

    public function delete()
    {
        if (file_exists($this->url)) {
            unlink($this->url);
        }
        else echo "Error";
    }

    public function read()  //чтение
    {
        if (file_exists($this->url)) {
            $this->data = json_decode(file_get_contents($this->url), true);
        } else echo "Error";
    }

    function write() // = update
    {
        if (file_exists($this->url)) {
            file_put_contents($this->url, json_encode($this->data));
        } else echo "Error";
    }

    public function setData($user)
    {
        $this->data[count($this->data)]['name'] = $user->name;
        $this->data[count($this->data)-1]['login'] = $user->login;
        $this->data[count($this->data)-1]['email'] = $user->email;
        $this->data[count($this->data)-1]['password'] = $user->password;
        $this->data[count($this->data)-1]['salt'] = $user->salt;
    }
}
