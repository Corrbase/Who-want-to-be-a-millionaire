<?php

class UserController{
    public $user;
    public $front = [
        'front' => [],
        'header' => [],
        'datatable' => []
    ];
    public $login;

    public function __construct($settings)
    {
        $this->user = model('User', $settings); // connect model to user controller
        $url = substr($_GET['urlLanguage'], 3); // get front url if request to {} url
        if (!$url) { // check if url empty
            $url = substr($_GET['url'], 3); // cut language from url
        }
        $this->getLogin(); // get login and add to controller login variable
        $arr = mysqli_query($this->user->conn, "SELECT * FROM `languages`  WHERE url = '$url' OR `url` = 'header' OR `url` = 'datatable'"); // get front
        try {
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

    public function profile(){
        $language = getLanguage(); // get langauge
        $this->checkPlay(); // check if user in game
        $this->checkAdminLogin($language ); //  check if admin is logged

        view("profile", null, [
            'front' => $this->front,
            'language' => $language,
        ], 'UserPages');

    }

    // requests

    public function logoutUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_destroy(); // delete all sessions
        }else{
            error404(); // if request is get redirect to error404 page
        }
    }
    public function loginRequest(){
        if($this->checkAllRoleLogin())
        {
            return;
        }else{
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // check request is post or no
                // get from $_POST variable request data
                $login = $_POST['user_login'];
                $pass = $_POST['user_password'];

                // check if form inputs are empty
                if (array_search('', $_POST))
                {
                    $ajax['error1'] = true;
                    echo json_encode($ajax);
                }else {

                    $pass = md5($pass); // md5 password
                    try { // try query for errors
                        $profile = mysqli_query($this->user->conn, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'");
                        if (!$profile){
                            throw new Exception('something goes wrong');
                        }
                        $profile_settings = $profile->fetch_all(true);
                    }catch (Exception $e){
                        dd($e->getMessage());
                    }
                    $profile = mysqli_num_rows($profile);
                    if ($profile == 0) { // if the user does not exist send an error
                        $ajax['error2'] = true;
                        echo json_encode($ajax);
                    } else {
                        $profile_settings = $profile_settings[0];

                        if ($profile_settings['Role'] == 'Admin'){ // check if user role is admin

                            $_SESSION['admin_profile'] = [ // add to admin session profile and login
                                'profile' => 1,
                                'login' => $login,
                            ];
                            $ajax['success'] = true;
                            echo json_encode($ajax);
                        }else {
                            if ($profile == 1) {
                                $_SESSION['user_profile'] = [ // add to user session user data
                                    'profile' => 1,
                                    'login' => $login,
                                    'name' => $profile_settings['name'],
                                    'sname' => $profile_settings['sname'],
                                    'age' => $profile_settings['age'],
                                    'balance' => $profile_settings['balance']
                                ];
                                $ajax['success'] = true;

                                echo json_encode($ajax);
                            }
                        }
                    }
                }
            }else{
                header("location: /login");
            }
        }
    }

    public function gamesPagination()
    {
        $language = getLanguage(); // get lanugage
        $this->checkAdminLogin($language); // check admin login

        // add datable data to variables
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
            $query = mysqli_query($this->user->conn, "SELECT COUNT(*) FROM `games` WHERE `name` = '$this->login' " . $searchQuery); // get data
            if (!$query) {
                throw new Exception('Error');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }


        if ($query->num_rows) { // fetch assoc if query find anything
            $rows = $query->fetch_assoc();
        }

        $totalRows = $rows['COUNT(*)']; // get total row count


        try { // try $query and check for errors
            $query = mysqli_query(
                $this->user->conn,
                "SELECT * FROM `games` 
                      WHERE `name` = '$this->login' " . $searchQuery . "
                      ORDER BY " . $columnName . " " . $columnSortOrder . " 
                      LIMIT $row, $rowperpage");
            if (!$query) {
                throw new Exception('Error');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        $response = array( // add all to array and send to front
            "draw" => intval($draw),
            "iTotalRecords" => $totalRows,
            "iTotalDisplayRecords" => $totalRows,
            "data" => $query->fetch_all(true)
        );
        echo json_encode($response);
        return true;

    }
    public function get_money($id){
        $language = getLanguage(); // get language
        $this->checkAdminLogin($language); // check if admin is logged
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // check is request method is post

            $id = $id['id'];
            $login = $this->login;
            try {
                $game = mysqli_query($this->user->conn, "SELECT * FROM `games` WHERE `name` = '$login' AND `id` = '$id'"); // get game info
                if (!$game){
                    throw new Exception('something goes wrong, wait or refresh page');
                }
                $game_settings = $game->fetch_all(true);
            }catch (Exception $e){
                dd($e->getMessage());
            }
            $game = mysqli_num_rows($game); // get number of rows
            $game_settings = $game_settings[0];
            if ($game == 1){ // check if game is found
                if ($game_settings['status'] == 'Finished'){
                    $balance = $_SESSION['user_profile']['balance'] + $game_settings['prize']; // get old balance and + game prize
                    $_SESSION['user_profile']['balance'] = $balance;
                    try {
                        $query1 = mysqli_query($this->user->conn, "UPDATE `users` SET `balance` = $balance WHERE login = '$login'"); // update user balance
                        $query2 = mysqli_query($this->user->conn, "UPDATE `games` SET `getted` = 1 WHERE id = $id"); // change game getted value to true
                        $query3 = mysqli_query($this->user->conn, "DELETE FROM `games` WHERE `getted` = 1;"); // delete all games where getted value is true
                        if (!$query1){
                            throw new Exception('something goes wrong');
                        }elseif (!$query2){
                            throw new Exception('something goes wrong');
                        }elseif (!$query3){
                            throw new Exception('something goes wrong');
                        }
                    }catch (Exception $e){
                        dd($e->getMessage());
                    }
                    $ajax = true;
                    echo json_encode($ajax);
                }else{
                    $ajax = false;
                    echo json_encode($ajax);
                }
            }
        }else{
            header("location: /$language/home");
        }
    }

    private function checkAdminLogin($lang = 'en'){
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header("location: /$lang/home");
        }elseif (!isset($_SESSION['user_profile']['profile']) == 1) {
            header("location: /$lang/home");
        }
    }
    private function checkAllRoleLogin(){

        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: en/admin/home');
        }elseif (isset($_SESSION['user_profile']['profile']) == 1){
            header('location: en/home');
        }
    }
    private function getLogin()
    {
        $login = $_SESSION['admin_profile']['login'] ?? $_SESSION['user_profile']['login'] ?? null;
        $this->login= $login;
        return;
    }
    private function checkPlay()
    {
        $lang = getLanguage();
        if ($this->login == null) {
            return;
        } else {
            try {
                $userId = (mysqli_query($this->user->conn, "SELECT * FROM `users` where `login` = '$this->login'")->fetch_assoc())['id']; // GET USER ID
                $game_session = mysqli_query($this->user->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId "); // search game session
                if (!$userId){
                    throw new Exception('something goes wrong');
                }elseif (!$game_session){
                    throw new Exception('something goes wrong');
                }
            }catch (Exception $e){
                dd($e->getMessage());
            }
            if ($game_session->num_rows >= 1) {
                header("location: /$lang/play");
            }
        }
    }


}
