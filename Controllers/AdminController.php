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
            'Admin' => $_SESSION['profile'],
        ], "Admin");
    }
    public function login(){
        $this->CheckLogin();
        view("login", null, '', 'HomePages');

    }
    public function questions()
    {

        $this->CheckLogin();

        view("questions", 'Admin' , [
            'Admin' => $_SESSION['profile'],
        ], "Admin");
    }
    public function pagination($pagination)
    {
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
    public function edit_question($id)
    {
        $id = $id['id'];
        $question = mysqli_query($this->admin->conn, "SELECT * FROM `questions` WHERE `id` = $id")->fetch_all(true);
//        $question = mysqli_num_rows($question);

        if ($question){
            view('edit_question', 'Admin', [
                'question' => $question
            ], 'Admin');
        }
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
                $profile = mysqli_query($this->admin->conn, "SELECT * FROM `admins` WHERE `login` = '$login'");
                $profile =  mysqli_num_rows($profile);
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
    public function delete_user($user){
        $this->CheckLogin();
        $id = $user['id'];
        if (!is_numeric($id)){
            echo 'id is not number';
        }
        $gamer = mysqli_query($this->admin->conn, "SELECT * FROM `gamers` WHERE `id` = $id")->fetch_all(true);

        if (sizeof($gamer) == 0){
            echo 'user is not find';
        }

        $result = mysqli_query($this->admin->conn, "DELETE FROM `gamers` WHERE `id` = $id");

        header("location: /admin/home");

    }
    public function question_edit($id){

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

                return true;
            }else{
                setcookie('edit_error', 'Please fill all', time() + 1, '/') ;
                echo 0;
                return false;
            }
        }
    }


    public function CheckLogin(){
        if (isset($_SESSION['profile']['profile']))
        {
            if (isset($_SESSION['profile']['profile']) == 1)
            {

            }else{
                header("location: /admin/login");
            }
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