<?php

class main
{
    public $urls;

    public function __construct($Routes, $settings)
    {
        $this->Route($Routes);

        if (isset($_GET['url'])){
            $this->url($_GET['url'], $settings);
        }else{

            $homepage = $settings['Homepage'];
            header("location: $homepage");
        }
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

function view($name, $view_array = null, $folder = null){

    include "View/Admin includes/main.php";

}





