<?php
class View
{
    public $template_view; // здесь можно указать общий вид по умолчанию.

    function render($content_view, $template_view, $data = null)
    {

        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        $template_view = 'template_view.php';
        include 'app/views/'.$template_view;

    }
}