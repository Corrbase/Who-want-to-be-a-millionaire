<?php
class AdminController {

    public $admin;

    public function __construct($settings)
    {
        $this->admin = model('Admin', $settings);
    }


    public function index(){

        $language = getLanguage();
        $this->CheckLogin($language);

        $UpToFive = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` WHERE `level` >= 5");
        $AllGames = mysqli_query($this->admin->conn, "SELECT * FROM `gamers`");
        $UpToFive = mysqli_num_rows($UpToFive);
        $AllGames = mysqli_num_rows($AllGames);



        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);

        $top_gamers = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` ORDER BY `prize` DESC LIMIT 5;")->fetch_all(true);

        view("dashboard", 'Admin' , [
            'top_gamers' => $top_gamers,
            'UpToFive' => $UpToFive,
            'AllGames' => $AllGames,
            'Admin' => $_SESSION['admin_profile'],
            'front' => $front,
            'language' => $language,
            'header' => $header
        ], "Admin");
    }

    public function questions()
    {
        $language = getLanguage();
        $this->CheckLogin($language);

        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);
        view("questions", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'header' => $header,
            'front' => $front
        ], "Admin");
    }

    public function add_user(){
        $language = getLanguage();
        $this->CheckLogin($language);

        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);
        view("add_user", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'header' => $header,
            'front' => $front
        ], "Admin");
    }
    public function users(){
        $language = getLanguage();
        $this->CheckLogin($language);

        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);
        view("users", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'header' => $header,
            'front' => $front
        ], "Admin");
    }
    public function gamers_pagination($pagination)
    {

        if (!is_numeric($pagination['pagination'])){
            header('location: /');
        }
        $language = getLanguage();
        $this->CheckLogin($language);
        $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `gamers`");

        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin/gamers' ")->fetch_all(true);
        $AllGamesCount = mysqli_num_rows($AllUsers);
        $page = $pagination['pagination'] -1;
        $count = $page * 5;
        if ($AllGamesCount /5 <1){

            $pages = 1;
            $games = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllGamesCount%5 == 0){
            $pages = $AllGamesCount/5;

            $games = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllGamesCount%5 <= 4){
            $pages = floor($AllGamesCount/5) + 1;
            $a = $pagination['pagination'];
            if ($pages == $pagination['pagination']){
                $games = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

            }else{
                $games = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

            }
        }

        $PreviousPage = $pagination['pagination'] - 1;
        $NextPage = $pagination['pagination'] + 1;
        if ($PreviousPage < 1){
            $disabled1 = 'disabled';
        }
        if ($NextPage > $pages){

            $disabled2 = 'disabled';
        }
        $ajax = [
            'games' => $games,
            'disabled1' => $disabled1,
            'disabled2' => $disabled2,
            'PreviousPage' => $PreviousPage,
            'NextPage' => $NextPage,
            'AllUsersCount' => $AllGamesCount,
            'pagination' => $pagination['pagination']

        ];
        echo json_encode($ajax);

//            foreach ($questions as $gamer) {
//                echo '<tr>';
//                echo '<td>';
//                echo $gamer['id'];
//                echo '</td>';
//
//                echo '<td>';
//                echo $gamer['name'];
//                echo '</td>';
//
//                echo '<td>';
//                echo $gamer['level'];
//                echo '</td>';
//
//                echo '<td>';
//                echo $gamer['prize'];
//                echo '</td>';
//
//                echo '<td>';
//                echo '<select class="status-change form-select form-select-sm">
//                        <option selected="" disabled="">Select a status:</option>
//
//                        <option ';
//                if ($gamer['status'] == 'Waiting'){
//                    echo 'selected="selected"';
//                }
//                echo 'name="Waiting" data-id="';
//                echo $gamer['id'];
//                echo '" value="waiting" selected="">'. text($front, $language, 'table_status_in_process') .'</option>
//                        <option ';
//                if ($gamer['status'] == 'Canceled'){
//                    echo 'selected="selected"';
//                }
//                echo 'name="Canceled" data-id="';
//                echo $gamer['id'];
//                echo '" value="Canceled">'. text($front, $language, 'table_status_canceled') .'</option>
//                        <option ';
//                if ($gamer['status'] == 'Finished'){
//                    echo 'selected="selected"';
//                }
//                echo 'name="Finished" data-id="';
//                echo $gamer['id'];
//                echo '" value="Finished">'. text($front, $language, 'table_status_finished') .'</option>
//                      </select>';
//                echo '</td>';
//
//                echo '<td>';
//                    echo '<a class="Delete_user" data-id =' . $gamer['id'] . ' href="javascript:void(0)">'. text($front, $language, 'table_delete') .'</a>';
//                echo '</td>';
//                echo '</tr>';
//            }
//
//        echo '
//                        </tbody>
//                    </table>
//        ';

    }
    public function question_pagination($pagination)
    {
        if (!is_numeric($pagination['pagination'])){
            header('location: /');
        }
        $language = getLanguage();
        $this->CheckLogin($language);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin/questions' ")->fetch_all(true);
        $AllQuestions = mysqli_query($this->admin->conn, "SELECT * FROM `questions`   ");

        $AllQuestionsCount = mysqli_num_rows($AllQuestions);
        $page = $pagination['pagination'] -1;
        $count = $page * 5;
        if ($AllQuestionsCount %5 == 0){

            $pages = 1;
            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllQuestionsCount/5 == 1){
            $pages = $AllQuestionsCount/5;

            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllQuestionsCount%5 <= 4){
            $pages = floor($AllQuestionsCount/5) + 1;
            $a = $pagination['pagination'];
            if ($pages == $pagination['pagination']){
                $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT $count, 5 ")->fetch_all(true);

            }else{
                $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT $count, 5 ")->fetch_all(true);

            }
        }

        $PreviousPage = $pagination['pagination'] - 1;
        $NextPage = $pagination['pagination'] + 1;
        if ($PreviousPage < 1){
            $disabled1 = 'disabled';
        }
        if ($NextPage > $pages){

            $disabled2 = 'disabled';
        }

        $ajax = [
            'questions' => $questions,
            'disabled1' => $disabled1,
            'disabled2' => $disabled2,
            'PreviousPage' => $PreviousPage,
            'NextPage' => $NextPage,
            'AllQuestionsCount' => $AllQuestionsCount,
            'pagination' => $pagination['pagination']

        ];
        echo json_encode($ajax);

//        echo '<table class="table table-hover">
//
//                      <div class="d-flex align-items-center">
//
//
//                        <a href="javascript:void(0)" type="button" id="ClickToPage" data-id="'. $PreviousPage;
//        echo '"class="btn btn-outline-success m-1 ';
//        echo $disabled1;
//        echo '"';
//
//        echo '><</a>
//                    <a href="javascript:void(0)" id="ClickToPage" data-id="'. $NextPage;
//        echo '" class="btn  btn-outline-success m-1 ';
//        echo $disabled2;
//        echo'">';
//
//        echo '></a>';
//        echo '<a href="/hy/admin/questions/create" class="font-weight-bold btn  btn-outline-success m-1">+</a> </div>';
//        echo '
//<div class="d-flex">
//
//
//                    <p class="mt-3">'. text($front, $language, 'table_page').' '. $pagination['pagination'];
//
//        echo '</p>
//<p class="mt-3 m-3">'. text($front, $language, 'table_count').' ' . $AllQuestionsCount;
//        echo '
//                        <thead>
//                        <tr>
//                            <th>
//                                '. text($front, $language, 'table_num').'
//                            </th>
//                            <th>
//                                '. text($front, $language, 'table_question').'
//                            </th>
//                            <th>
//                                '. text($front, $language, 'table_right_ans').'
//                            </th>
//                            <th>
//                                '. text($front, $language, 'table_diff').'
//                            </th>
//                        </tr>
//                        </thead>
//                        <tbody>';
//$rightans = 'right_answer_' . $language;
//
//        foreach ($questions as $qeustion) {
//            echo '<tr>';
//            echo '<td>';
//            echo $qeustion['id'];
//            echo '</td>';
//
//            echo '<td>';
//            echo $qeustion[$language];
//            echo '</td>';
//
//            echo '<td>';
//            echo $qeustion[$rightans];
//            echo '</td>';
//
//            echo '<td>';
//            if ($qeustion['difficulty'] == 'normal'){
//                echo text($front, $language, 'table_diff_n');
//            }elseif ($qeustion['difficulty'] == 'easy'){
//                echo text($front, $language, 'table_diff_e');
//            }elseif ($qeustion['difficulty'] == 'hard'){
//                echo text($front, $language, 'table_diff_h');
//            }
//            echo '</td>';
//
//            echo '<td>';
//            echo '<a href="/'.$language.'/admin/questions/edit/' . $qeustion['id'];
//            echo '">'. text($front, $language, 'table_edit').'</a>';
//            echo '</td>';
//            echo '</tr>';
//        }
//
//        echo '
//                        </tbody>
//                    </table>
//        ';
    }
    public function admins_pagination($pagination)
    {
        $language = getLanguage();
        $this->CheckLogin($language);
        if (is_numeric($pagination['pagination'])) {
            $language = getLanguage();
            $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin/users' ")->fetch_all(true);
            $AllQuestions = mysqli_query($this->admin->conn, "SELECT * FROM `questions`   ");

            $ajax = $_GET;
            $role = $ajax['role'];


            if ($ajax['role'] == 'all') {
                $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users`");
            } else {

                $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role'");

            }
            $AllUsersCount = mysqli_num_rows($AllUsers);
            $page = $pagination['pagination'] - 1;
            $count = $page * 5;
            if ($AllUsersCount / 5 == 1) {

                $pages = 1;
                if ($ajax['role'] == 'all') {
                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` LIMIT $count, 5 ")->fetch_all(true);
                } else {

                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5 ")->fetch_all(true);

                }
            } elseif ($AllUsersCount % 5 == 0) {
                $pages = $AllUsersCount / 5;

                if ($ajax['role'] == 'all') {
                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users`LIMIT $count, 5 ")->fetch_all(true);
                } else {

                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5  ")->fetch_all(true);

                }
            } elseif ($AllUsersCount % 5 <= 4) {
                $pages = floor($AllUsersCount / 5) + 1;
                $a = $pagination['pagination'];
                if ($pages == $pagination['pagination']) {
                    if ($ajax['role'] == 'all') {
                        $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` LIMIT $count, 5 ")->fetch_all(true);
                    } else {

                        $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5")->fetch_all(true);

                    }
                } else {
                    if ($ajax['role'] == 'all') {
                        $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` LIMIT $count, 5 ")->fetch_all(true);

                    } else {

                        $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5 ")->fetch_all(true);

                    }
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
                'users' => $AllUsers,
                'disabled1' => $disabled1,
                'disabled2' => $disabled2,
                'PreviousPage' => $PreviousPage,
                'NextPage' => $NextPage,
                'AllUsersCount' => $AllUsersCount,
                'pagination' => $pagination['pagination']

            ];
            echo json_encode($ajax);
//            echo '
//                      <table class="table table-hover">
//
//                      <div class="d-flex align-items-center">
//
//
//                        <a href="javascript:void(0)" type="button" id="ClickToPage" data-id="'. $PreviousPage;
//            echo '"class="btn btn-outline-success m-1 ';
//            echo $disabled1;
//            echo '"';
//
//            echo '><</a>
//                    <a href="javascript:void(0)" id="ClickToPage" data-id="'. $NextPage;
//            echo '" class="btn  btn-outline-success m-1 ';
//            echo $disabled2;
//            echo'">';
//            echo '></a></div>
//<div class="d-flex">
//
//
//                    <p class="mt-3">'.text($front, $language, 'table_page' ).' ' . $pagination['pagination'];
//
//            echo '</p>
//<p class="mt-3 m-3">'.text($front, $language, 'table_count' ).' ' . $AllUsersCount;
//
//            echo '</p></div>
//                        <thead>
//                        <tr>
//                            <th>
//                                '.text($front, $language, 'table_num' ).'
//                            </th>
//                            <th>
//                                '.text($front, $language, 'table_login' ).'
//                            </th>
//                            <th>
//                                '.text($front, $language, 'table_name' ).'
//                            </th>
//                            <th>
//                                '.text($front, $language, 'table_balance' ).'
//                            </th>
//                            <th>
//                            '.text($front, $language, 'table_role' ).'
//</th>
//                            <th>
//                            '.text($front, $language, 'table_action' ).'
//</th>
//                        </tr>
//                        </thead>
//                        <tbody>';
//
//            foreach ($AllUsers as $gamer) {
//                echo '<tr>';
//                echo '<td>';
//                echo $gamer['id'];
//                echo '</td>';
//
//                echo '<td>';
//                echo $gamer['login'];
//                echo '</td>';
//
//                echo '<td>';
//                echo $gamer['name'];
//                echo '</td>';
//
//                echo '<td>';
//                echo $gamer['balance'];
//                echo '</td>';
//
//                echo '<td>';
//                echo $gamer['Role'];
//                echo '</td>';
//
//                echo '<td>';
//                echo '<a href="/'.$language.'/admin/user/edit/' . $gamer['id'];
//                echo '">Edit</a>';
//                echo '</td>';
//                echo '</tr>';
//            }
//            echo '
//                        </tbody>
//                    </table>
//        ';
//        }else{
//            header('location: /');
//        }
        }
    }
    public function create_question()
    {
        $language = getLanguage();
        $this->CheckLogin($language);

        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);

        $this->CheckLogin();
        view("create_question", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'header' => $header,
            'front' => $front
        ], "Admin");
    }
    public function edit_user($id){
        $language = getLanguage();
        $this->CheckLogin($language);
        $id = $id['id'];



        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin/user/edit' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);
        $user = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `id` = $id")->fetch_all(true);

        if ($user){
            view('edit_user','Admin', [
                'user'=>$user,
                'language' => $language,
                'header' => $header,
                'front' => $front
            ], 'Admin');
        }else{
            header('Location: /error404');
        }
    }
    public function edit_question($id)
    {
        $language = getLanguage();
        $this->CheckLogin($language);
        if (!is_numeric($id['id'])){
            header('location: /');
        }

        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin/questions/edit' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);
        $id = $id['id'];
        if (is_numeric($id)){
            $question = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
    //        $question = mysqli_num_rows($question);

            if ($question){
                view('edit_question', 'Admin', [
                    'question' => $question,
                    'language' => $language,
                    'header' => $header,
                    'front' => $front
                ], 'Admin');
            }
        }else{
            header("Location: /error404");
        }
    }
    public function documentation()
    {
        $language = getLanguage();
        $this->CheckLogin($language);

        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);
        view("documentation", 'Admin' , [
            'language' => $language,
            'header' => $header,
            'front' => $front
        ], "Admin");
    }
    public function gamers(){
        $language = getLanguage();
        $this->CheckLogin($language);

        $url = substr($_GET['url'], 3);
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = '$url' ")->fetch_all(true);

        $header = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin_header' ")->fetch_all(true);

        view("gamers", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
            'language' => $language,
            'header' => $header,
            'front' => $front
        ], "Admin");
    }

    // Requests

    public function logout()
    {
        if($this->CheckLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->CheckLogin();
            unset($_SESSION['admin_profile']);
        }else{
            header("location: /admin/home");
        }
    }
    public function add_user_request()  {

        if($this->CheckLogin())
            return;
        $language = getLanguage();
        $front = mysqli_query($this->admin->conn, "SELECT * FROM `languages`  WHERE url = 'admin/users/add' ")->fetch_all(true);

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if (array_search('',$_POST)){
                $ajax['success'] = false;
                echo json_encode($ajax);
            }else{

                $login = $_POST['login'];
                $pass = $_POST['password'];
                $name = $_POST['name'];
                $sname = $_POST['sname'];
                $age = $_POST['age'];
                $role = $_POST['Role'];
                if($age < 18 || $age >= 100){

                    $ajax['success'] = false;
                    echo json_encode($ajax);

                }elseif (strlen($name) < 3){
                    $ajax['success'] = false;
                    echo json_encode($ajax);
                }elseif (strlen($login) < 4){
                    $ajax['success'] = false;
                    echo json_encode($ajax);
                }elseif (strlen($pass) < 4){
                    $ajax['success'] = false;
                    echo json_encode($ajax);
                }elseif (strlen($sname) < 3){
                    $ajax['success'] = false;
                    echo json_encode($ajax);
                }elseif ($role == ''){

                    $ajax['success'] = false;
                    echo json_encode($ajax);
                }
                else{
                    $profile = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `login` = '$login'");

                    $profile =  mysqli_num_rows($profile);
                    if ($profile == 1){
                        $ajax['success'] = false;
                        echo json_encode($ajax);
                    }else {

                        $pass = md5($pass);
                        $query = mysqli_query($this->admin->conn, "INSERT INTO `users`( `login`, `password`, `name`, `sname`, `age`, `balance`, `Role`) VALUES ( '$login', '$pass', '$name', '$sname', $age, 0, '$role' ) ");

                        $ajax['success'] = true;
                        echo json_encode($ajax);
                    }
                    }
                }
            }
    }
    public function delete_user($user){
        if($this->CheckLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $user['id'];
            if (is_numeric($id)){
                $gamer = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` WHERE `id` = $id")->fetch_all(true);

                if (sizeof($gamer) == 0){
                    echo 'user is not find';
                }

                $result = mysqli_query($this->admin->conn, "DELETE FROM `gamers` WHERE `id` = $id");
                header("location: /admin/home");
            }else{
                header("location: /");
            }
        }else{
            header("location: /admin/home");
        }

    }
    public function question_edit($id){

        if($this->CheckLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $id['id'];
             $act = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
            if ($act[0] == 0){
                dd('oops');
            }
            if ($_POST){
                $question_hy = $_POST['question_hy'];
                $question_en = $_POST['question_en'];
                $wrong_answer_1_en = $_POST['wrong_answer_1_en'];
                $wrong_answer_2_en = $_POST['wrong_answer_2_en'];
                $wrong_answer_3_en = $_POST['wrong_answer_3_en'];
                $wrong_answer_1_hy = $_POST['wrong_answer_1_hy'];
                $wrong_answer_2_hy = $_POST['wrong_answer_2_hy'];
                $wrong_answer_3_hy = $_POST['wrong_answer_3_hy'];
                $right_answer_hy = $_POST['right_answer_hy'];
                $right_answer_en = $_POST['right_answer_en'];
                $diff = $_POST['difficulty'];
                $active = $_POST['Active'];
                $actives = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE active = 1");
                $actives = mysqli_num_rows($actives);

                if ($active == 0){
                    if ($actives <= 15 ){

                        $ajax['success'] = 'error1';
                        echo json_encode($ajax);
                        return false;
                    }
                    }
                }

            $wrongs_en = "$wrong_answer_1_en" . ',' . "$wrong_answer_2_en" . ',' . "$wrong_answer_3_en";
            $wrongs_hy = "$wrong_answer_1_hy" . ',' . "$wrong_answer_2_hy" . ',' . "$wrong_answer_3_hy";

            if (!array_search('',$_POST)){

                mysqli_query($this->admin->conn, "UPDATE `questions` SET 
                       `hy`='$question_hy',
                       `right_answer_hy`='$right_answer_hy',
                       `wrong_answer_hy`='$wrongs_hy',
                       `difficulty`='$diff',
                       `active`='$active',
                       `en`='$question_en',
                       `right_answer_en`='$right_answer_en',
                       `wrong_answer_en`='$wrongs_en' 
                   WHERE `id` = $id");

                $ajax['success'] = 'success';
                echo json_encode($ajax);
                return false;
            }else{

                $ajax['success'] = 'error2';
                echo json_encode($ajax);
                return false;

            }
        }else{
        }
    }
    public function user_edit($id){

        if($this->CheckLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_POST){
                $id = $id['id'];
                $name = $_POST['name'];
                $sname = $_POST['sname'];
                $age = $_POST['age'];
                $balance = $_POST['balance'];
                $role = $_POST['Role'];
                $actives = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE $id = 1");
                $actives = mysqli_num_rows($actives);

            }
            $admins = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `Role` = 'Admin'");
            $admins = mysqli_num_rows($admins);
            $user = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `id` = '$id'")->fetch_all(true);
            if ($user[0]['login'] == $_SESSION['admin_profile']['login']){
                $ajax['success'] = 'error1';
                echo json_encode($ajax);
                return false;
            } elseif ($admins <= 1 && $role = 'User'){
                $ajax['success'] = 'error2';
                echo json_encode($ajax);
                return false;
            } elseif ($age < 18 || $age >105){
                $ajax['success'] = 'error3';
                echo json_encode($ajax);
                return false;
            }elseif (!array_search('',$_POST)){

                mysqli_query($this->admin->conn, "UPDATE `users` SET `name`= '$name', `sname`= '$sname',  `age`= '$age', `balance`= '$balance', `role` = '$role' WHERE `id` = $id;");

                $ajax['success'] = true;
                echo json_encode($ajax);
                return true;
            }else{

                $ajax['success'] = 'error4';

                echo json_encode($ajax);
                return false;

            }
        }else{
        }
    }
    public function question_create(){

        if($this->CheckLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST){
                $question_hy = $_POST['question_hy'];
                $question_en = $_POST['question_en'];
                $wrong_answer_1_en = $_POST['wrong_answer_1_en'];
                $wrong_answer_2_en = $_POST['wrong_answer_2_en'];
                $wrong_answer_3_en = $_POST['wrong_answer_3_en'];
                $wrong_answer_1_hy = $_POST['wrong_answer_1_hy'];
                $wrong_answer_2_hy = $_POST['wrong_answer_2_hy'];
                $wrong_answer_3_hy = $_POST['wrong_answer_3_hy'];
                $right_answer_hy = $_POST['right_answer_hy'];
                $right_answer_en = $_POST['right_answer_en'];
                $diff = $_POST['difficulty'];
                $active = $_POST['Active'];
                $actives = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE active = 1");
                $actives = mysqli_num_rows($actives);

                $wrongs_en = "$wrong_answer_1_en" . ',' . "$wrong_answer_2_en" . ',' . "$wrong_answer_3_en";
                $wrongs_hy = "$wrong_answer_1_hy" . ',' . "$wrong_answer_2_hy" . ',' . "$wrong_answer_3_hy";

                if (!array_search('',$_POST)){

                    mysqli_query($this->admin->conn, "INSERT INTO `questions`(`hy`, `right_answer_hy`, `wrong_answer_hy`, `difficulty`, `active`, `en`, `right_answer_en`, `wrong_answer_en`) 
VALUES (
    '$question_hy',
        '$right_answer_hy',
        '$wrongs_hy',
        '$diff',
        '$active',
        '$question_en',
        '$right_answer_en',
        '$wrongs_en')");

                    return true;
                }else{

                    echo 0;
                    return false;
                }
            }
        }else{
        }
    }
    public function change_gamer_status($id)
    {
        if($this->CheckLogin())
            return;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $id['id'];
            if (is_numeric($id)) {

                $question = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` WHERE `id` = $id")->fetch_all(true);
                //        $question = mysqli_num_rows($question);
                $Val = $_POST['value'];
                if ($question) {
                    mysqli_query($this->admin->conn, "Update `gamers` SET `status` = '$Val' WHERE `id` = $id");
                }
            } else {
                header('location: /');
            }
        }
    }


    public function CheckLogin($lang = null){
        if (isset($_SESSION['admin_profile']['profile'])) {
            return false;
        }else{
            if ($lang == null){
                header("location: /en/home");
            }else{
                header("location: /$lang/home");
            }
            return true;
        }
    }


    public function test()
    {
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ո՞ր օրն է համարվում շաբաթվա առաջին օրը Իսրայելում', 'Կիրակի' ,'Երկուշաբթի, Շաբաթ, Ուրբաթ', 'normal', 21 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ո՞ր քիմիական տարրի հայտնագործման պատվին են Ֆրանսիայում 19-րդ դարում հատել Ապոլոնի պատկերով մեդալ․', 'Հելիում' ,'Տիտան, Ռադիում, Ջրածին', 'normal', 22 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ըստ իր խոստովանության ինչի՞ աստվածն էր Օլե Լուկոյեն՝ Անդերսենի համանուն հեքիաթից․', 'Երազների' ,'Հեքիաթների, Մանկության, Գիշերվա', 'normal', 23 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ավանդաբար ի՞նչ են անում երաժիշտները Հայդնի «Հրաժեշտի սիմֆոնիան» նվագելիս․', 'Հանգցնում են մոմերը' ,'Երգում են, Գլխարկ են հագնում, Օդային համբույրներ են ուղարկում', 'normal', 24 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ո՞վ էր Հենրի Թեյթը, ում անունով է կոչվում Լոնդոնի պատկերասրահը․', 'Բարերար' ,'Ծովահեն, Նկարիչ, Ճարտարապետ', 'normal', 25 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ո՞ւմ են պարգևատրում Ֆյոդոր Պլևակոի անվան մեդալով', 'Փաստաբաններին' ,'Լուսանկարիչներին, Բժիշկներին, Լրագրողներին', 'normal', 26 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ի՞նչպես է կոչվում մարդկային մարմնի մոդելը՝ բժիշկների ուսուցման իրազննականության համար', 'Ֆանտոմ' ,'Ուրվական, Ոգի, Խրտվիլակ', 'normal', 27 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ո՞ր օրն է համարվում շաբաթվա առաջին օրը Իսրայելում', 'Կիրակի' ,'Երկուշաբթի, Շաբաթ, Ուրբաթ', 'normal', 28 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ո՞ր քիմիական տարրի հայտնագործման պատվին են Ֆրանսիայում 19-րդ դարում հատել Ապոլոնի պատկերով մեդալ․', 'Հելիում' ,'Տիտան, Ռադիում, Ջրածին', 'normal', 29 );");
//        mysqli_query($this->admin->conn, "INSERT INTO `questions` (question, right_answer, wrong_answer, difficulty, number) VALUES ('Ըստ իր խոստովանության ինչի՞ աստվածն էր Օլե Լուկոյեն՝ Անդերսենի համանուն հեքիաթից․', 'Երազների' ,'Հեքիաթների, Մանկության, Գիշերվա', 'normal', 30 );");
    }
}