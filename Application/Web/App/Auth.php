<?php

namespace App;

class Auth extends \App\Base
{
    public static $instance;

    public function Auth()
    {
        echo "Auth Auth";
    }

    public function Register()
    {
        echo "Auto Register";
    }
}