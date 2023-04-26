<?php

class UserController{
    public $user;

    public function __construct($settings)
    {
        $this->user = model('User', $settings);
    }

    public function profile(){
        $this->check();
        $language = getLanguage();

        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->user->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);
        $header = mysqli_query($this->user->conn, "SELECT * FROM `languages`  WHERE url = 'header' ")->fetch_all(true);



        view("profile", null, ['front' => $front, 'language' => $language, 'header' => $header], 'UserPages');

    }

    // requests

    public function logout_user()
    {
$this->check();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            unset($_SESSION['user_profile']);

        }}
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

                                unset($_SESSION['user_profile']);

                                $_SESSION['admin_profile'] = [
                                    'profile' => 1,
                                    'login' => $login,
                                    'password' => $pass,
                                ];
                                $ajax['success'] = true;
                                echo json_encode($ajax);

                        }else {
                            if ($profile == 1) {
                                unset($_SESSION['user_profile']);
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
        $this->check();
        $language = getLanguage();
        $front = mysqli_query($this->user->conn, "SELECT * FROM `languages`  WHERE url = 'profile' ")->fetch_all(true);

        $login = $_SESSION['user_profile']['name'];
        $AllGames = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC ");
        $AllGames = mysqli_num_rows($AllGames);
        if ($AllGames <= 0){
            echo "Դուք չունեք հաղթաց գումար";
        }else {


            $AllUsers = mysqli_query($this->user->conn, "SELECT * FROM `gamers`  WHERE name = '$login' ");

            $AllUsersCount = mysqli_num_rows($AllUsers);
            $page = $pagination['pagination'] - 1;
            $count = $page * 10;
            if ($AllUsersCount / 10 < 1) {

                $pages = 1;
                $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC  LIMIT $count, 10  ")->fetch_all(true);

            } elseif ($AllUsersCount %10 == 0) {
                $pages = $AllUsersCount / 10;

                $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC  LIMIT $count, 10 ")->fetch_all(true);

            } elseif ($AllUsersCount % 10 <= 9) {
                $pages = floor($AllUsersCount / 10) + 1;
                $a = $pagination['pagination'];
                if ($pages == $pagination['pagination']) {
                    $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC  LIMIT $count, 10 ")->fetch_all(true);

                } else {
                    $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE name = '$login' ORDER BY FIELD(status, 'Finished', 'waiting'), `gamers`.`getted` ASC  LIMIT $count, 10 ")->fetch_all(true);

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
        }
        echo '
                      <table class="table table-hover">
                      
                      <div class="d-flex align-items-center">
                      
                    
                        <a href="javascript:void(0)" type="button" id="ClickToPage" data-id="'. $PreviousPage;
        echo '"class="btn btn-outline-success m-1 ';
        echo $disabled1;
        echo '"';
        echo '><</a>
                    <a href="javascript:void(0)" id="ClickToPage" data-id="'. $NextPage;
        echo '" class="btn  btn-outline-success m-1 ';
        echo $disabled2;
        echo'">';
        echo '></a></div>
<div class="d-flex">


                    <p class="mt-3">'.text($front, $language, 'table_page').': ' . $pagination['pagination'];

        echo '</p>
<p class="mt-3 m-3">'.text($front, $language, 'table_all_games').': ' . $AllUsersCount;
        echo '</p>
                        <thead>
                        <tr>
                            <th>
                                '.text($front, $language, 'table_id').'
                            </th>
                            <th>
                                '.text($front, $language, 'table_name').'
                            </th>
                            <th>
                               '.text($front, $language, 'table_question').'
                            </th>
                            <th>
                                '.text($front, $language, 'table_prize').'
                            </th>
                            <th>
                                '.text($front, $language, 'table_status').'
                            </th>
                        </tr>
                        </thead>
                        <tbody>';
        foreach ($questions as $gamer) {
            echo '<tr>';
            echo '<td>';
            echo $gamer['id'];
            echo '</td>';

            echo '<td>';
            echo $gamer['name'];
            echo '</td>';

            echo '<td>';
            echo $gamer['level'];
            echo '</td>';

            echo '<td>';
            echo $gamer['prize'];
            echo '</td>';

            echo '<td>';

            if ($gamer['getted'] == true){echo 'getted';}
            else if ($gamer['status'] == 'Finished'){

                echo "<button class='btn btn-outline-primary get-money' data-id='". $gamer['id'] ."'>".text($front, $language, 'table_prize_button')." </button>";
            }else if ($gamer['status'] == 'canceled'){
                echo text($front, $language, 'game_status_canceled');
            }else if ($gamer['status'] == 'waiting') {
                echo text($front, $language, 'game_status_waiting');
            }
            echo '</td>';
            echo '</tr>';

        }

        echo '
                        </tbody>
                    </table>
        ';
    }

    public function get_money($id){
        $this->check();
        $id = $id['id'];
        $login = $_SESSION['user_profile']['login'];
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

    }

    public function check(){
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /');
        }
        if (!isset($_SESSION['user_profile']['profile']) == 1) {
            header('location: /');
        }
    }


}
