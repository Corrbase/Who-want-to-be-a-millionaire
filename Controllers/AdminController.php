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

        view("admin", 'Admin' , [
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
    public function question_pagination($pagination)
    {
        $this->CheckLogin();
        $AllQusetions = mysqli_query($this->admin->conn, "SELECT * FROM `questions`");
        $AllQusetions = mysqli_num_rows($AllQusetions);
        $PreviousPage = $pagination['pagination'] - 1;
        $NextPage = $pagination['pagination'] + 1;
        if ($pagination['pagination'] == 1){
            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT 10")->fetch_all(true);
        }elseif($pagination['pagination'] > ceil($AllQusetions / 10)) {
            dd('Ups');
        }
            else{
            $page = ($pagination['pagination'] * 5) ;

            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `questions` LIMIT 10 OFFSET $page")->fetch_all(true);
            $NextPage = ceil($AllQusetions);
        }
        if ($NextPage > ceil($AllQusetions / 10)){
            $NextPage = ceil($AllQusetions / 10);
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
                                Question
                            </th>
                            <th>
                                Right answer
                            </th>
                            <th>
                                answer price
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
            echo $gamer['number'];
            echo '</td>';

            echo '<td>';
            echo $gamer['question'];
            echo '</td>';

            echo '<td>';
            echo $gamer['right_answer'];
            echo '</td>';

            echo '<td>';
            echo $gamer['price'];
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
    public function gamers_pagination($pagination)
    {
        $this->CheckLogin();
        $AllQusetions = mysqli_query($this->admin->conn, "SELECT * FROM `gamers`");
        $AllQusetions = mysqli_num_rows($AllQusetions);
        $PreviousPage = $pagination['pagination'] - 1;
        $NextPage = $pagination['pagination'] + 1;
        if ($pagination['pagination'] == 1){
            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT 10")->fetch_all(true);
        }elseif($pagination['pagination'] > ceil($AllQusetions / 10)) {
            dd('Ups');
        }
            else{
            $page = ($pagination['pagination'] * 5) ;

            $questions = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` LIMIT 10 OFFSET $page")->fetch_all(true);
            $NextPage = ceil($AllQusetions);
        }
        if ($NextPage > ceil($AllQusetions / 10)){
            $NextPage = ceil($AllQusetions / 10);
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
            echo '<select class="status-change form-select form-select-sm">
                    <option selected="" disabled="">Select a status:</option>

                    <option ';
            if ($gamer['status'] == 'Waiting'){
                echo 'selected="selected"';
            }
            echo 'name="Waiting" data-id="';
            echo $gamer['id'];
            echo '" value="Waiting" selected="">Waiting</option>
                    <option ';
            if ($gamer['status'] == 'Canceled'){
                echo 'selected="selected"';
            }
            echo 'name="Canceled" data-id="';
            echo $gamer['id'];
            echo '" value="Canceled">Canceled</option>
                    <option ';
            if ($gamer['status'] == 'Finished'){
                echo 'selected="selected"';
            }
            echo 'name="Finished" data-id="';
            echo $gamer['id'];
            echo '" value="Finished">Finished</option>
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
            header("Location: /");
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
                $wrongs = "$wrong_answer_1" . ',' . "$wrong_answer_2" . ',' . "$wrong_answer_3";
                if (!array_search('',$_POST)){

                    mysqli_query($this->admin->conn, "UPDATE `questions` SET `question`= '$question', `right_answer`= '$right_answer', wrong_answer= '$wrongs', `difficulty`= '$diff' WHERE `id` = $id;");
                    header("location: /admin/home");

                    return true;
                }else{

                    echo 0;
                    header("location: /admin/home");
                    return false;
                }
            }
        }else{
            header("location: /admin/home");
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
            if (isset($_SESSION['admin_profile']['profile']) == 1) {
                if ($is !== null) {
                    header('location: /');
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