<?php

namespace App\Controller;

class Auth extends \App\Base
{
    public function auth()
    {
        $data = array();
        $data['file'] = "/Login/Login";
        $this->Assign($data);
    }

    public function register()
    {

    }

    public function openRegister()
    {
        $data['file'] = "/Login/Register";
        $this->Assign($data);
    }

    public function openFind()
    {
        $data['file'] = "/Login/Find";
        $this->Assign($data);
    }
}