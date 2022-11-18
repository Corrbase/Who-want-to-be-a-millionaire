<?php

include "Core/Core.php";
class Game extends Core {
    public function __construct($settings)
    {
        parent::__construct($settings);
    }

    public function CheckPlay($level = null)
    {
        if ($level == null){
            dd("you lost");
        }
        if (isset($_SESSION['play_run']))
        {
            $level = $level['level'];
            $NowLevel = array_search(false, $_SESSION['play_run']);
            $UrlLevel = "level_$level";
            if ($NowLevel != $UrlLevel) {
                dd("you lost");
            }
        }
    }
}