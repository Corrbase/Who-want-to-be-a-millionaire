<?php

class main
{
    public $urls;

    public function __construct($Routes, $settings)
    {
        $this->Route($Routes);
        $this->url($_GET['url'], $settings);
    }

    public function url($url, $settings)
    {
        if (!array_key_exists($url ,$this->urls)) {
            if ($settings['Error404'] == true){
                dd("main page");
            }
            dd('error 404');

        }else{
            $Route = $this->urls[$url];
            if (file_exists('Controllers/' . $Route['Controller'] . '.php')){

                $Controller = $Route['Controller'];
                include "Controllers/" . $Controller . '.php';
                $cont = new $Controller($settings);
                if (method_exists($cont, $Route['function'])){
                    $cont->{$Route['function']}();
                }else{
                    dd("error 404");
                }
            }
        }
    }

    public function Route($Routes)
    {
        $this->urls = $Routes;

    }

}

function dd($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}

function model($name, $settings){
    include "./Models/$name" . '.php';
    return new $name($settings);
}

function view($name, $array = null){
    $ViewArray = $array;
    include "View/Includes/main.php";

    return $ViewArray;
}





