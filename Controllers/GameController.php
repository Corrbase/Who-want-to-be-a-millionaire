<?php

class GameController{
    public $game;

    public function __construct($settings)
    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /');
        }
        if (isset($_SESSION['user_profile']['profile'])) {
            if ($_SESSION['user_profile']['profile'] == 1){

            }else{
                header('location: /login');
            }
        }
        $this->game = model('Game', $settings);
    }


    public function play()
    {
        $this->checkplay();
        view("Play", null, '', 'Game');
    }

    public function play_name()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if (isset($_SESSION['play'])){

                header('location: /play');

            }else{
                $_SESSION['play_run']['player'] = $_SESSION['user_profile']['login'];
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
                    '50' => false,
                    'call_to_friend' => false,
                    'Voice' => false,
                ];
                header('location: /play');
            }
        }else{
            header('Location: /home');
        }


    }

    public function play_game(){
        if (!isset($_SESSION['play'])){

            header('Location: /');

        }
        view('index', 'Game', '', 'Play');
    }

    public function play_gone()
    {
        if (!isset($_SESSION['play'])){
            // if user has session for playing
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $ajax = $_POST;
            $NowLevel = array_search(false, $_SESSION['play_run']['level']);
            $NowLevel = explode('_', $NowLevel);
            $NowLevel = $NowLevel[1];
            $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $NowLevel")->fetch_all(true);
            $question = $question[0];
            $wrongs = explode(',' , $question['wrong_answer']);
            if (isset($ajax['bonus'])){
                $this->bonus($ajax['bonus'], $question['right_answer'], $wrongs);
            }else{
                if ($question['right_answer'] == $ajax['question_ans']){
                    // check is user answer right
                    $NowLevel = array_search(false, $_SESSION['play_run']['level']);
                    $_SESSION['play_run']['level'][$NowLevel] = true;
                    $ajax['status'] = true;

                    echo json_encode($ajax);
                }else{
                    // if user answer false
                    $previous_level_id = $NowLevel;
                    if ($NowLevel - 1 < 1){
                        $previous_level_id = 1;
                    }
                    $question_last = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $previous_level_id")->fetch_all(true);
                    $prize = $question_last[0]['price'];
                    if (array_search(false, $_SESSION['play_run']['level']) == 'level_1'){
                        $prize = 0;
                    }
                    $level = $question_last[0]['number'];
                    $player = $_SESSION['play_run']['player'];
                    mysqli_query($this->game->conn, "INSERT INTO `gamers` (name, level, prize, status) VALUES ('$player', $level, '$prize', 'waiting');");
                    $ajax['status'] = false;
                    $ajax['right'] = $question['right_answer'];
                    echo json_encode($ajax);
                    unset($_SESSION['play']);
                    unset($_SESSION['play_run']);
                }
            }

        }else{
            // get function
            if (isset($_SESSION['play_run']))
            {
                if (array_search(false, $_SESSION['play_run']['level']) == 'level_15'){
                    echo 'you win ';
                    echo 'your prize is 1000000';
                                    unset($_SESSION['play']);
                unset($_SESSION['play_run']);
                }else{
                    $NowLevel = array_search(false, $_SESSION['play_run']['level']);
                    $NowLevel = explode('_', $NowLevel);
                    $NowLevel = $NowLevel[1];
                    $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $NowLevel")->fetch_all(true);
                    $question = $question[0];
                    $wrongs = explode(',' , $question['wrong_answer']);


                    $nextLvl = $NowLevel + 1;
                    $nextquestion = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $nextLvl")->fetch_all(true);
                    $nextquestion = $nextquestion[0];
                    $ajax = [
                        'now_fond' => $question['price'],
                        'next_fond' => $nextquestion['price']
                    ];


                    $this->game->question_name($question['question']);
                    $this->game->random_answers($wrongs, $question['right_answer']);
                    $this->game->bonuses();
                    $this->game->fond($ajax);
                }


            }
        }

    }

    public function bonus($bonus_name, $true, $false){
        $exist = $_SESSION['play_run']['bonus'];
                if ($exist[$bonus_name] == false) {
                    if ($bonus_name == 'call_to_friend') {
                        $rand = rand(1, 4);
                        echo 'hi ' . $_SESSION['play_run']['player'] . ', i think it is ' . $true;
                        $_SESSION['play_run']['bonus'][$bonus_name] = true;
                    } elseif ($bonus_name == '50') {
                        echo 'It is or ' . $true . ' or' . $false[1];
                        $_SESSION['play_run']['bonus'][$bonus_name] = true;
                    } elseif ($bonus_name == 'Voice') {
                        echo 'Voice think it is ' . $true;
                        $_SESSION['play_run']['bonus'][$bonus_name] = true;
                    }
                }else{
                    echo 'you cannot use the same bonus twice';
                }

    }

    public function checkplay()
    {
        if (isset($_SESSION['play'])){
            header('location: /play');
        }
    }

}
