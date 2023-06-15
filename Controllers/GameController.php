<?php



class GameController{

    public $game;
    public $front = [
        'front' => [],
        'header' => [],
        'datatable' => []
    ];
    public $login;
    public $userId;

    public function __construct($settings)
    {
        $this->getLogin();
        $this->game = model('Game', $settings); // connect game model to controller
        $url = substr($_GET['urlLanguage'], 3); // get url if url has {}
        if (!$url) {
            $url = substr($_GET['url'], 3);
        }

        try {
            $front = mysqli_query($this->game->conn, "SELECT * FROM `languages` WHERE url = '$url' OR `url` = 'header' OR `url` = 'datatable'");
            if (!$front){
                throw new Exception('error');
            }
            $front->fetch_all(true);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }

        foreach ($front as $item => $key) { // foreach and add language to controller front variable
            switch ($key['url']) {
                case $url:
                    array_push($this->front['front'], $key);
                    break;
                case 'header':
                    array_push($this->front['header'], $key);
                    break;
                case 'datatable':
                    array_push($this->front['datatable'], $key);
                    break;
                default:
            }
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

        view("Play", null, [
            'front' => $this->front,
            'language' => $language,
        ], 'Game');

    }

    public function createGame()
    {
        // get language
        $language = getLanguage();
        $this->checkLogin($language);
        $this->checkplay($language);
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // check is request post
            $random = time() . chr(rand(65, 90));// create random id for session in database
            $checkRandom = 1;
            while (isset($checkRandom)){ // check random id exist
                try {
                    $checkRandom = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `game_id` = '$random'");
                    if (!$checkRandom){
                        throw New Exception('error');
                    }
                    $checkRandom = $checkRandom->fetch_assoc();
                }catch (Exception $e){
                    dd($e->getMessage());
                }
                $random = time() . chr(rand(65, 90));
            }
            $time = date('Y/m/d h:i:s'); // get time
            try {
                if (!mysqli_query($this->game->conn, "INSERT INTO `user_game_session` (`user_id`, `game_id`, `active`, `level`, `created_at`) VALUES ($this->userId, '$random', 1, 1, '$time')")){
                    throw new Exception('something goes wrong');
                }elseif (!mysqli_query($this->game->conn, "INSERT INTO `bonuses`( `active`, `fifty_fifty`, `call_friend`, `ask_audience`, `user_id`) VALUES (1,0,0,0,$this->userId)")){
                    throw new Exception('something goes wrong');
                }
            }catch (Exception $e){
                dd($e->getMessage());
            }
            header('location: /'. $language .'/play'); // go to game page

        }else{
            error404();
        }
    }

    public function game(){

        $language = getLanguage(); // get language
        $this->checkLogin($language); // check login
        $this->checkplay($language, 1);

        // Render the game page with the retrieved data
        view('index', 'Game', ['front' => $this->front,'language' => $language], 'Play');

    }

    public function gameBackend()
    {
        $language = getLanguage(); // get language
        $this->checkLogin($language);

        try {
            $gameSession = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `user_id` = $this->userId ");

            $levels = mysqli_query($this->game->conn, "SELECT * FROM `levels`"); // get levels
            if (!$levels){
                throw new Exception('1');
            }elseif (!$gameSession){
                throw new Exception('err');
            }
            $gameSession = $gameSession->fetch_assoc();
            if ($gameSession['active'] == 0){
                header("Location: /$language/home");
            }
            $levelPrice = $levels->fetch_all(true); // get now level price
            $levels_conut = $levels->num_rows;

        }catch (Exception $e){

            dd($e->getMessage());
        }




        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $ajax = $_POST;


            $nowLevel = $gameSession['level']; // get now level
            $id = $gameSession['question_id']; // get game session
            try {
                $question = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `id` = $id");
                if (!$question){
                    throw new Exception('4');
                }
                $question = $question->fetch_all(true);
            }catch (Exception $e){
                dd($e->getMessage());
            }
            $question = $question[0];
            $wrongs = explode(',' , $question['wrong_answer_'. $language]); // cut wrong answers
            if (isset($ajax['end_game'])){ // if user want to end the game
                try {
                    $query1 = mysqli_query($this->game->conn, "DELETE FROM `user_game_session` WHERE `user_id` = '$this->userId'");
                    $query2 = mysqli_query($this->game->conn, "DELETE FROM `bonuses` WHERE `user_id` = '$this->userId'");
                    if (!$query1){
                        throw new Exception('5');
                    }elseif (!$query2){
                        throw new Exception('6');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }
                if ($gameSession['level'] === 1){ // if user in first level
                    $ajax['end'] = false;
                    echo json_encode($ajax);
                }else{
                    $previousLevel = $nowLevel - 1;

                    foreach ($levels as $item => $val){ // foreach and find prize
                        if ($val['id'] == $previousLevel){
                            $found = $val;
                        }
                    }
                    $prize = $found['price'];

                    // create game
                    try {
                        // insert game and check for errors
                        if (!mysqli_query($this->game->conn, "INSERT INTO `games` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$this->login', '$previousLevel', $prize, 'waiting', 0)")){
                            throw new Exception('err');
                        }
                    }catch (Exception $e){

                        dd($e->getMessage());
                    }

                    $ajax['end'] = true;
                    $ajax['prize'] = true;
                    echo json_encode($ajax);
                }
            }

            elseif (isset($ajax['bonus'])){ // if user want bonus
                $this->bonus($ajax['bonus'], $question['right_answer_' . $language], $wrongs, $language); // call bonus function
            }else{// if user want to answer

                if ($question['right_answer_' . $language] == $ajax['question_ans']){// if user answer right

                    $nowLevel += 1;
                    try {
                        if (!mysqli_query($this->game->conn, "UPDATE `user_game_session` SET `level` = '$nowLevel' WHERE `user_id` = $this->userId")) // update session level)
                        {
                            throw new Exception('15');
                        }
                    }catch (Exception $e){
                        dd($e->getMessage());
                    }

                    $ajax['status'] = true;

                    echo json_encode($ajax);

                }
                else{
                    // if user answer false
                    $specials = [];
                    foreach ($levels as $item => $val){ // chek user answer special or no
                        if ($val['special'] == 1){
                            array_push($specials, $val);
                        }
                    }
                    $activeSpecials = [];
                    foreach ($specials as $item => $val){ // add to special array
                        if ($gameSession['level'] > $val['name']){
                            array_push($activeSpecials, $val['name']);
                        }
                    }
                    if ($activeSpecials !== []){ // is not special

                        foreach ($specials as $element) { // add special question price
                            if ($element['id'] === end($activeSpecials)) {
                                $foundElement = $element;
                                break;
                            }
                        }
                        $prize = $foundElement['price']; // get prize to variable
                        try {
                            if (!mysqli_query($this->game->conn, "INSERT INTO `games` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$this->login', '$nowLevel', $prize, 'waiting', 0)")) // update session level)
                            {
                                throw new Exception('7');
                            }
                        }catch (Exception $e){
                            dd($e->getMessage());
                        }

                        $ajax['status'] = false;
                        $ajax['prize'] = true;
                        $ajax['prize_count'] = $prize;
                        $ajax['right'] = $question['right_answer_' . $language];
                        echo json_encode($ajax); // create array and send to front

                        try {
                            if (!mysqli_query($this->game->conn, "DELETE FROM `user_game_session` WHERE `user_id` = '$this->userId'")) // update session level)
                            {
                                throw new Exception('8');
                            }
                        }catch (Exception $e){
                            dd($e->getMessage());
                        }
                    }else {
                        $ajax['status'] = false;
                        $ajax['prize'] = false;
                        $ajax['right'] = $question['right_answer_' . $language];
                        echo json_encode($ajax);// create array and send to front
                        try {
                            if (!mysqli_query($this->game->conn, "DELETE FROM `user_game_session` WHERE `user_id` = '$this->userId'")) // update session level)
                            {
                                throw new Exception('');
                            }
                        }catch (Exception $e){
                            dd($e->getMessage());
                        }
                    }
                }
            }

        }
        // GET request
        else{
            if ($gameSession['level'] > 15){
                echo json_encode('you win, your prize is' . $levelPrice); // if user win the game

                try { // insert into game and check for errors
                    if (!mysqli_query($this->game->conn, "INSERT INTO `games` (`name`, `level`, `prize`, `status`, `getted`) VALUES ('$this->login', 30, $levelPrice , 'waiting', 0)")){
                        throw new Exception('5');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }
            }else{


                $nowLevel = $gameSession['level'];


                try {
                    $allQuestions = mysqli_query($this->game->conn, "SELECT * FROM `questions` WHERE `level` = $nowLevel"); // get all questions and fetch

                    $allQuestions = $allQuestions->fetch_all(true);
                    $question = $allQuestions[array_rand($allQuestions)];
                    $questionId = $question['id'];
                    if (!$allQuestions){
                        throw new Exception('5');
                    }elseif (!mysqli_query($this->game->conn, "UPDATE `user_game_session` SET `question_id` = '$questionId' WHERE `user_id` = $this->userId")){
                        throw new Exception('6');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }
                $wrongs = explode(',' , $question['wrong_answer_' . $language]);
                $nextLvl = $nowLevel + 1; // create next lvl number variable



                $previousLevel = $nowLevel - 2;

                if ($nowLevel -1 == 0){ // if level 0 price is 0
                    $NextPrize = $levelPrice[$nowLevel - 1]['price'];
                    $ajax['now_fond'] = 0;
                    $ajax['next_fond'] = $NextPrize;
                }else{ // create variable and assign prize price by lvl
                    $NowPrize = $levelPrice[$previousLevel]['price'];
                    $NextPrize = $levelPrice[$nowLevel - 1]['price'];
                    $ajax['now_fond'] = $NowPrize;
                    $ajax['next_fond'] = $NextPrize;
                }

                $questionData = [
                    'wrongs' => $wrongs, 'question' => $question['right_answer_' . $language] // create array and add to array wrong and right answers
                ];
                $data = [ // create arr and add question name, data and fond
                    'question_name' => $question[$language],
                    'question_data' => $questionData,
                    'fond' => $ajax
                ];
                render($data, 'Questions'); // send all data to render question for front
            }
        }
    }

    public function bonus($bonusName, $true, $false, $language){ // bonus function

        try {

            $bonuses = mysqli_query($this->game->conn, "SELECT * FROM `bonuses` WHERE `user_id` = $this->userId")->fetch_assoc();
            if (!$bonuses){
                throw new Exception('6');
            }
        }catch (Exception $e){
            dd($e->getMessage());
        }

        if ($language == 'en'){
            if ($bonuses[$bonusName] == 0) {
                switch ($bonusName) {
                    case 'call_friend':
                        $rand = rand(1, 4);// get random number
                        $err = 'Hi ' . $this->login . ', i think it is "' . $true . '"'; // create bonus response
                        echo json_encode($err);
                        break;
                    case 'fifty_fifty':
                        $randfalse = rand(0,2);// get random number
                        $err = 'It is or "' . $true . '" or "' . $false[$randfalse] . '"';// create bonus response
                        echo json_encode($err);
                        break;
                    case 'ask_audience':
                        $prcnt = rand(50, 100); // get random number
                        $err = $prcnt .' percent of coward voice think that it is "'. $true . '"';// create bonus response
                        echo json_encode($err);
                }

                try {
                    if (!mysqli_query($this->game->conn, "UPDATE `bonuses` SET `call_friend`= 1 WHERE `user_id` = $this->userId"))// update bonus status
                    {
                        throw new Exception('err');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }
            }else{
                $err = 'You cannot use the same bonus twice';
                    echo json_encode($err);
            }
        }elseif ($language == 'hy'){
            if ($bonuses[$bonusName] == 0) {
                if ($bonusName == 'call_friend') {
                    $rand = rand(1, 4);
                    $err = 'Բարև ' . $this->login . ', ես կարծում եմ դա "' . $true . '"-ն է';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `call_friend`= 1 WHERE `user_id` = $this->userId");
                } elseif ($bonusName == 'fifty_fifty') {
                    $randfalse = rand(0,2);
                    $err = 'Դա կամ "' . $true . '"-ն է կամ էլ "' . $false[$randfalse] . '"-ը';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `fifty_fifty`= 1 WHERE `user_id` = $this->userId");
                } elseif ($bonusName == 'ask_audience') {
                    $prcnt = rand(50, 100); //  get random number
                    $err = 'Դայլիճի ձայնի  ' . $prcnt .' տոկոսը կարծում է որ դա "'. $true . '"-ն է';
                    echo json_encode($err);
                    mysqli_query($this->game->conn, "UPDATE `bonuses` SET `ask_audience`= 1 WHERE `user_id` = $this->userId");
                }
            }else{
                $err = 'Դուք չեք կարող օգտագործել նույն բոնուսը երկու անգամ';
                echo json_encode($err);
            }
        }


    }

    public function checkplay($language, $redirect = null)
    {
        try { // get game session and check query for errors
            $gameSession = mysqli_query($this->game->conn, "SELECT * FROM `user_game_session` where `user_id` = $this->userId ");

            if (!$gameSession){
                throw new Exception('err');
            }
            $gameSession = $gameSession->fetch_assoc();
        }catch (Exception $e){
            dd($e->getMessage());
        }
        if ($redirect !== null){ // redirect if game session active is 0
            if ($gameSession['active'] == 0){
                header("location: /$language/home");
            }
        }else{
            if ($gameSession['active'] == 1){
                header("location: /$language/home");
            }
        }
        return $gameSession['active']; // return active

    }

    public function checkLogin($lang){
        if (isset($_SESSION['admin_profile']['profile']) || isset($_SESSION['user_profile']['profile'])) {

        }else{
            header("location: /$lang/login");
        }

    }

    private function getLogin(){
        if ($_SESSION['user_profile']){
            $this->login = $_SESSION['user_profile']['login'];
            $this->userId = $_SESSION['user_profile']['profile'];
        }elseif ($_SESSION['admin_profile']['login']){

            $this->login = $_SESSION['admin_profile']['login'];
            $this->userId = $_SESSION['admin_profile']['profile'];
        }else{
            return false;
        }
    }

}
