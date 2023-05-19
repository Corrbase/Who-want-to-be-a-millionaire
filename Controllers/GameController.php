<?php

class GameController{
    public $game;
    public $front = [];
    public $header = [];

    public function __construct($settings)
    {
        $this->game = model('Game', $settings);
        $url = substr($_GET['url'], 3); // get url and cut language part
        $arr = mysqli_query($this->game->conn, "SELECT * FROM `languages`  WHERE url = '$url' OR `url` = 'header' ")->fetch_all(true); // get all language content
        foreach ($arr as $item=>$key){
            if ($url == $key['url']){
                array_push($this->front, $key);
            } // add to $front front content
            if ($key['url'] == 'header'){

                array_push($this->header, $key);
            } // add to $header header and include content
        }
    }

    //
    public function index()
    {

        // Get the page language
        $language = getLanguage();
        // Check if user is logged
        $this->checkLogin($language);
        // Check if the user can play the game
        $this->checkplay($language);

        // Retrieve language settings and game details from database
        $url = substr($_GET['url'], 3);
        $arr = mysqli_query($this->game->conn, "SELECT * FROM `languages`  WHERE url = 'header' OR url = '$url'")->fetch_all(true);
        $front = [];
        $header = [];
        foreach ($arr as $item=>$key){
            if ($url == $key['url']){
                array_push($front, $key);
            }
            if ($key['url'] == 'header'){

                array_push($header, $key);
            }
        }
        view("Play", null, ['front' => $this->front,'language' => $language, 'header' => $this->header], 'Game');

    }


    public function play_backend()
    {
        // get language
        $language = getLanguage();
        $this->checkLogin($language);
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $login = $this->getLogin();
                $userId = (mysqli_query($this->game->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc())['id'];
                $game_session = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId ");
                if ($game_session){
                    $game_session = $game_session->fetch_assoc();
                }


                if ($game_session['active'] == 1){

                    header('location: /'. $language .'/play');

                }else{

                    $random = time() . chr(rand(65, 90));
                    $checkRandom = 1;
                    while (isset($checkRandom)){
                        $checkRandom = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `game_id` = '$random'")->fetch_assoc();
                        $random = time() . chr(rand(65, 90));
                    }
                    $time = date('Y/m/d h:i:s');
                    mysqli_query($this->game->conn, "INSERT INTO `user_game_session` (`user_id`, `game_id`, `active`, `level`, `created_at`) VALUES ($userId, '$random', 1, 1, '$time')");
                    mysqli_query($this->game->conn, "INSERT INTO `bonuses`( `active`, `fifty_fifty`, `call_friend`, `ask_audience`, `user_id`) VALUES (1,0,0,0,$userId)");
                    header('location: /'. $language .'/play');
                }
            }else{
                header("Location: /$language/home");
            }



    }

    public function play_game(){
        $language = getLanguage();
        $this->checkLogin($language);
        $login = $this->getLogin();

        $userId = (mysqli_query($this->game->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc())['id'];
        $game_session = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId ");
        if ($game_session){
            $game_session = $game_session->fetch_assoc();
        }
        if ($game_session['active'] == 0){

            header('location: /'. $language .'/home');

        }
        // Check if user is logged in
        $this->checkLogin(getLanguage());

        // Retrieve language settings and game details from database
        $language = getLanguage();
        $url = substr($_GET['url'], 3);

        $front = mysqli_query($this->game->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        // Render the game page with the retrieved data
        view('index', 'Game', ['front' => $this->front,'language' => $language], 'Play');
    }

    public function play_gone()
    {
        $language = getLanguage();
        $this->checkLogin($language);
        $login = $this->getLogin();
        $profile = mysqli_query($this->game->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc();
        $userId = $profile['id'];
        $game_session = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId ")->fetch_assoc();

        $levels = mysqli_query($this->game->conn, "SELECT * FROM `levels`");
        $level_price = $levels->fetch_all(true);
        $levels_conut = $levels->num_rows;

        if ($game_session['active'] == 0){
            header("Location: /$language/home");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $ajax = $_POST;


            $NowLevel = $game_session['level'];
            $id = $game_session['question_id'];
            $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
            $question = $question[0];
            $wrongs = explode(',' , $question['wrong_answer_'. $language]);
            if (isset($ajax['end_game'])){
                mysqli_query($this->game->conn, "DELETE FROM `user_game_session` WHERE `user_id` = '$userId'");
                mysqli_query($this->game->conn, "DELETE FROM `bonuses` WHERE `user_id` = '$userId'");
                if ($game_session['level'] === 1){
                    $ajax['end'] = false;
                    echo json_encode($ajax);
                }else{
                    $previous_level = $NowLevel - 1;
                    foreach ($levels->fetch_all(true) as $element) {
                        if ($element['id'] === $previous_level) {
                            $foundElement = $element;
                            break;
                        }
                    }
                    foreach ($levels as $item => $val){
                        if ($val['id'] == $previous_level){
                            $found = $val;
                        }
                    }
                    $prize = $found['price'];
                    $login = $profile['login'];


                    mysqli_query($this->game->conn, "INSERT INTO `gamers` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$login', '$previous_level', $prize, 'waiting', 0)");

                    $ajax['end'] = true;
                    $ajax['prize'] = true;
                    echo json_encode($ajax);
                }
            }

            elseif (isset($ajax['bonus'])){
                $this->bonus($ajax['bonus'], $question['right_answer_' . $language], $wrongs, $language);
            }else{

                if ($question['right_answer_' . $language] == $ajax['question_ans']){
                    // check is user answer right
                    $NowLevel += 1;
                    mysqli_query($this->game->conn, "UPDATE `user_game_session` SET `level` = '$NowLevel' WHERE `user_id` = $userId");
                    $ajax['status'] = true;

                    echo json_encode($ajax);

                }
                // false answer check if user answer the special answer
                else{
                    // if user answer false
                    $player = $profile['login'];
                    $specials = [];
                    foreach ($levels as $item => $val){
                        if ($val['special'] == 1){
                            array_push($specials, $val);
                        }
                    }
                    $activeSpecials = [];
                    foreach ($specials as $item => $val){
                        if ($game_session['level'] > $val['name']){
                            array_push($activeSpecials, $val['name']);
                        }
                    }
                    if ($activeSpecials !== []){

                        foreach ($specials as $element) {
                            if ($element['id'] === end($activeSpecials)) {
                                $foundElement = $element;
                                break;
                            }
                        }
                        $prize = $foundElement['price'];
                        mysqli_query($this->game->conn, "INSERT INTO `gamers` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$player', '$NowLevel', $prize, 'waiting', 0)");

                        $ajax['status'] = false;
                        $ajax['prize'] = true;
                        $ajax['prize_count'] = $prize;
                        $ajax['right'] = $question['right_answer_' . $language];
                        echo json_encode($ajax);
                        mysqli_query($this->game->conn, "DELETE FROM `user_game_session` WHERE `user_id` = '$userId'");
                    }else {
                        $ajax['status'] = false;
                        $ajax['prize'] = false;
                        $ajax['right'] = $question['right_answer_' . $language];
                        echo json_encode($ajax);
                        mysqli_query($this->game->conn, "DELETE FROM `user_game_session` WHERE `user_id` = '$userId'");
                    }
                }
            }

        }
        // GET request
        else{

                if ($game_session['level'] > 15){
                    echo json_encode('you win, your prize is 1000000');
                    mysqli_query($this->game->conn, "INSERT INTO `gamers` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$login', 30, 100000 , 'waiting', 0)");
                }else{


                    $NowLevel = $game_session['level'];

                    $allQuestions = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `level` = $NowLevel")->fetch_all(true);

                    $question = $allQuestions[array_rand($allQuestions)];
                    $question_id = $question['id'];
                    mysqli_query($this->game->conn, "UPDATE `user_game_session` SET `question_id` = '$question_id' WHERE `user_id` = $userId");
                    $wrongs = explode(',' , $question['wrong_answer_' . $language]);
                    $nextLvl = $NowLevel + 1;



                    $previous_level = $NowLevel - 2;

                    if ($NowLevel -1 == 0){
                        $NextPrize = $level_price[$NowLevel - 1]['price'];
                        $ajax['now_fond'] = 0;
                        $ajax['next_fond'] = $NextPrize;
                    }else{
                        $NowPrize = $level_price[$previous_level]['price'];
                        $NextPrize = $level_price[$NowLevel - 1]['price'];
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

    public function bonus($bonus_name, $true, $false, $language){

        $login = $this->getLogin();
        $userId = mysqli_query($this->game->conn, "SELECT * FROM `users` where `login` = '$login'");
        if ($userId){
            $userId = ($userId->fetch_assoc())['id'];
        }
        $bonuses = mysqli_query($this->game->conn, "SELECT * FROM `bonuses` WHERE `user_id` = $userId")->fetch_assoc();

        if ($language == 'en'){
            if ($bonuses[$bonus_name] == 0) {
                if ($bonus_name == 'call_friend') {
                    $rand = rand(1, 4);
                    $err = 'Hi ' . $login . ', i think it is "' . $true . '"';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `call_friend`= 1 WHERE `user_id` = $userId");
                } elseif ($bonus_name == 'fifty_fifty') {
                    $randfalse = rand(0,2);
                    $err = 'It is or "' . $true . '" or "' . $false[$randfalse] . '"';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `fifty_fifty`= 1 WHERE `user_id` = $userId");
                } elseif ($bonus_name == 'ask_audience') {
                    $prcnt = rand(50, 100); //  get random number
                    $err = $prcnt .' percent of coward voice think that it is "'. $true . '"';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `ask_audience`= 1 WHERE `user_id` = $userId");
                }
            }else{
                $err = 'You cannot use the same bonus twice';
                    echo json_encode($err);
            }
        }elseif ($language == 'hy'){
            if ($bonuses[$bonus_name] == 0) {
                if ($bonus_name == 'call_friend') {
                    $rand = rand(1, 4);
                    $err = 'Բարև ' . $login . ', ես կարծում եմ դա "' . $true . '"-ն է';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `call_friend`= 1 WHERE `user_id` = $userId");
                } elseif ($bonus_name == 'fifty_fifty') {
                    $randfalse = rand(0,2);
                    $err = 'Դա կամ "' . $true . '"-ն է կամ էլ "' . $false[$randfalse] . '"-ը';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `fifty_fifty`= 1 WHERE `user_id` = $userId");
                } elseif ($bonus_name == 'ask_audience') {
                    $prcnt = rand(50, 100); //  get random number
                    $err = 'Դայլիճի ձայնի  ' . $prcnt .' տոկոսը կարծում է որ դա "'. $true . '"-ն է';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `ask_audience`= 1 WHERE `user_id` = $userId");
                }
            }else{
                $err = 'Դուք չեք կարող օգտագործել նույն բոնուսը երկու անգամ';
                echo json_encode($err);
            }
        }


    }

    public function checkplay($language)
    {
        $login = $this->getLogin();
        $userId = (mysqli_query($this->game->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc())['id'];
        $game_session = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId ");
        if ($game_session){
            $game_session = $game_session->fetch_assoc();
        }
        if ($game_session['active'] == 1){

            header('location: /'. $language .'/play');

        }
    }

    public function checkLogin($lang){
        if (isset($_SESSION['admin_profile']['profile']) || isset($_SESSION['user_profile']['profile'])) {

        }else{
            header("location: /$lang/login");
        }

    }

    private function getLogin(){
        if ($_SESSION['user_profile'] == ''){
            return $_SESSION['admin_profile']['login'];
        }
        return $_SESSION['user_profile']['login'];
    }

}
