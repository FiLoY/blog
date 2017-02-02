<?php
class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {
        Route::ErrorPage404();
    }

    function action_error_page()
    {
        $this->view->render('404_view.php', 'template_view.php');
    }
}