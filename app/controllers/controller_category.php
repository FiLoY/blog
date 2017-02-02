<?php
class Controller_Category extends Controller
{
    function __construct()
    {
        $this->model = new Model_Category();
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
                    case 1:
                        $this->action_one_category($requestAction);
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
        $data = $this->model->get_categories_and_counts();

            $this->view->render('category/category_view.php',
                'template_view.php',
                array('title' => 'Категории', 'articles' => $data)
            );
    }

    function action_one_category($category_id)
    {
        $category_name = $this->model->get_category_by_id($category_id);

        $data = $this->model->get_articles_from_category($category_id);

        $this->view->render('category/one_category_view.php',
            'template_view.php',
            array('title' => 'Категории', 'articles' => $data, 'category_name' => $category_name[0])
        );
    }
}