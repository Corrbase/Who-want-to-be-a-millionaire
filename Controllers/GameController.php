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
        if ($_POST){
            if (isset($_SESSION['play'])){

                header('location: /play');

            }else{
                $_SESSION['play_run']['player'] = $_POST['name'];
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

            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $ajax = $_POST;
            $NowLevel = array_search(false, $_SESSION['play_run']['level']);
            $NowLevel = explode('_', $NowLevel);
            $NowLevel = $NowLevel[1];
            $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $NowLevel")->fetch_all(true);
            $question = $question[0];
            if ($question['right_answer'] == $ajax['question_ans']){
                $NowLevel = array_search(false, $_SESSION['play_run']['level']);
                $_SESSION['play_run']['level'][$NowLevel] = true;
                $ajax['status'] = true;
                echo json_encode($ajax);
            }else{
//                $previous_level_id = $NowLevel - 1;
//                $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $previous_level_id");
                $ajax['status'] = false;
                echo json_encode($ajax);
                unset($_SESSION['play']);
                unset($_SESSION['play_run']);
            }
        }else{
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
                    $this->game->fond($ajax);
                }


            }
        }

    }


}
