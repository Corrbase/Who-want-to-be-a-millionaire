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

    public function login() // login page
    {
        $this->checklogin();
        $language = getLanguage();

        view("login", null, ['front' => $this->front, 'language' => $language, 'header' => $this->header], 'HomePages');
    }
    public function register() // registration page
    {
        $this->checklogin();
        $language = getLanguage();

        view("register", null, ['front' => $this->front, 'language' => $language, 'header' => $this->header], 'HomePages');
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

                // check the form
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
                        $profile = mysqli_query($this->home->conn, "SELECT * FROM `users` WHERE `login` = '$login'"); // get profile and check user existing
                        $profile = mysqli_num_rows($profile);
                        if ($profile == 1) { // profile with this username is existed
                            $ajax['error7'] = true;
                            echo json_encode($ajax);
                        }

                        $pass = md5($pass); // md5 the password
                        $query = mysqli_query($this->home->conn, "INSERT INTO `users`( `login`, `password`, `name`, `sname`, `age`, `balance`, `Role`) VALUES ('$login','$pass','$name','$sname',$age, 0, 'User')");

                        if ($query) {
                            $_SESSION['user_profile'] = [
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
                }
            } else {
            header("location: /error404");
        }
    }

    public function home() // homepage
    {
        $language = getLanguage();
        $this->checkPlay();

        view("Home", null, ['front' => $this->front, 'language' => $language, 'header' => $this->header], 'HomePages');

    }


    public function checklogin()
    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) { // check is admin logged
            header('location: /');exit();
        }
        if (isset($_SESSION['user_profile']['profile']) == 1) { // ches is user logged
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
        $userId = (mysqli_query($this->home->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc())['id'];// get user id
        $game_session = mysqli_query($this->home->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId "); // get session
        if ($game_session->num_rows >= 1){ // if game session exist go to play
            header("location: /$lang/play");
        }
    }


}
