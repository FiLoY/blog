<?php
class Controller_Learn_php extends Controller
{
    function action_index()
    {
        $this->view->render('learn_php_view.php', 'template_view.php', array('title' => 'Web-программирование'));
    }
}