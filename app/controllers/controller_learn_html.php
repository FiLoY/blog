<?php
class Controller_Learn_html extends Controller
{
    function action_index()
    {
        $this->view->render('learn_html_view.php', 'template_view.php', array('title' => 'бла бла бла'));
    }
}