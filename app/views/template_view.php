<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script type="text/javascript" src="/js/jquery-2.2.3.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <title><?php echo $title; ?></title>
</head>
<body id="super-body">
<header>
    <nav class="pos hblock">
        <a href="/">Главная</a>
        <a href="/articles/">Статьи</a>
        <a href="/category/">Категории</a>
<!--        <a href="/contacts/">Контакты</a>-->
<!--        <a href="/learn_php/">Web-программирование</a>-->
<!--        <a href="/learn_html/">Для тестов</a>-->
        <?php if (isset($_SESSION['user'])) echo "<a href=\"/articles/create/\">Написать статью</a>"; ?>
    </nav>
    <?php
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user']['username'];
        $photo = $_SESSION['user']['photo'];
       echo "<a href = '/account/$username/'>
            <img src=$photo class='user-icon-30 user_top_block'>
            <span class='user_top_block'>$username</span>
            </a>";
    }
    else {
        echo '<a href = "/account/"><span>Вход</span></a>';
    }
    ?>


</header>
<section>
    <div class="pos bblock">
        <?php include 'app/views/'.$content_view; ?>
    </div>
</section>
<footer>
    <div class="pos fblock">
        <span>
            © <?php echo date('Y'); ?>  | 18+
        </span>
    </div>
</footer>
</body>
</html>

