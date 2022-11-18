<?php

class GameController{
    public $game;

    public function __construct($settings)
    {
        $this->game = model('Game', $settings);
    }

    public function index(){
        view("Home", null, '', 'Game');
    }

    public function play()
    {

        view("Play", null, '', 'Game');
    }

    public function play_name()
    {
        if (isset($_SESSION['play'])){


            unset($_SESSION['play']);
            unset($_SESSION['play_run']['level']);
            unset($_SESSION['play_run']['bonus']);
            dd(6);

        }else{

            $_SESSION['play'] = true;
            $_SESSION['play_run']['level'] = [
                'level_1' => false,
                'level_2' => false,
                'level_3' => false,
                'level_4' => false,
                'level_5' => false,
                'level_6' => false,
                'level_7' => false,
                'level_8' => false,
                'level_9' => false,
                'level_10' => false,
                'level_11' => false,
                'level_12' => false,
                'level_13' => false,
                'level_14' => false,
                'level_15' => false,
                'level_16' => false,
                'level_17' => false,
                'level_18' => false,
                'level_19' => false,
                'level_20' => false,
                'level_21' => false,
                'level_22' => false,
                'level_23' => false,
                'level_24' => false,
                'level_25' => false,
                'level_26' => false,
                'level_27' => false,
                'level_28' => false,
                'level_29' => false,
                'level_30' => false,
            ];
            $_SESSION['play_run']['bonus'] = [
                '50/50' => false,
                'Call to friend' => false,
                '__' => false,
            ];
        }

    }

    public function play_level($level)
    {
        dd(array_search(false, $_SESSION['play_run']['level']));
        $this->game->CheckPlay($level);

    }


}
