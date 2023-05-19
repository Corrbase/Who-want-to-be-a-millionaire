<?php

class Route {


    public $settings;
    public function __construct( $settings)
    {

        if (!isset($_GET['url'])){
            $homepage = $settings['Homepage'];
            header("location: $homepage");
        }
        $this->settings = $settings;

    }


    private function simpleRoute($file, $route){


        //replacing first and last forward slashes
        //$_REQUEST['url'] will be empty if req uri is /

        if(!empty($_REQUEST['url'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUrl =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['url']);
        }else{
            $reqUrl = "/";
        }

        if($reqUrl == $route){
            $params = [];
            $file = explode('@', $file);

            if (file_exists('Controllers/' . $file[0] . '.php')){

                $Controller = $file[0];
                include "Controllers/" . $file[0] . '.php';
                $cont = new $Controller($this->settings);
                if (method_exists($cont, $file[1])){
                    $cont->{$file[1]}();
                }else{
                    dd("function is not exists");
                }
            }else{
                echo 'conroller is not exists';
                die();
            }
            die();
        }

    }

    function add($route,$file){



        //will store all the parameters value in this array
        $params = [];

        //will store all the parameters names in this array
        $paramKey = [];

        //finding if there is any {?} parameter in $route
        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        //if the route does not contain any param call simpleRoute();

        if(empty($paramMatches[0])){
            $this->simpleRoute($file,$route);
            return;
        }

        //setting parameters names
        foreach($paramMatches[0] as $key){
            $paramKey[] = $key;
        }


        //replacing first and last forward slashes
        //$_REQUEST['url'] will be empty if req uri is /

        if(!empty($_REQUEST['url'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUrl =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['url']);
        }else{
            $reqUrl = "/";
        }
        //exploding route address
        $uri = explode("/", $route);

        //will store index number where {?} parameter is required in the $route
        $indexNum = [];

        //storing index number, where {?} parameter is required with the help of regex
        foreach($uri as $index => $param){
            if(preg_match("/{.*}/", $param)){
                $indexNum[] = $index;
            }
        }

        //exploding request uri string to array to get
        //the exact index number value of parameter from $_REQUEST['url']
        $reqUrl = explode("/", $reqUrl);

        //running for each loop to set the exact index number with reg expression
        //this will help in matching route
        foreach($indexNum as $key => $index){

            //in case if req uri with param index is empty then return
            //because url is not valid for this route
            if(empty($reqUrl[$index])){
                return;
            }

            //setting params with params names
            $params[$paramKey[$key]] = $reqUrl[$index];

            //this is to create a regex for comparing route address
            $reqUrl[$index] = "{.*}";
        }

        //converting array to sting
        $reqUrl = implode("/",$reqUrl);

        //replace all / with \/ for reg expression
        //regex to match route is ready !
        $reqUrl = str_replace("/", '\\/', $reqUrl);

        //now matching route with regex
        if(preg_match("/$reqUrl/", $route))
        {

//            dd($indexNum);

            $arg_name = explode("/", $route);
            $arg = explode("/", $_REQUEST['url']);
            foreach ($indexNum as $item){
                $arg_name[$item] = trim($arg_name[$item], '{}');
                $args[$arg_name[$item]] =  trim($arg[$item], '{}'); ;

            }

            $file = explode('@', $file);
            if (file_exists('Controllers/' . $file[0] . '.php')){

                $Controller = $file[0];
                include "Controllers/" . $Controller . '.php';
                $cont = new $Controller($this->settings);
                if (method_exists($cont, $file[1])){
                    $cont->{$file[1]}($args);
                }else{
                    dd("function is not exists");
                }
            }else{
                echo 'controller is not exists';
                die();
            }
            die();
        }
    }
    public function notFound($file){
        include 'View/Errors/Error404.php';
        exit();
    }

}

function dd($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}

function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function model($name, $settings){
    include "./Models/$name" . '.php';
    return new $name($settings);
}

function view($name,$includes = null ,$view_array = null, $folder = null){

    foreach ($view_array as $item=>$key){
        $$item = $key;
    }
    if (isset($view_array['language'])){
        $language = $view_array['language'];
    }
    if (isset($view_array['header'])){
        $header = $view_array['header'];
    }
    if ($includes == null){
        include "View/Includes/Includes/main.php";
    }else{
        include "View/Includes/$includes includes/main.php";
    }


}

function render($data, $name){

        include "View/Render/$name.php";
}

function text($array, $language, $name){
    foreach ($array as $item => $val){
        if ($val['name'] == $name){
            return $val[$language];
        }
    }
}

function getLanguage(){
        $url = substr($_GET['url'], 0, 2);
        if ($url == 'en'){
            $language = 'en';
        }elseif ($url == 'hy'){
            $language = 'hy';
        }else{
            $language = 'none';
        }

        return $language;
    }
?>


