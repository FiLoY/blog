<?php
class Controller_Articles extends Controller
{
    function __construct()
    {
        $this->model = new Model_Article();
        $this->view = new View();
    }


    function action_index($availableActions=null, $requestAction=null)
    {
        
        for ($i=0; $i < count($availableActions); $i++) {

            if (preg_match("[$availableActions[$i]]", $requestAction)) {
                switch ($i) {
                    case 0:
                        $this->action_all();
                        return;
                    case 1:
                        $this->action_all();
                        return;
                    case 2:
                        $this->action_one_article($requestAction);
                        return;
                    case 3:
                        $this->action_create();
                        return;
                    case 4:
                        $this->action_category();
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
        $data = $this->model->get_all_articles();
        $this->view->render('articles/articles_view.php',
                            'template_view.php',
                            array('title' => 'Статьи', 'articles' => $data)
                            );
    }

    function action_one_article($article_id) {

        $data = $this->model->get_one_article($article_id);
        $data[] = $this->model->get_comments($article_id);
        if ($data) {
            if (!empty($_POST)) {
                if (empty(sanitizeString($_POST["comment_text"]))) {
                    $this->view->render('articles/article_view.php',
                        'template_view.php',
                        $data
                    );
                }
                else {
                    $this->model->add_one_comment($_SESSION['user']['id'], $article_id, $_POST['comment_text']);
                    header("Location: http://filoy.ru/articles/$article_id");

                }
            }
            else {
                $this->view->render('articles/article_view.php',
                    'template_view.php',
                    $data
                );
            }
        }
        else
            Route::ErrorPage404();

    }


    function action_create() {

        // Загрузка категорий
        $html_categories = '';
        $data = $this->model->get_categories();
        foreach ($data as $category) {
            $category_name = $category['name'];
            $html_categories .= "<li onclick=\"document.getElementById('create-article-form-search').value = this.innerHTML;\">" . $category_name . "</li>";
        }

        if (empty($_POST)) {
            // Отображение формы
            $this->view->render('articles/create_article_view.php',
                'template_view.php',
                array('title' => 'Создание статьи',
                      'categories' => $html_categories,
                      'article_title' => '',
                      'spec_var' => rand(100000,99999999),
                      'flag' => false,
                      'content' => '',
                      'category' => '')
            );
        }
        else {
            // Что-то делаем при отправки формы
            // Проверка нажатия кнопки
            if (isset($_POST['publish_button'])) {
                // Проверка заполненных данных
                $title = sanitizeString($_POST['title']);
                $category = sanitizeString($_POST['category']);
                $content = sanitizeString($_POST['content']);
                
                if (!empty($title) && !empty($category) && !empty($content)) {

                    $this->model->add_one_article($_POST['title'], $_POST['category'], $_POST['content'], $_SESSION['user']['id']);


                    $this->view->render('message_view.php',
                        'template_view.php',
                        array('title' => 'Создание статьи',
                              'message_class' => 'success-message',
                              'message' => 'Статья добавлена')
                    );

                } else {
                    $this->view->render('message_view.php',
                        'template_view.php',
                        array('title' => 'Создание статьи',
                              'message_class' => 'error-message',
                              'message' => 'Статья не добавлена')
                    );
                }

            }
            elseif (isset($_POST['preview_button'])) {
                $this->view->render('articles/create_article_view.php',
                    'template_view.php',
                    array('title' => 'Создание статьи',
                          'categories' => $html_categories,
                          'article_title' => $_POST['title'],
                          'spec_var' => rand(100000, 99999999),
                          'flag' => true,
                          'content' => $_POST['content'],
                          'category' => $_POST['category'])
                );
            }
            
        }

    }
    
    function action_category() {
        
        $data = $this->model->get_categories_and_counts();

        if ($category_id) {
            $this->view->render('articles/category_view.php',
                'template_view.php',
                array('title' => 'Категории', 'articles' => $data)
            );
        }
    }
}