<?php

class GameController{
    public $game;

    public function __construct($settings)
    {
        $this->admin = model('Game', $settings);
    }

    public function index(){
        view("Game/Home", 'asas');
    }
}
