<?php

class UserController{
    public $game;

    public function __construct($settings)
    {
        $this->game = model('users', $settings);
    }

    public function profile(){
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /');
        }
        view("login", null, '', 'HomePages');

    }
}
