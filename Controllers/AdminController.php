<?php
class AdminController {

    public $admin;

    public function __construct($settings)
    {
        $this->admin = model('Admin', $settings);
    }


    public function index(){

        $this->CheckLogin();

        $UpToFive = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` WHERE `level` >= 5");
        $AllGames = mysqli_query($this->admin->conn, "SELECT * FROM `gamers`");
        $UpToFive = mysqli_num_rows($UpToFive);
        $AllGames = mysqli_num_rows($AllGames);

        $top_gamers = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` ORDER BY `prize` DESC LIMIT 5;")->fetch_all(true);

        view("dashboard", 'Admin' , [
            'top_gamers' => $top_gamers,
            'UpToFive' => $UpToFive,
            'AllGames' => $AllGames,
            'Admin' => $_SESSION['admin_profile'],
        ], "Admin");
    }




    public function questions()
    {

        $this->CheckLogin();
        view("questions", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
        ], "Admin");
    }

    public function add_user(){
        $this->CheckLogin();
        view("add_user", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
        ], "Admin");
    }
    public function users(){
        $this->CheckLogin();
        view("users", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
        ], "Admin");
    }
    public function gamers_pagination($pagination)
    {
        $this->CheckLogin();
        $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `gamers`");

        $AllUsersCount = mysqli_num_rows($AllUsers);
        $page = $pagination['pagination'] -1;
        $count = $page * 5;
        if ($AllUsersCount /5 <1){

            $pages = 1;
            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllUsersCount/5 == 1){
            $pages = $AllUsersCount/5;

            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllUsersCount%5 <= 4){
            $pages = floor($AllUsersCount/5) + 1;
            $a = $pagination['pagination'];
            if ($pages == $pagination['pagination']){
                $questions = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

            }else{
                $questions = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT $count, 5 ")->fetch_all(true);

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


                    <p class="mt-3">Page: ' . $pagination['pagination'];

        echo '</p>
<p class="mt-3 m-3">All questions: ' . $AllUsersCount;
        echo '
                        <thead>
                        <tr>
                            <th>
                                #id
                            </th>
                            <th>
                                login
                            </th>
                            <th>
                                level
                            </th>
                            <th>
                                prize
                            </th>
                            <th>
                                action
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
            echo '<select class="status-change form-select form-select-sm">
                    <option selected="" disabled="">Select a status:</option>

                    <option ';
            if ($gamer['status'] == 'Waiting'){
                echo 'selected="selected"';
            }
            echo 'name="Waiting" data-id="';
            echo $gamer['id'];
            echo '" value="Waiting" selected="">Ընթացքի մեջ</option>
                    <option ';
            if ($gamer['status'] == 'Canceled'){
                echo 'selected="selected"';
            }
            echo 'name="Canceled" data-id="';
            echo $gamer['id'];
            echo '" value="Canceled">չեղարկված</option>
                    <option ';
            if ($gamer['status'] == 'Finished'){
                echo 'selected="selected"';
            }
            echo 'name="Finished" data-id="';
            echo $gamer['id'];
            echo '" value="Finished">Ավարտած</option>
                  </select>';
            echo '</td>';

            echo '<td>';
            echo '<a class="Delete_user" data-id =' . $gamer['id'] . ' href="javascript:void(0)">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '
                        </tbody>
                    </table>
        ';

    }
    public function question_pagination($pagination)
    {
        $this->CheckLogin();
        $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `questions`");

        $AllUsersCount = mysqli_num_rows($AllUsers);
        $page = $pagination['pagination'] -1;
        $count = $page * 5;
        if ($AllUsersCount /5 <1){

            $pages = 1;
            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllUsersCount/5 == 1){
            $pages = $AllUsersCount/5;

            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT $count, 5 ")->fetch_all(true);

        }elseif ($AllUsersCount%5 <= 4){
            $pages = floor($AllUsersCount/5) + 1;
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


                    <p class="mt-3">Page: ' . $pagination['pagination'];

        echo '</p>
<p class="mt-3 m-3">All questions: ' . $AllUsersCount;
        echo '
                        <thead>
                        <tr>
                            <th>
                                #number
                            </th>
                            <th>
                                Question
                            </th>
                            <th>
                                Right answer
                            </th>
                            <th>
                                difficulty
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
            echo $gamer['question'];
            echo '</td>';

            echo '<td>';
            echo $gamer['right_answer'];
            echo '</td>';

            echo '<td>';
            echo $gamer['difficulty'];
            echo '</td>';

            echo '<td>';
            echo '<a href="/admin/questions/edit/' . $gamer['id'];
            echo '">Edit</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '
                        </tbody>
                    </table>
        ';
    }
    public function admins_pagination($pagination)
    {
        $ajax = $_GET;
        $role = $ajax['role'];
        $this->CheckLogin();
        if ($ajax['role'] == 'all'){
            $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users`");
        }else{

            $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role'");

        }
        $AllUsersCount = mysqli_num_rows($AllUsers);
        $page = $pagination['pagination'] -1;
        $count = $page * 5;
        if ($AllUsersCount /5 <1){

            $pages = 1;
            if ($ajax['role'] == 'all'){
                $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` LIMIT $count, 5 ")->fetch_all(true);
            }else{

                $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5 ")->fetch_all(true);

            }
        }elseif ($AllUsersCount/5 == 1){
            $pages = $AllUsersCount/5;

            if ($ajax['role'] == 'all'){
                $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users`LIMIT $count, 5 ")->fetch_all(true);
            }else{

                $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5  ")->fetch_all(true);

            }
        }elseif ($AllUsersCount%5 <= 4){
            $pages = floor($AllUsersCount/5) + 1;
            $a = $pagination['pagination'];
            if ($pages == $pagination['pagination']){
                if ($ajax['role'] == 'all'){
                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` LIMIT $count, 5 ")->fetch_all(true);
                }else{

                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5")->fetch_all(true);

                }
            }else{
                if ($ajax['role'] == 'all'){
                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` LIMIT $count, 5 ")->fetch_all(true);

                }else{

                    $AllUsers = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE Role = '$role' LIMIT $count, 5 ")->fetch_all(true);

                }
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


                    <p class="mt-3">Page: ' . $pagination['pagination'];

        echo '</p>
<p class="mt-3 m-3">All users: ' . $AllUsersCount;

        echo '</p></div>
                        <thead>
                        <tr>
                            <th>
                                #id
                            </th>
                            <th>
                                login
                            </th>
                            <th>
                                name
                            </th>
                            <th>
                                balance
                            </th>
                            <th>
                            role
</th>
                            <th>
                            Action
</th>
                        </tr>
                        </thead>
                        <tbody>';

        foreach ($AllUsers as $gamer) {
            echo '<tr>';
            echo '<td>';
            echo $gamer['id'];
            echo '</td>';

            echo '<td>';
            echo $gamer['login'];
            echo '</td>';

            echo '<td>';
            echo $gamer['name'];
            echo '</td>';

            echo '<td>';
            echo $gamer['balance'];
            echo '</td>';

            echo '<td>';
            echo $gamer['Role'];
            echo '</td>';

            echo '<td>';
            echo '<a href="/admin/user/edit/' . $gamer['id'];
            echo '">Edit</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '
                        </tbody>
                    </table>
        ';
    }
    public function create_question()
    {
        $this->CheckLogin();
        view("create_question", 'Admin' , [], "Admin");
    }
    public function edit_user($id){
        $id = $id['id'];
        echo $id;
        $this->CheckLogin();
        $user = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `id` = $id")->fetch_all(true);
        if ($user){
            view('edit_user','Admin', ['user'=>$user], 'Admin');
        }else{
            header('Location: /error404');
        }
    }
    public function edit_question($id)
    {
        $this->CheckLogin();
        $id = $id['id'];
        if (is_numeric($id)){
            $question = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
    //        $question = mysqli_num_rows($question);

            if ($question){
                view('edit_question', 'Admin', [
                    'question' => $question
                ], 'Admin');
            }
        }else{
            header("Location: /error404");
        }
    }
    public function documentation()
    {
        $this->CheckLogin();
        view("documentation", 'Admin' , '', "Admin");
    }
    public function gamers(){
        $this->CheckLogin();

        view("gamers", 'Admin' , [
            'Admin' => $_SESSION['admin_profile'],
        ], "Admin");
    }

    // Requests

    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->CheckLogin();
            unset($_SESSION['admin_profile']);
        }else{
            header("location: /admin/home");
        }
    }
    public function login_admin_request()
    {
        if (isset($_SESSION['admin_profile']['profile']) == 1) {
            header('location: /admin/home');
        }elseif (isset($_SESSION['user_profile']['profile']) == 1){
            header('location: /admin/home');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['admin_login'];
            $pass = $_POST['admin_password'];
            $_SESSION['login_values'] = $login;

            if ($login == '')
            {
                $ajax['error'] = 'something goes wrong';
                echo json_encode($ajax);
//                header("location: /admin/login");
            }elseif($pass == '')
            {
                $ajax['error'] = 'something goes wrong';
                echo json_encode($ajax);
//                header("location: /admin/login");
            }else{

                $pass = md5($pass);
                unset($_SESSION['login_error']);
                unset($_SESSION['login_values']);
                $profile = mysqli_query($this->admin->conn, "SELECT * FROM `admins` WHERE `login` = '$login' AND `password` = '$pass'");
                $profile =  mysqli_num_rows($profile);
                if ($profile == 1)
                {
                    unset($_SESSION['user_profile']);

                    $_SESSION['admin_profile'] = [
                        'profile' => 1,
                        'login' => $login,
                        'password' => $pass,
                    ];
                    $ajax['success'] = true;
                    echo json_encode($ajax);

                }
            }

        }else{
            header("location: /login");
        }
    }
    public function add_user_request(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if (array_search('',$_POST)){
                $ajax['error'] = 'please check form again';
                echo json_encode($ajax);
            }else{

                $login = $_POST['login'];
                $pass = $_POST['password'];
                $name = $_POST['name'];
                $sname = $_POST['sname'];
                $age = $_POST['age'];
                $role = $_POST['Role'];
                if($age < 18 || $age >= 100){

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
                }elseif ($role == ''){
                    $ajax['error'] = 'please check form again';
                    echo json_encode($ajax);
                }
                else{
                    $profile = mysqli_query($this->admin->conn, "SELECT * FROM `users` WHERE `login` = '$login'");

                    $profile =  mysqli_num_rows($profile);
                    if ($profile == 1){
                        $ajax['error'] = 'This name of user already exists';
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
        $this->CheckLogin();
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

        $this->CheckLogin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST){
                $id = $id['id'];
                $question = $_POST['question'];

                $wrong_answer_1 = $_POST['wrong_answer_1'];
                $wrong_answer_2 = $_POST['wrong_answer_2'];
                $wrong_answer_3 = $_POST['wrong_answer_3'];
                $right_answer = $_POST['right_answer'];
                $diff = $_POST['difficulty'];
                $active = $_POST['active'];
                $actives = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE active = 1");
                $actives = mysqli_num_rows($actives);

                if ($active == 0){
                    if ($actives <= 15 ){

                        echo 'You cant change active because you have only 15 active questions';
                        return false;
                    }
                    }
                }
            $wrongs = "$wrong_answer_1" . ',' . "$wrong_answer_2" . ',' . "$wrong_answer_3";
            if (!array_search('',$_POST)){

                mysqli_query($this->admin->conn, "UPDATE `questions` SET `question`= '$question', `right_answer`= '$right_answer', wrong_answer= '$wrongs', `difficulty`= '$diff' WHERE `id` = $id;");


                return true;
            }else{

                echo 'please fill all';
                return false;

            }
        }else{
        }
    }
    public function user_edit($id){

        $this->CheckLogin();
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
                echo "you cant change user, because it's you";
            } elseif ($admins <= 1 && $role = 'User'){
                echo 'you cant change admin, because admins count is 1';
            } elseif ($age < 18 || $age >105){
                echo 'age is not correct';
            }elseif (!array_search('',$_POST)){
                mysqli_query($this->admin->conn, "UPDATE `users` SET `name`= '$name', `sname`= '$sname',  `age`= '$age', `balance`= '$balance' WHERE `id` = $id;");


                return true;
            }else{

                echo 'please fill all';
                return false;

            }
        }else{
        }
    }
    public function question_create(){

        $this->CheckLogin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST){
                $question = $_POST['question'];
                $wrong_answer_1 = $_POST['wrong_answer_1'];
                $wrong_answer_2 = $_POST['wrong_answer_2'];
                $wrong_answer_3 = $_POST['wrong_answer_3'];
                $right_answer = $_POST['right_answer'];
                $diff = $_POST['difficulty'];
                $active = $_POST['Active'];
                $wrongs = "$wrong_answer_1" . ',' . "$wrong_answer_2" . ',' . "$wrong_answer_3";
                if (!array_search('',$_POST)){

                    mysqli_query($this->admin->conn, "INSERT INTO `questions`(`question`, `right_answer`, `wrong_answer`, `difficulty`, `active`) VALUES ('$question','$right_answer','$wrongs','$diff','$active');");

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
        $this->CheckLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $id['id'];
            if (is_numeric($id)) {

                $question = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` WHERE `id` = $id")->fetch_all(true);
                //        $question = mysqli_num_rows($question);
                $Val = $_POST['value'];
                if ($question) {
                    mysqli_query($this->admin->conn, "Update `gamers` SET `status` = '$Val' WHERE `id` = $id");
                }
                header("location: /admin/home");
            } else {
                header('location: /');
            }
        }
    }


    public function CheckLogin($is = null){
        if (isset($_SESSION['admin_profile']['profile'])) {
            if ($_SESSION['admin_profile']['profile']== 1 ){
                if ($is !== null) {
                    header('location: /');
                }else{

                }
            }

        }else{
            header('location: /');
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