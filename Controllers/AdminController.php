<?php

class AdminController
{

    public $admin;
    public $front = [
        'front' => [],
        'header' => [],
        'datatable' => []
    ];

    public function __construct($settings)
    {
        $this->admin = model('Admin', $settings);
        $url = substr($_GET['urlLanguage'], 3);
        if (!$url) {
            $url = substr($_GET['url'], 3);
        }
        // $arr is front data from datatable
        try {
            $arr = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' OR `url` = 'admin_header' OR `url` = 'datatable'");
            if (!$arr){
                throw new Exception('something goes wrong, wait or refresh the page');
            }
            $arr = $arr->fetch_all(true);
        }catch (Exception $e) {
            dd($e->getMessage());
        }
        foreach ($arr as $item => $key) { // foreach front content and add to controller variable
            switch ($key['url']) {
                case $url:
                    array_push($this->front['front'], $key);
                    break;
                case 'admin_header':
                    array_push($this->front['header'], $key);
                    break;
                case 'datatable':
                    array_push($this->front['datatable'], $key);
                    break;
                default:
            }
        }
    }

    public function index() // homepage
    {

        $language = getLanguage(); // get language
        $this->checkLogin($language); // check user login
        $allGames = mysqli_query($this->admin->conn, "SELECT * FROM `games`"); // Query to get all games

        $arr = $allGames->fetch_all(true); // Fetch all rows from the query result as an associative array
        $upToFive = 0; // Counter variable to count the number of games with level >= 5
        foreach ($arr as $item => $key)
        { //
            if ($key['level'] >= 5) { // Check if the game's level is greater than or equal to 5
                $upToFive += 1; // get
            }
        }
        try {
            $allGames = mysqli_num_rows($allGames); // Get the total number of games
            $top_games = mysqli_query($this->admin->conn, "SELECT * FROM `games` ORDER BY `prize` DESC LIMIT 5;"); // get top games based on the prize, in
            if (!$top_games){
                throw new Exception('something goes wrong');
            }elseif (!$allGames){
                throw new Exception('something goes wrong');
            }
        }catch (Exception $e){
            dd($e->getMessage());
        }

        $top_gamers = $top_games->fetch_all(true);


        // Pass the data to the view
        view(
            "dashboard", // View name
            'Admin', // View context
            [
                'top_games' => $top_games, // Top 5 games
                'ipToFive' => $upToFive, // Count of games with level >= 5
                'allGames' => $allGames, // Total number of games
                'Admin' => $_SESSION['admin_profile'], // Admin profile data
                'front' => $this->front, // Front data
                'language' => $language, // Language data
            ],
            "Admin" // Layout name
        );

    }

    public function questions()
    {
        $language = getLanguage(); // get language
        $this->checkLogin($language); // check user login


        view("questions", 'Admin', [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'front' => $this->front
        ], "Admin");
    }

    public function users()
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login

        view("users", 'Admin', [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'front' => $this->front,
        ], "Admin");
    }

    public function games()
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login

        view("games", 'Admin', [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'front' => $this->front
        ], "Admin");
    }

    public function gamesPagination()
    {

        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login

        $this->pagination('games');

    }

    public function usersPagination()
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login

        $this->pagination('users');
    }

    public function questionPagination()
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login

        $this->pagination('questions');
    }

    public function createQuestion()
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login

        $this->checkLogin();
        view("create_question", 'Admin', [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'front' => $this->front
        ], "Admin");
    }

    public function editQuestion($id)
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login
        if (!is_numeric($id['id'])) { // get id from url
            header('location: /');
        }

        $id = $id['id'];
        if (is_numeric($id)) {
            try { // check error
                $question = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE `id` = $id");
                $levels = mysqli_query($this->admin->conn, "SELECT * FROM `levels`")->num_rows;
                if (!$question || !$levels){
                    throw new Exception('Something goes wrong');
                }
                $question = $question->fetch_all(true);
            }catch (Exception $e){
                dd($e->getMessage());
            }
            if ($question) {
                view('edit_question', 'Admin', [
                    'question' => $question,
                    'levels' => $levels,
                    'language' => $language,
                    'front' => $this->front
                ], 'Admin');
            }
        } else {
            header("Location: /error404");
        }
    }

    public function addUser()
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login


        view("add_user", 'Admin', [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'front' => $this->front
        ], "Admin");
    }

    public function editUser($id)
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login
        $id = $id['id'];

        try {
            $user = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `id` = $id"); // get user data
            if (!$user){
                throw new Exception('Something goes wrong');
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
        $user = $user->fetch_all(true);
        if ($user) {
            view('edit_user', 'Admin', [
                'user' => $user,
                'language' => $language,
                'front' => $this->front
            ], 'Admin');
        } else {
            header('Location: /error404');
        }
    }


    public function documentation()
    {
        $language = getLanguage();// get language
        $this->checkLogin($language);// check user login

        view("documentation", 'Admin', [
            'language' => $language,
            'front' => $this->front,
        ], "Admin");
    }

    // private functions for this controller
    private function pagination($tableName)
    {
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = strtolower($_POST['search']['value']); // Search value

        if ($searchValue != '') { // check search value and create variable for search query
            $searchQuery = "AND ";
            foreach ($_POST['columns'] as $column) {
                $data = $column['data'];
                if ($data !== '') {
                    $searchQuery .= "$data LIKE '%" . $searchValue . "%' OR ";
                }
            }
            $searchQuery = substr($searchQuery, 0, -3);
        }
        // Total number of records with filtering
        try {
            $query = mysqli_query($this->admin->conn, "SELECT COUNT(*) FROM `$tableName` WHERE 1 " . $searchQuery);
            if (!$query) {
                throw new Exception('Error');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        if ($query->num_rows) {// fetch assoc if query find anything
            $rows = $query->fetch_assoc();
        }
        $totalRows = $rows['COUNT(*)']; // get total row count
        $query = mysqli_query(
            $this->admin->conn,
            "SELECT * FROM `$tableName` 
                  WHERE 1 " . $searchQuery . "
                  ORDER BY " . $columnName . " " . $columnSortOrder . " 
                  LIMIT $row, $rowperpage");

        try {
            if (!$query) {
                throw new Exception('Error');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRows,
            "iTotalDisplayRecords" => $totalRows,
            "data" => $query->fetch_all(true)
        );
        echo json_encode($response);
        return true;
    }

    // Requests

    public function requestLogout()
    {
        if ($this->checkLogin()){
            return;
        }elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->checkLogin();
            session_destroy(); // delete all sessions
        } else {
            header("location: /admin/home");
        }
    }

    public function requestAddUserRequest()
    {

        if ($this->checkLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // get data from $_post and create variables
            $login = $_POST['login'];
            $pass = $_POST['password'];
            $name = $_POST['name'];
            $sname = $_POST['sname'];
            $age = $_POST['age'];
            $role = $_POST['role'];
            $balance = $_POST['balance'];
            switch (true) { // check and find errors
                case (strlen($name) < 3 || $name == ''):
                    $ajax['error1'] = false;
                    echo json_encode($ajax);
                    break;
                case (strlen($sname) < 3 || $sname == ''):
                    $ajax['error2'] = false;
                    echo json_encode($ajax);
                    break;
                case ($balance == ''):
                    $ajax['error3'] = false;
                    echo json_encode($ajax);
                    break;
                case ($age < 18 || $age >= 100 || $age == ''):
                    $ajax['error4'] = false;
                    echo json_encode($ajax);
                    break;
                case (strlen($login) < 4 || $login == ''):
                    $ajax['error5'] = false;
                    echo json_encode($ajax);
                    break;
                case (strlen($pass) < 4 || $pass == ''):
                    $ajax['error6'] = false;
                    echo json_encode($ajax);
                    break;
                case ($role == '' || $role == ''):
                    $ajax['error7'] = false;
                    echo json_encode($ajax);
                    break;

                default:
                    $profile = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `login` = '$login'");
                    // get user from users table
                    try {
                        if (!$profile){
                            throw new Exception('something goes wrong');
                        }
                        $profile = mysqli_num_rows($profile);
                    }catch (Exception $e){
                        dd($e->getMessage());
                    }
                    if ($profile == 1) {
                        $ajax['success'] = false;
                        echo json_encode($ajax);
                    } else {
                        $pass = md5($pass);
                        $query = mysqli_query($this->admin->conn, "INSERT INTO `users`( `login`, `password`, `name`, `sname`, `age`, `balance`, `Role`) VALUES ( '$login', '$pass', '$name', '$sname', $age, $balance, '$role' ) ");
                        // create new user
                        try {
                            if (!$query){
                                throw new Exception('something goes wrong');
                            }
                        }catch (Exception $e){
                            dd($e->getMessage());
                        }
                        $ajax['success'] = true;
                        echo json_encode($ajax);
                    }
            }

        }
        else{
            error404();
        }
    }

    public function requestDeleteUser($user)
    {
        if ($this->checkLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $user['id'];// get user id from url
            if (is_numeric($id)) {
                $result = mysqli_query($this->admin->conn, "DELETE FROM `games` WHERE `id` = $id"); // delete user
                try {
                    if (!$result){
                        throw new Exception('something goes wrong');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }
            }
        } else {
            error404();
        }
    }

    public function requestQuestionEdit($id)
    {

        if ($this->checkLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $id['id'];
            $act = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE `id` = $id");
            // get question from table by id
            try {
                if (!$act){
                    throw new Exception('something goes wrong');
                }
            }catch (Exception $e){
                dd($e->getMessage());
            }
            if ($act->num_rows == 0) { // if question dose not exist
                error404();
            }
            $oldQuestion = $act->fetch_assoc();
            if ($_POST) { // if $_POST not null
                foreach ($_POST as $item => $key) { // foreach and create variables from array
                    $$item = $key;
                }

                $oldLevel = $oldQuestion['level'];
                $actives = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE active = 1 AND `level` = $oldLevel");// get questions
                try {
                    if (!$actives){
                        throw new Exception('something goes wrong');
                    }
                    $actives = $actives->num_rows;
                }catch (Exception $e){
                    dd($e->getMessage());
                }


                if ($level !== $oldQuestion['level']) { // check is level changed
                    if ($active == 1) {
                        $ajax['success'] = 'error4';
                        echo json_encode($ajax);
                        return false;
                    }
                } elseif ($oldQuestion['active'] !== $active) {
                    if ($actives <= 1) {
                        if ($active == 0) {
                            $ajax['success'] = 'error1';
                            echo json_encode($ajax);
                            return false;
                        }
                    }
                }

            }

            // annex wrong answers
            $wrongs_en = "$wrong_answer_1_en" . ',' . "$wrong_answer_2_en" . ',' . "$wrong_answer_3_en";
            $wrongs_hy = "$wrong_answer_1_hy" . ',' . "$wrong_answer_2_hy" . ',' . "$wrong_answer_3_hy";

            if (!array_search('', $_POST)) {
                // update question
                $query = mysqli_query($this->admin->conn, "UPDATE `questions` SET 
                       `hy`='$question_hy',
                       `right_answer_hy`='$right_answer_hy',
                       `wrong_answer_hy`='$wrongs_hy',
                       `difficulty`='$difficulty',
                       `active`='$active',
                       `en`='$question_en',
                       `right_answer_en`='$right_answer_en',
                       `wrong_answer_en`='$wrongs_en' 
                   WHERE `id` = $id");
                try {
                    if (!$query){
                        throw new Exception('something goes wrong');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }

                $ajax['success'] = 'success'; // send success to front
                echo json_encode($ajax);
                return false;
            } else {

                $ajax['success'] = 'error2'; // send error to front
                echo json_encode($ajax);
                return false;

            }
        }else{
            error404();
        }
    }

    public function requestUserEdit($id)
    {

        if ($this->checkLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // is request post

            if ($_POST) {
                $id = $id['id'];
                $name = $_POST['name'];
                $sname = $_POST['sname'];
                $age = $_POST['age'];
                $balance = $_POST['balance'];
                $role = $_POST['role'];
                $actives = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE $id = 1");
                $actives = mysqli_num_rows($actives);
            }// get $_POST data and create variable

            try {
                $admins = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `Role` = 'Admin'");
                $user = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `id` = '$id'")->fetch_all(true); // get user
                if (!$admins || !$user){
                    throw new Exception('something goes wrong');
                }
                $admins = mysqli_num_rows($admins);
            }catch (Exception $e){
                dd($e->getMessage());
            }
            // find empty imput and send errors
            if ($user[0]['login'] == $_SESSION['admin_profile']['login']) {
                $ajax['success'] = 'error1';
                echo json_encode($ajax);
                return false;
            } elseif ($admins <= 1 && $role = 'User') {
                $ajax['success'] = 'error2';
                echo json_encode($ajax);
                return false;
            } elseif ($age < 18 || $age > 105) {
                $ajax['success'] = 'error3';
                echo json_encode($ajax);
                return false;
            } elseif (!array_search('', $_POST)) {

                $query = mysqli_query($this->admin->conn, "UPDATE `users` SET `name`= '$name', `sname`= '$sname',  `age`= '$age', `balance`= '$balance', `Role` = '$role' WHERE `id` = $id;");
                // update user data
                try {
                    if (!$query){
                        throw new Exception('something goes wrong');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }
                $ajax['success'] = true; // send success to front
                echo json_encode($ajax);
                return true;
            } else {
                $ajax['success'] = 'error4'; // send error to front

                echo json_encode($ajax);
                return false;
            }
        } else {
            error404();
        }
    }

    public function requestQuestionCreate()
    {

        if ($this->checkLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST) {

                // get All data from post and create variables
                $question_hy = $_POST['question_hy'];
                $question_en = $_POST['question_en'];
                $wrong_answer_1_en = $_POST['wrong_answer_1_en'];
                $wrong_answer_2_en = $_POST['wrong_answer_2_en'];
                $wrong_answer_3_en = $_POST['wrong_answer_3_en'];
                $wrong_answer_1_hy = $_POST['wrong_answer_1_hy'];
                $wrong_answer_2_hy = $_POST['wrong_answer_2_hy'];
                $wrong_answer_3_hy = $_POST['wrong_answer_3_hy'];
                $right_answer_hy = $_POST['right_answer_hy'];
                $right_answer_en = $_POST['right_answer_en'];
                $diff = $_POST['difficulty'];
                $active = $_POST['Active'];
                $level = $_POST['level'];

                switch (true) { // find error and send to front
                    case ($question_hy == ''):
                        $ajax['error1'] = true;
                        echo json_encode($ajax);
                        break;
                    case ($question_en == ''):
                        $ajax['error2'] = true;
                        echo json_encode($ajax);
                        break;
                    case ($wrong_answer_1_en == '' || $wrong_answer_2_en == '' || $wrong_answer_3_en == '' ):
                        $ajax['error3'] = true;
                        echo json_encode($ajax);
                        break;
                    case ($wrong_answer_1_hy == '' || $wrong_answer_2_hy == '' || $wrong_answer_3_hy == ''):
                        $ajax['error4'] = true;
                        echo json_encode($ajax);
                        break;
                    case ($right_answer_hy == '' || $right_answer_en == ''):
                        $ajax['error5'] = true;
                        echo json_encode($ajax);
                        break;

                    case ($level >= 15):
                        $ajax['error7'] = true;
                        echo json_encode($ajax);
                        break;
                }
                try {
                    $actives = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE active = 1");
                    if (!$actives){
                        throw new Exception('something goes wrong');
                        $actives = mysqli_num_rows($actives);
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }

                // annex wrong answers
                $wrongs_en = "$wrong_answer_1_en" . ',' . "$wrong_answer_2_en" . ',' . "$wrong_answer_3_en";
                $wrongs_hy = "$wrong_answer_1_hy" . ',' . "$wrong_answer_2_hy" . ',' . "$wrong_answer_3_hy";

                if (!array_search('', $_POST)) {

                    try {
                        $query = mysqli_query($this->admin->conn, "INSERT INTO `questions`(`hy`, `right_answer_hy`, `wrong_answer_hy`, `difficulty`, `active`, `en`, `right_answer_en`, `wrong_answer_en`, `level`) 
                        VALUES (
                            '$question_hy',
                                '$right_answer_hy',
                                '$wrongs_hy',
                                '$diff',
                                '$active',
                                '$question_en',
                                '$right_answer_en',
                                '$wrongs_en',
                                '$level')");
                        if (!$query){
                            throw new Exception('something goes wrong');
                        }
                    }catch (Exception $e){
                        dd($e->getMessage());
                    }
                    $ajax['success'] = true; // send success to front
                    echo json_encode($ajax);
                } else {
                    return false;
                }
            }
        } else {
            error404();
        }
    }

    public function requestChangeGameStatus($id)
    {
        if ($this->checkLogin()) {// check login
            return;
        }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $id['id'];
            if (is_numeric($id)) {

                try {
                    $question = mysqli_query($this->admin->conn, "SELECT * FROM `games` WHERE `id` = $id")->fetch_all(true);
                    //        $question = mysqli_num_rows($question);
                    $status = $_POST['value'];
                    if (!$question){
                        throw new Exception('something goes wrong');
                    }
                }catch (Exception $e){
                    dd($e->getMessage());
                }
                if ($question) {
                    try {
                        $query = mysqli_query($this->admin->conn, "Update `games` SET `status` = '$status' WHERE `id` = $id"); // update game status by id
                        if (!$query){
                            throw new Exception('something goes wrong');
                        }
                    }catch (Exception $e){
                        dd($e->getMessage());
                    }
                }
            } else {
                error404();
            }
        }
    }

    public function checkLogin($lang = 'en')
    {
        if (isset($_SESSION['admin_profile'])) // is admin logged in
        {
            return false;
        } else {
            header("location: /$lang/home");
            return true;
        }
    }

}