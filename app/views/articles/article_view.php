<?php

echo "
<article class=\"full-article\">
    <header>
        <span>" . $title . "</span>
    </header>
    <hr>
    <a href='/category/$category_id/' class='category'>" . $category_name . "</a>
    <section>
        <span>" . $content . "</b></i></u></s></h1></h2></h3></url></span>
    </section>
    <footer class='footerArticle'>
        <span>" .
        rus_date($create_time)
        . " | </span>  <a href='/account/" . $author . "/' class='author'>" . $author . "</a>

    </footer>
</article>";
?>
<hr>
<span style="color: gray; display: inline-block;margin-top: 5px; font-size: 26px;margin-bottom: 5px;">Комментарии:</span>


<article class="full-article create-comment">
<?php
        $path = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['user']))
        echo "
        <form action='$path' method='post'>
        <textarea name='comment_text'  placeholder='Введите ваш комментарий.'></textarea>
        <input type='submit' name='submit' value='Написать'>
        </form>
        
        ";
else
        echo "<div><a href=\"/account/\">Войдите</a>, чтобы оставить свой комментарий.</div>";
?>
</article>

<?php

foreach ($data[0] as $comment) {
    $photo = $comment['photo'];
    $comment_user = $comment['username'];
    $comment_content = $comment['content'];
    $comment_date = rus_date($comment['create_time']);

        echo "<article class='comment'>
        <div class=\"comment-block\">
                <div class=\"comment-user-info\">
                        <img src='$photo' class='user-icon-50'>
                        <a href='/account/$comment_user' class='author'>$comment_user</a>
                </div>
                <div class=\"comment-user-text\">$comment_content
                </div>
                <div class=\"comment-date\">$comment_date</div>
        </div>
</article>";
}

?>



