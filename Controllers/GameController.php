<?php

class GameController{
    public $game;

    public function __construct($settings)
    {
        $this->game = model('Game', $settings);
    }


    public function play()
    {
        $language = getLanguage();
        if (isset($_SESSION['admin_profile']) || isset($_SESSION['user_profile'])){
            $this->checkplay($language);

            $url = substr($_GET['url'], 3);
            $header = mysqli_query($this->game->conn, "SELECT * FROM `languages`  WHERE url = 'header' ")->fetch_all(true);
            $front = mysqli_query($this->game->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);
            view("Play", null, ['front' => $front,'language' => $language, 'header' => $header], 'Game');
        }elseif (!isset($_SESSION['user_profile'])){
            header("location: /$language/home");
        }
    }

    public function play_name()
    {
        $language = getLanguage();
        if (isset($_SESSION['admin_profile']) || isset($_SESSION['user_profile'])){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                if (isset($_SESSION['play'])){

                    header('location: /'. $language .'/play');

                }else{
                    $questionsCount = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `active` = 1");
                    $questions = $questionsCount->fetch_all(true);
                    $questionsCount = mysqli_num_rows($questionsCount);
                    $numbers = randomGen(1,$questionsCount,$questionsCount + 1);
                    $question_numbers = [];
                    foreach ($numbers as $key=>$value){
                        array_push($question_numbers, $questions[$value-1]['id']);

                    }

                    $_SESSION['play_run']['player'] = $_SESSION['user_profile']['login'];
                    if ($_SESSION['play_run']['player'] == ''){
                        $_SESSION['play_run']['player'] = $_SESSION['admin_profile']['login'];
                    }

                    $_SESSION['play'] = true;
                    $_SESSION['play_run']['questions_id'] = $question_numbers;

                    $_SESSION['play_run']['level_prices'] = [
                        'level_1' => 100,
                        'level_2' => 200,
                        'level_3' => 300,
                        'level_4' => 500,
                        'level_5' => 1000,
                        'level_6' => 2000,
                        'level_7' => 4000,
                        'level_8' => 8000,
                        'level_9' => 16000,
                        'level_10' => 32000,
                        'level_11' => 64000,
                        'level_12' => 125000,
                        'level_13' => 250000,
                        'level_14' => 500000,
                        'level_15' => 1000000,
                    ];
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
                    ];
                    $_SESSION['play_run']['bonus'] = [
                        '50' => false,
                        'call_to_friend' => false,
                        'Voice' => false,
                    ];
                    header('location: /'. $language .'/play');
                }
            }else{
                header("Location: / $language/home");
            }
        }else{
            header("Location: /$language/home");
        }


    }

    public function play_game(){
        $this->checkLogin(getLanguage());
        if (!isset($_SESSION['play'])){
            header('Location: /');

        }
        $language = getLanguage();
        $url = substr($_GET['url'], 3);

        $front = mysqli_query($this->game->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        view('index', 'Game', ['front' => $front,'language' => $language], 'Play');
    }

    public function play_gone()
    {
        if (!isset($_SESSION['play'])){

            header('Location: /');
        }
        $language = getLanguage();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $ajax = $_POST;
            $NowLevel = array_search(false, $_SESSION['play_run']['level']);
            $NowLevel = explode('_', $NowLevel);
            $NowLevel = $NowLevel[1];
            $id = $_SESSION['play_run']['questions_id'][$NowLevel - 1];
            $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
            $question = $question[0];
            $wrongs = explode(',' , $question['wrong_answer_'. $language]);
            if (isset($ajax['end_game'])){
                if ($ajax['prize'] == 0){
                    if ($_SESSION['play_run']['level']['level_1'] === false)
                    $ajax['end'] = false;
                    echo json_encode($ajax);
                    unset($_SESSION['play']);
                    unset($_SESSION['play_run']);
                }else{
                    $previous_level = $NowLevel - 1;
                    $level_name = 'level_' . $previous_level;
                    $prize = $_SESSION['play_run']['level_prices'][$level_name];
                    $player = $_SESSION['play_run']['player'];

//                    $prize = $_SESSION['play_run']['level_prices'][$previous_level - 1];

                    mysqli_query($this->game->conn, "INSERT INTO `gamers` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$player', '$previous_level', $prize, 'waiting', 0)");
                    $ajax['end'] = true;
                    $ajax['prize'] = true;
                    echo json_encode($ajax);
                    unset($_SESSION['play']);
                    unset($_SESSION['play_run']);
                }
            }

            elseif (isset($ajax['bonus'])){
                $this->bonus($ajax['bonus'], $question['right_answer_' . $language], $wrongs, $language);
            }else{
                if ($question['right_answer_' . $language] == $ajax['question_ans']){
                    // check is user answer right
                    $NowLevel = array_search(false, $_SESSION['play_run']['level']);
                    $_SESSION['play_run']['level'][$NowLevel] = true;
                    $ajax['status'] = true;

                    echo json_encode($ajax);

                }else{
                    // if user answer false
                    $player = $_SESSION['play_run']['player'];
                    if ($_SESSION['play_run']['level']['level_5'] === true){
                        mysqli_query($this->game->conn, "INSERT INTO `gamers` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$player', '$NowLevel', 1000, 'waiting', 0)");
                        $ajax['status'] = false;
                        $ajax['prize'] = true;
                        $ajax['prize_count'] = 1000;
                        $ajax['right'] = $question['right_answer_' . $language];
                        echo json_encode($ajax);
                        unset($_SESSION['play']);
                        unset($_SESSION['play_run']);
                    }elseif ($_SESSION['play_run']['level']['level_5'] === true){
                        mysqli_query($this->game->conn, "INSERT INTO `gamers` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$player', '$NowLevel', 32000, 'waiting', 0)");
                        $ajax['status'] = false;
                        $ajax['prize'] = true;
                        $ajax['prize_count'] = 1000;
                        $ajax['right'] = $question['right_answer_' . $language];
                        echo json_encode($ajax);
                        unset($_SESSION['play']);
                        unset($_SESSION['play_run']);
                    } else{
                        $ajax['status'] = false;
                        $ajax['prize'] = false;
                        $ajax['right'] = $question['right_answer_' . $language];
                        echo json_encode($ajax);
                        unset($_SESSION['play']);
                        unset($_SESSION['play_run']);
                    }

                }
            }

        }else{
            // get function
            if (isset($_SESSION['play_run']))
            {
                if (array_search(false, $_SESSION['play_run']['level']) == 'level_15'){
                    echo json_encode('you win, your prize is 1000000');
                    $player = $_SESSION['play_run']['player'];
                    mysqli_query($this->game->conn, "INSERT INTO `gamers` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$player', 30, 100000 , 'waiting', 0)");
                    unset($_SESSION['play']);
                    unset($_SESSION['play_run']);
                }else{

                    $NowLevel = array_search(false, $_SESSION['play_run']['level']);
                    $NowLevel = explode('_', $NowLevel);
                    $NowLevel = $NowLevel[1];
                    $id = $_SESSION['play_run']['questions_id'][$NowLevel - 1];
                    $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
                    $question = $question[0];
                    $wrongs = explode(',' , $question['wrong_answer_' . $language]);
                    $nextLvl = $NowLevel + 1;

                    $nextquestion = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
                    $nextquestion = $nextquestion[0];


                    $previous_level = $NowLevel - 1;
                    $Nowlevel_name = 'level_' . $previous_level;
                    $Nextlevel_name = 'level_' . $NowLevel;

                    if ($Nowlevel_name == 'level_0'){
                        $NextPrize = $_SESSION['play_run']['level_prices'][$Nextlevel_name];
                        $ajax['now_fond'] = 0;
                        $ajax['next_fond'] = $NextPrize;
                    }else{
                        $NowPrize = $_SESSION['play_run']['level_prices'][$Nowlevel_name];
                        $NextPrize = $_SESSION['play_run']['level_prices'][$Nextlevel_name];
                        $ajax['now_fond'] = $NowPrize;
                        $ajax['next_fond'] = $NextPrize;
                    }

                    $question_data = [
                        'wrongs' => $wrongs, 'question' => $question['right_answer_' . $language]
                    ];
                    $data = [
                        'question_name' => $question[$language],
                        'question_data' => $question_data,
                        'fond' => $ajax
                    ];
                    render($data, 'Questions');
                }


            }
        }

    }



    public function bonus($bonus_name, $true, $false, $language){
        $exist = $_SESSION['play_run']['bonus'];

        if ($language == 'en'){
            if ($exist[$bonus_name] == false) {
                if ($bonus_name == 'call_to_friend') {
                    $rand = rand(1, 4);
                    $err = 'Hi ' . $_SESSION['play_run']['player'] . ', i think it is "' . $true . '"';

                    echo json_encode($err);
                    $_SESSION['play_run']['bonus'][$bonus_name] = true;
                } elseif ($bonus_name == '50') {
                    $randfalse = rand(0,2);
                    $err = 'It is or "' . $true . '" or "' . $false[$randfalse] . '"';
                    echo json_encode($err);
                    $_SESSION['play_run']['bonus'][$bonus_name] = true;
                } elseif ($bonus_name == 'Voice') {
                    $prcnt = rand(50, 100); //  get random number
                    $err = $prcnt .' percent of coward voice think that it is "'. $true . '"';
                    echo json_encode($err);
                    $_SESSION['play_run']['bonus'][$bonus_name] = true;
                }
            }else{
                $err = 'You cannot use the same bonus twice';
                    echo json_encode($err);
            }
        }elseif ($language == 'hy'){
            if ($exist[$bonus_name] == false) {
                if ($bonus_name == 'call_to_friend') {
                    $rand = rand(1, 4);
                    $err = 'Բարև ' . $_SESSION['play_run']['player'] . ', ես կարծում եմ դա "' . $true . '"-ն է';
                    echo json_encode($err);
                    $_SESSION['play_run']['bonus'][$bonus_name] = true;
                } elseif ($bonus_name == '50') {
                    $randfalse = rand(0,2);
                    $err = 'Դա կամ "' . $true . '"-ն է կամ էլ "' . $false[$randfalse] . '"-ը';
                    echo json_encode($err);
                    $_SESSION['play_run']['bonus'][$bonus_name] = true;
                } elseif ($bonus_name == 'Voice') {
                    $prcnt = rand(50, 100); //  get random number
                    $err = 'Դայլիճի ձայնի  ' . $prcnt .' տոկոսը կարծում է որ դա "'. $true . '"-ն է';
                    echo json_encode($err);
                    $_SESSION['play_run']['bonus'][$bonus_name] = true;
                }
            }else{
                $err = 'Դուք չեք կարող օգտագործել նույն բոնուսը երկու անգամ';
                echo json_encode($err);
            }
        }


    }

    public function checkplay($language)
    {
        if (isset($_SESSION['play'])){

            header('location: /'. $language .'/play');
        }
    }

    public function checkLogin($lang){
        if (isset($_SESSION['admin_profile']['profile']) || isset($_SESSION['user_profile']['profile'])) {

        }else{
            header("location: /$lang/login");
        }

    }

}
