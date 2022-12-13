<?php

class HomeController{
    public $user;

    public function __construct($settings)
    {
        $this->user = model('Home', $settings);
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

            if (array_search('',$_POST)){
                $ajax['error'] = 'please check form again';
                echo json_encode($ajax);
            }else{
                $login = $_POST['login'];
                $pass = $_POST['password'];
                $pass_confirm = $_POST['password_confirm'];
                $name = $_POST['name'];
                $sname = $_POST['sname'];
                $age = $_POST['age'];
                if ($pass !== $pass_confirm){
                    $ajax['error'] = 'Password is not same';
                    echo json_encode($ajax);
                }elseif($age < 18 || $age >= 100){

                        $ajax['error'] = 'please check form again';
                        echo json_encode($ajax);

                }elseif (strlen($name) < 3){
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                }elseif (strlen($login) < 4){
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                }elseif (strlen($pass) < 4){
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                }elseif (strlen($sname) < 3){
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                }
                else{
                    $profile = mysqli_query($this->user->conn, "SELECT * FROM `users` WHERE `login` = '$login'");
                    $profile =  mysqli_num_rows($profile);
                    if ($profile == 1){
                        $ajax['error'] = 'This name of user already exists';
                        echo json_encode($ajax);
                    }

                    $pass = md5($pass);
                    $query = mysqli_query($this->user->conn, "INSERT INTO `users`( `login`, `password`, `name`, `sname`, `age`) VALUES ('$login','$pass','$name','$sname','$age')");
                    if ($query){
                        $_SESSION['user_profile'] = [
                            'profile' => 1,
                            'login' => $login,
                            'name' => $name,
                            'sname' => $sname,
                            'age' => $age,
                        ];
                        $ajax['success'] = true;
                        echo json_encode($ajax);
                    }
                }
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
    public function home(){
        $this->checkplay();
        view("Home", null, '', 'HomePages');

    }
    public function checkplay()
    {
        if (isset($_SESSION['play'])){
            header('location: /play');
        }
    }


}
