<?php
class Route
{

    static private $urls = array();


    function __construct()
    {
        echo "I'm construct";
    }

    static function addUrl($url)
    {
        $parts = explode('/', $url);

        self::$urls[$parts[1]][] = ($parts[2] == '') ? 'index' : $parts[2];
    }

    static function start()
    {
        if(!isset($_SESSION))
            session_start();
        //default names of controller and action
        $controller_name = 'main';
        $action_name = 'index';



        //explode address
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        //route[1] - controller's name
        if (!empty($routes[1]))
            $controller_name = $routes[1];

        //route[2] - controller's action name
        if (!empty($routes[2]))
            $action_name = $routes[2];


        if (array_key_exists($controller_name, self::$urls)) {
            //take full file's name
            $full_model_name = 'model_'.$controller_name;
            $full_controller_name = 'controller_'.$controller_name;
            $full_action_name = 'action_'.$action_name;


            //looking file's paths and check this files
            $model_file = strtolower($full_model_name).'.php';
            $model_path = "app/models/".$model_file;
            if(file_exists($model_path))
                include "app/models/".$model_file;


            $controller_file = strtolower($full_controller_name).'.php';
            $controller_path = "app/controllers/".$controller_file;
            if(file_exists($controller_path))
                include "app/controllers/".$controller_file;
            else
                Route::ErrorPage404();

            // create controller
            $controller = new $full_controller_name;


            $action = 'action_index';

            if(method_exists($controller, $action))
            {
                // call controller's action
                $controller->$action(self::$urls[$controller_name], $action_name);
            }
            else
                Route::ErrorPage404();
        }
        else
            self::ErrorPage404();






    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location:'.$host.'404/');
    }
}