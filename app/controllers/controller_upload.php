<?php
class Controller_Upload extends Controller
{
    function __construct()
    {
//        $this->model = new Model_Category();
        $this->view = new View();
    }


    function action_index($availableActions = null, $requestAction = null)
    {

        for ($i = 0; $i < count($availableActions); $i++) {

            if (preg_match("[$availableActions[$i]]", $requestAction)) {
                switch ($i) {
                    case 0:
                        $this->action_all();
                        return;
                    default:
                        Route::ErrorPage404();
                        return;
                }

            }

        }

        Route::ErrorPage404();

    }

    function action_all() 
    {
        $this->view->render('upload_view.php',
            'template_view.php',
            array('title' => 'Загрузка картинок')
        );
    }
}