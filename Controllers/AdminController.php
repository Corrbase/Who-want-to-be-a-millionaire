<?php
class adminController {

    public $admin;

    public function __construct($settings)
    {
        $this->admin = model('Admin', $settings);
    }


    public function index(){
        $top_gamers = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` ORDER BY `prize` DESC LIMIT 4;")->fetch_all(true);

        $this->CheckLoginFalse();
        view("admin", $top_gamers, "Admin");
    }
    public function login(){
        $this->CheckLoginTrue();
        view("Admin/login");
    }

    // Requests

    public function login_request()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['login'];
            $pass = $_POST['password'];
            $_SESSION['login_values'] = $login;
            if ($login == '')
            {
                $_SESSION['login_error'] = 'something goes wrong';

                header("location: /admin/login");
            }elseif($pass == '')
            {
                $_SESSION['login_error'] = 'something goes wrong';
                header("location: /admin/login");
            }else{
                unset($_SESSION['login_error']);
                unset($_SESSION['login_values']);
                $profile = mysqli_query($this->admin->conn, "SELECT * FROM `admins` WHERE `login` = '$login'")->fetch_all(true);
                if (isset($profile[0]))
                {
                    if ($profile[0]['password'] == $pass){
                        $_SESSION['profile'] = [
                            'profile' => 1,
                            'login' => $login,
                            'password' => $pass,
                        ];
                        header("location: /admin/home");
                    }
                }
                header("location: /admin/login");
            }

        }else{
            header("location: /admin/login");
        }
    }

    public function CheckLoginFalse()
    {
        if (!isset($_SESSION['profile']['profile']))
        {
            header("location: /admin/login");
        }
    }

    public function CheckLoginTrue()
    {
        if (isset($_SESSION['profile']['profile']))
        {
            if (isset($_SESSION['profile']['profile']) == 1)
            {
                header("location: /admin/home");
            }
        }
    }

    public function test()
    {
        echo 111;
    }
}