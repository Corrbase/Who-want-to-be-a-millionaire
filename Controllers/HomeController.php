<?php

class HomeController{
    public $game;

    public function __construct($settings)
    {
        $this->game = model('Game', $settings);
    }

    public function login(){
        if (isset($_SESSION['admin_profile']['profile']) == 1) {

            header('location: /');
        }
        view("login", null, '', 'HomePages');

    }
    public function register()
    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) {

            header('location: /');
        }elseif (isset($_SESSION['user_profile']['profile']) == 1) {

            header('location: /');
        }
        view("register", null, '', 'HomePages');
    }

    // requests

    public function register_request(){
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /admin/home');
        }elseif (isset($_SESSION['user_profile']['profile']) == 1){
            header('location: /profile');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['admin_login'];
            $pass = $_POST['admin_password'];
            if (!array_search('',$_POST)){
                $ajax['error'] = true;
                echo json_encode($ajax);
            }
//
//            else{
//
//                $pass = md5($pass);
//                unset($_SESSION['login_error']);
//                unset($_SESSION['login_values']);
//                $profile = mysqli_query($this->admin->conn, "SELECT * FROM `admins` WHERE `login` = '$login' AND `password` = '$pass'");
//                $profile =  mysqli_num_rows($profile);
//                if ($profile == 1)
//                {
//                    unset($_SESSION['user_profile']);
//
//                    $_SESSION['admin_profile'] = [
//                        'profile' => 1,
//                        'login' => $login,
//                        'password' => $pass,
//                    ];
//                    $ajax['success'] = true;
//                    echo json_encode($ajax);
//
//                }
//            }

        }else{
            header("location: /login");
        }
    }


}
