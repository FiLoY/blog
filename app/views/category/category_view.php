<span style="color: gray; display: inline-block;margin-top: 10px; font-size: 26px;margin-bottom: 20px;">Категории:</span>
<?php
foreach ($articles as $category) {
    extract($category);
    echo "
<a href='/category/$id/' class='linko'>
<article class='all-category'>
    <div class='category-name'>$name</div><div class='category-count'>$count</div>
</article></a>
        ";
}
