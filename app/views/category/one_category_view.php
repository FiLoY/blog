<span style="color: gray; display: inline-block;margin-top: 10px; font-size: 26px;margin-bottom: 20px;"><?php echo $category_name; ?>:</span>

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
        <span>" . mb_substr($article["content"], 0, 650) . "</span>
    </section>
    <footer class='footerArticle'>
        <span>" .
        rus_date($article['create_time'])
        . " | </span>  <a href='/account/" . $article['author'] . "/' class='author'>" . $article['author'] . "</a>

    </footer>
</article>
";
}
