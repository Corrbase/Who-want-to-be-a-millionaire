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
                        'balance' => $profile_settings['balance']
                    ];
                    $ajax['success'] = true;
                    echo json_encode($ajax);

                }
            }

        }else{
            header("location: /login");
        }
    }


    public function games_pagination($pagination)
    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /');
        }
        if (!isset($_SESSION['user_profile']['profile']) == 1) {
            header('location: /');
        }
        $login = $_SESSION['user_profile']['name'];
        $AllGames = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE `name` = '$login'");
        $AllGames = mysqli_num_rows($AllGames);
        $PreviousPage = $pagination['pagination'] - 1;
        $NextPage = $pagination['pagination'] + 1;
        if ($pagination['pagination'] == 1){
            $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE `name` = '$login' LIMIT 10")->fetch_all(true);
        }elseif($pagination['pagination'] > ceil($AllGames / 10)) {
            dd('Ups');
        }
        else{
            $page = ($pagination['pagination'] * 5) ;

            $questions = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE `name` = '$login' LIMIT 10 OFFSET $page")->fetch_all(true);
            $NextPage = ceil($AllGames);
        }
        if ($NextPage > ceil($AllGames / 10)){
            $NextPage = ceil($AllGames / 10);
        }
        if ($PreviousPage <= 0){
            $PreviousPage = 1;
        }
        echo '
                      <table class="table table-hover">
                      
                      

                    <a href="javascript:void(0)" id="ClickToPage" data-id="'. $PreviousPage;
        echo '"class="btn btn-outline-success m-1"><</a>
                    <a href="javascript:void(0)" id="ClickToPage" data-id="'. $NextPage;
        echo '" class="btn  btn-outline-success m-1">></a>
                    <p>Page: ' . $pagination['pagination'];
        echo '</p>
                        <thead>
                        <tr>
                            <th>
                                #number
                            </th>
                            <th>
                                name
                            </th>
                            <th>
                                level
                            </th>
                            <th>
                                prize
                            </th>
                            <th>
                                status
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
                echo "<button class='btn btn-outline-primary get-money' data-id='". $gamer['id'] ."'>Get</button>";
            }else if ($gamer['status'] == 'Canceled'){
                echo 'Canceled';
            }else if ($gamer['status'] == 'waiting') {
                echo 'not accepted';
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
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /');
        }
        if (!isset($_SESSION['user_profile']['profile']) == 1) {
            header('location: /');
        }
        $id = $id['id'];
        $login = $_SESSION['user_profile']['login'];
        $game = mysqli_query($this->user->conn, "SELECT * FROM `gamers` WHERE `name` = '$login' AND `id` = '$id'");
        $game_settings = $game->fetch_all(true);
        $game = mysqli_num_rows($game);
        $game_settings = $game_settings[0];
        if ($game == 1){
            if ($game_settings['status'] == 'Finished'){
                $balance = $_SESSION['user_profile']['balance'] + $game_settings['prize'];
                mysqli_query($this->user->conn, "UPDATE `users` SET `balance` = $balance WHERE login = '$login'");
                mysqli_query($this->user->conn, "UPDATE `gamers` SET `getted` = 1 WHERE id = $id");

                $ajax = true;
                echo json_encode($ajax);
            }else{
                $ajax = false;
                echo json_encode($ajax);
            }
        }

    }


}
