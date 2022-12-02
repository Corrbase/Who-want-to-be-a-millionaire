<?php

class UserController{
    public $user;

    public function __construct($settings)
    {
        $this->user = model('User', $settings);
    }

    public function profile(){
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /');
        }
        if (!isset($_SESSION['user_profile']['profile']) == 1) {
            header('location: /');
        }
        view("profile", null, '', 'UserPages');

    }

    // requests

    public function logout_user()
    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /admin/home');
        }elseif (!isset($_SESSION['user_profile']['profile']) == 1){
            header('location: /profile');
        }else{
            unset($_SESSION['user_profile']);
        }
    }

    public function login_user(){
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /admin/home');
        }elseif (isset($_SESSION['user_profile']['profile']) == 1){
            header('location: /admin/home');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['user_login'];
            $pass = $_POST['user_password'];
            $_SESSION['login_values'] = $login;

            if (array_search('', $_POST))
            {
                $ajax['error'] = 'please check form again';
                echo json_encode($ajax);
            }else{

                $pass = md5($pass);
                $profile = mysqli_query($this->user->conn, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'");
                $profile_settings = $profile->fetch_all(true);
                $profile = mysqli_num_rows($profile);
                $profile_settings = $profile_settings[0];
                if ($profile == 1)
                {
                    unset($_SESSION['user_profile']);

                    $_SESSION['user_profile'] = [
                        'profile' => 1,
                        'login' => $login,
                        'name' => $profile_settings['name'],
                        'sname' => $profile_settings['sname'],
                        'age' => $profile_settings['age'],
                    ];
                    $ajax['success'] = true;
                    echo json_encode($ajax);

                }
            }

        }else{
            header("location: /login");
        }
    }
}
