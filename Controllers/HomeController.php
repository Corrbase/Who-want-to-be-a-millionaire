<?php

// home controller
class HomeController{
    public $home; // user model
    public $front = []; // front language content
    public $header = []; // header and include language content

    public function __construct($settings)
    {
        $this->home = model('Home', $settings); // connect model to home controller
        $url = substr($_GET['url'], 3); // get url and cut language part
        $arr = mysqli_query($this->home->conn, "SELECT * FROM `languages`  WHERE url = '$url' OR `url` = 'header' ")->fetch_all(true); // get all language content
        foreach ($arr as $item=>$key){
            if ($url == $key['url']){
                array_push($this->front, $key);
            } // add to $front front content
            if ($key['url'] == 'header'){

                array_push($this->header, $key);
            } // add to $header header and include content
        }
    }

    public function login(){
        $this->checklogin();
        $language = getLanguage();

        view("login", null, ['front' => $this->front, 'language' => $language, 'header' => $this->header], 'HomePages');
    }
    public function register()
    {
        $this->checklogin();
        $language = getLanguage();

        view("register", null, ['front' => $this->front, 'language' => $language, 'header' => $this->header], 'HomePages');
    }

    // requests

    public function register_request(){
        $this->checklogin(); // check login
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check is request method post

            if (array_search('', $_POST)) { // check in form inputs
                $ajax['error'] = 'please check form again';
                echo json_encode($ajax);
            }
            else {
                $login = $_POST['login'];
                $pass = $_POST['password'];
                $pass_confirm = $_POST['password_confirm'];
                $name = $_POST['name'];
                $sname = $_POST['sname'];
                $age = $_POST['age'];
                if ($pass !== $pass_confirm) {
                    $ajax['error'] = 'Password is not same';
                    echo json_encode($ajax);
                } elseif ($age < 18 || $age >= 100) {

                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);

                } elseif (strlen($name) < 3) {
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                } elseif (strlen($login) < 4) {
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                } elseif (strlen($pass) < 4) {
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                } elseif (strlen($sname) < 3) {
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                } else {
                    $profile = mysqli_query($this->home->conn, "SELECT * FROM `users` WHERE `login` = '$login'"); // get a profile and check user's existing
                    $profile = mysqli_num_rows($profile);
                    if ($profile == 1) {
                        $ajax['error'] = 'This name of user already exists';
                        echo json_encode($ajax);
                    }
                    $pass = md5($pass);

                    $query = mysqli_query($this->home->conn, "INSERT INTO `users`( `login`, `password`, `name`, `sname`, `age`, `balance`, `Role`) VALUES ('$login','$pass','$name','$sname',$age, 0, 'User')");

                    if ($query) {
                        $_SESSION['user_profile'] = [
                            'profile' => 1,
                            'login' => $login,
                            'name' => $name,
                            'sname' => $sname,
                            'age' => $age,
                            'balance' => 0,
                        ];
                        $ajax['success'] = true;
                        echo json_encode($ajax);
                    }
                }
            }


        } else {
            header("location: /en/login");
        }
    }

    public function home(){
        $language = getLanguage();
        $this->checkPlay();

        view("Home", null, ['front' => $this->front, 'language' => $language, 'header' => $this->header], 'HomePages');

    }


    public function checklogin()

    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /');exit();
        }
        if (isset($_SESSION['user_profile']['profile']) == 1) {
            header('location: /');exit();
        }
    }

    private function checkPlay(){
        $lang = getLanguage();
        if (isset($_SESSION['admin_profile'])){
            $login = $_SESSION['admin_profile']['login'];
        }elseif (isset($_SESSION['user_profile'])){
            $login = $_SESSION['user_profile']['login'];
        }else{
            return true;
        }
        $userId = (mysqli_query($this->home->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc())['id'];
        $game_session = mysqli_query($this->home->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId ");
        if ($game_session->num_rows >= 1){
            header("location: /$lang/play");
        }
    }


}
