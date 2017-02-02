<span style="color: gray; display: inline-block;margin-top: 10px; font-size: 26px;margin-bottom: 20px;">Публикации:</span>

<?php
foreach ($articles as $article) {
    echo "
<article>
    <a href='/articles/" . $article['id'] . "/' class='linko'>
        <header>
            <span>" . $article["title"] . "</span>
        </header>
    </a>
    <hr>
    <a href='/category/" . $article['category_id'] . "/' class='category'>" . $article['category_name'] . "</a>
    <section>
        <span>" . mb_substr($article["content"], 0, 650) . "</b></i></u></s></h1></h2></h3></url></span>
    </section>
    <footer class='footerArticle'>
        <span>" .
        rus_date($article['create_time'])
        . " | </span>  <a href='/account/" . $article['author'] . "/' class='author'>" . $article['author'] . "</a>

    </footer>
</article>
";
}

