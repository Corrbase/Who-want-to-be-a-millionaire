<?php

class UserController{
    public $user;
    public $front = [];
    public $header = [];
    public $login;

    public function __construct($settings)
    {
        $this->user = model('User', $settings);
        $url = substr($_GET['url'], 3);
        $arr = mysqli_query($this->user->conn, "SELECT * FROM `languages`  WHERE url = '$url' OR `url` = 'header' ")->fetch_all(true);
        foreach ($arr as $item=>$key){
            if ($url == $key['url']){
                array_push($this->front, $key);
            }
            if ($key['url'] == 'header'){

                array_push($this->header, $key);
            }
        }
        if ($_SESSION['user_profile']){
            $this->login = $_SESSION['user_profile']['login'];
        }
    }

    public function profile(){
        $language = getLanguage();
        $this->checkPlay();
        $this->loginAdmin($language );

        view("profile", null, ['front' => $this->front, 'language' => $language, 'header' => $this->header], 'UserPages');

    }

    // requests

    public function logout_user()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $_SESSION = [];

        }
    }
    public function login_user(){
        if($this->loginAll())
            return;
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: en/admin/home');
        }elseif (isset($_SESSION['user_profile']['profile']) == 1){
            header('location: en/admin/home');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['user_login'];
            $pass = $_POST['user_password'];


                if (array_search('', $_POST))
                {
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                }else {

                    $pass = md5($pass);
                    $profile = mysqli_query($this->user->conn, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'");
                    $profile_settings = $profile->fetch_all(true);
                    $profile = mysqli_num_rows($profile);
                    if ($profile == 0) {
                        $ajax['error'] = 'Այդպիսի օգտատեր գոյություն չունի';
                        echo json_encode($ajax);
                    } else {
                        $profile_settings = $profile_settings[0];
                        if ($profile_settings['Role'] == 'Admin'){

                                $_SESSION['admin_profile'] = [
                                    'profile' => 1,
                                    'login' => $login,
                                ];
                                $ajax['success'] = true;
                                echo json_encode($ajax);

                        }else {
                            if ($profile == 1) {
                                $_SESSION['user_profile'] = [
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


    public function games_pagination($pagination)
    {
    $language = getLanguage();
    $this->loginAdmin($language);
        if (is_numeric($pagination['pagination'])){
            $front = mysqli_query($this->user->conn, "SELECT * FROM `languages`  WHERE url = 'profile' ")->fetch_all(true);
            $login  =$this->login;
            $AllGames = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE `name` = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC ");
            if (is_bool($AllGames)){
                echo json_encode(false);
            }else {


                $AllGames = mysqli_query($this->user->conn, "SELECT * FROM `gamers`  WHERE name = '$login' ");

                $AllGamesCount = mysqli_num_rows($AllGames);
                $page = $pagination['pagination'] - 1;
                $count = $page * 10;
                if ($AllGamesCount / 10 < 1) {

                    $pages = 1;
                    $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC, `id` DESC  LIMIT $count, 10  ")->fetch_all(true);

                } elseif ($AllGamesCount % 10 == 0) {
                    $pages = $AllGamesCount / 10;

                    $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC, `id` DESC  LIMIT $count, 10 ")->fetch_all(true);

                } elseif ($AllGamesCount % 10 <= 9) {
                    $pages = floor($AllGamesCount / 10) + 1;
                    $a = $pagination['pagination'];
                    if ($pages == $pagination['pagination']) {
                        $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC, `id` DESC  LIMIT $count, 10 ")->fetch_all(true);

                    } else {
                        $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC, `id` DESC  LIMIT $count, 10 ")->fetch_all(true);

                    }
                }

                $PreviousPage = $pagination['pagination'] - 1;

                $NextPage = $pagination['pagination'] + 1;

                if ($PreviousPage < 1) {
                    $disabled1 = 'disabled';
                }
                if ($NextPage > $pages) {

                    $disabled2 = 'disabled';
                }
                $ajax = [
                    'question' => $questions,
                    'disabled1' => $disabled1,
                    'disabled2' => $disabled2,
                    'PreviousPage' => $PreviousPage,
                    'NextPage' => $NextPage,
                    'AllUsersCount' => $AllGamesCount,
                    'pagination' => $pagination['pagination']

                ];
                echo json_encode($ajax);

            }
        }else{
            header("location: /$language/profile");
        }

    }

    public function get_money($id){
        $language = getLanguage();
        $this->loginAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $id['id'];
            $login = $this->login;
            $game = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE `name` = '$login' AND `id` = '$id'");
            $game_settings = $game->fetch_all(true);
            $game = mysqli_num_rows($game);
            $game_settings = $game_settings[0];
            if ($game == 1){
                if ($game_settings['status'] == 'Finished'){
                    $balance = $_SESSION['user_profile']['balance'] + $game_settings['prize'];
                    $_SESSION['user_profile']['balance'] = $balance;
                    mysqli_query($this->user->conn, "UPDATE `users` SET `balance` = $balance WHERE login = '$login'");
                    mysqli_query($this->user->conn, "UPDATE `gamers` SET `getted` = 1 WHERE id = $id");
                    mysqli_query($this->user->conn, "DELETE FROM `gamers` WHERE `getted` = 1;");

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


    private function loginAdmin($lang = null){

        if ($lang !== null){
            if (isset($_SESSION['admin_profile']['profile']) == 1) {
                header("location: /$lang/home");
            }elseif (!isset($_SESSION['user_profile']['profile']) == 1) {
                header("location: /$lang/home");
            }
        }else if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header("location: /en/home");
        }elseif (!isset($_SESSION['user_profile']['profile']) == 1) {
            header("location: /en/home");
        }
    }
    private function loginUser(){
        if (!isset($_SESSION['admin_profile']['profile']) == 1) {
            dd(1);
        }elseif (isset($_SESSION['user_profile']['profile']) == 1) {
            dd(2);
        }
    }
    private function loginAll(){

        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: en/admin/home');
        }elseif (isset($_SESSION['user_profile']['profile']) == 1){
            header('location: en/admin/home');
        }
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header("location: /en/admin");
            return false;
        }elseif (isset($_SESSION['user_profile']['profile']) == 1) {
            header("location: /en/home");
            return false;
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
        $userId = (mysqli_query($this->user->conn, "SELECT * FROM `users` where `login` = '$login'")->fetch_assoc())['id'];
        $game_session = mysqli_query($this->user->conn, "SELECT * FROM `user_game_session` where `user_id` = $userId ");
        if ($game_session->num_rows >= 1){
            header("location: /$lang/play");
        }
    }


}
