<?php

// home controller
class HomeController{
    public $home; // user model
    public $front = [ // all language content
        'front' => [],
        'header' => [],
        'datatable' => []
    ];

    public function __construct($settings)
    {
        $this->home = model('Home', $settings); // connect model to home controller
        $url = substr($_GET['urlLanguage'], 3); // get front url if request to {} url
        if (!$url) { // check if url empty
            $url = substr($_GET['url'], 3); // cut language from url
        }
        // $arr is front content from database
        try {
            $arr = mysqli_query($this->home->conn, "SELECT * FROM `languages`  WHERE url = '$url' OR `url` = 'header' OR `url` = 'datatable'");
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

    public function login() // login page
    {
        $this->checklogin();
        $language = getLanguage();

        view("login", null, [
            'front' => $this->front,
            'language' => $language,
        ], 'HomePages');
    }
    public function register() // registration page
    {
        $this->checklogin();
        $language = getLanguage();

        view("register", null, [
            'front' => $this->front,
            'language' => $language,
        ], 'HomePages');
    }

    // requests

    public function registerRequest() // register post request
    {
        $this->checklogin(); // check login
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check is request method post
            // get from post and create variables
            $login = $_POST['login'];
            $pass = $_POST['password'];
            $pass_confirm = $_POST['password_confirm'];
            $name = $_POST['name'];
            $sname = $_POST['sname'];
            $age = $_POST['age'];

            // check the form end send errors to front
            switch (true) {
                case (strlen($login) < 4 || $login == ''):
                    $ajax['error1'] = true;
                    echo json_encode($ajax);
                    break;
                case (strlen($pass) < 4 || $pass == ''):
                    $ajax['error2'] = true;
                    echo json_encode($ajax);
                    break;
                case ($pass !== $pass_confirm):
                    $ajax['error3'] = true;
                    echo json_encode($ajax);
                    break;
                case (strlen($name) < 3 || $name == ''):
                    $ajax['error4'] = true;
                    echo json_encode($ajax);
                    break;
                case (strlen($sname) < 3 || $sname == ''):
                    $ajax['error5'] = true;
                    echo json_encode($ajax);
                    break;
                case ($age < 18 || $age >= 100 || $age == ''):
                    $ajax['error6'] = true;
                    echo json_encode($ajax);
                    break;
                default: // if form is ok
                    try {
                        $profile = mysqli_query($this->home->conn, "SELECT * FROM `users` WHERE `login` = '$login'"); // get profile and check user existing
                        if (!$profile) {
                            throw new Exception('Error');
                        }
                        $profile = mysqli_num_rows($profile);
                    } catch (Exception $e) {
                        dd($e->getMessage());
                    }
                    if ($profile == 1) { // profile with this username is existed
                        $ajax['error7'] = true;
                        echo json_encode($ajax);
                    }

                    $pass = md5($pass); // md5 the password
                    try {
                    $query = mysqli_query($this->home->conn, "INSERT INTO `users`( `login`, `password`, `name`, `sname`, `age`, `balance`, `Role`) VALUES ('$login','$pass','$name','$sname',$age, 0, 'User')");
                        if (!$query) {
                            throw new Exception('Error');
                        }
                    } catch (Exception $e) {
                        dd($e->getMessage());
                    }
                    $_SESSION['user_profile'] = [ // add user data to user session
                        'profile' => 1,
                        'login' => $login,
                        'name' => $name,
                        'sname' => $sname,
                        'age' => $age,
                        'balance' => 0,
                    ]; // add user information to session
                    $ajax['success'] = true;
                    echo json_encode($ajax);
            }
        } else { // if request is get redirect to error404
            header("location: /error404");
        }
    }

    public function home() // homepage
    {
        $language = getLanguage(); // get language
        $this->checkPlay(); // check play

        view("Home", null, [
            'front' => $this->front,
            'language' => $language,
        ], 'HomePages');

    }


    public function checklogin()
    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) { // check is admin logged
            header('location: /');exit();
        }
        if (isset($_SESSION['user_profile']['profile']) == 1) { // check is user logged
            header('location: /');exit();
        }
    }

    private function checkPlay(){
        $lang = getLanguage(); // get language
        if (isset($_SESSION['admin_profile'])){ // check is admin logged
            $login = $_SESSION['admin_profile']['login'];
        }elseif (isset($_SESSION['user_profile'])){ // check is user logged
            $login = $_SESSION['user_profile']['login'];
        }else{
            return true;
        }
        try {
            $userId = (mysqli_query($this->home->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc())['id'];// get user id

            $game_session = mysqli_query($this->home->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId "); // get session
            if (!$userId) {
                throw new Exception('Error');
            }elseif (!$game_session){
                throw new Exception('Error');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        if ($game_session->num_rows >= 1){ // if game session exist go to play
            header("location: /$lang/play");
        }
    }


}
