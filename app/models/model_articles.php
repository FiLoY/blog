<?php
class Model_Article extends Model
{
    public $title;
    public $text;
    function __construct()
    {
 
    }
    function get_all_articles()
    {
        $connection_db = connect_db();

        $connection_query = $connection_db->query(" SELECT article.id,
                                            title,
                                            content,
                                            article.create_time,
                                            username as author,
                                            name as category_name,
                                            article_category.id as category_id
                                            FROM article 
                                            INNER JOIN
                                            user
                                            ON article.user_id = user.id
                                            INNER JOIN
                                            article_category
                                            ON 
                                            article_category.id = article.category_id
                                            ORDER BY article.create_time DESC");
        if (!$connection_query) die($connection_db->error);
        
        $rows = $connection_query->fetch_all(MYSQLI_ASSOC);

        $connection_query->close();
        $connection_db->close();
        return $rows;
    }

    function get_one_article($article_id)
    {
        $connection_db = connect_db();


        $connection_query = $connection_db->prepare("SELECT
                                                    article.id,
                                                    title,
                                                    content,
                                                    article.create_time,
                                                    username AS author,
                                                    name as category_name,
                                                    article_category.id as category_id
                                                    FROM article
                                                    INNER JOIN user
                                                    ON article.user_id = user.id
                                                    INNER JOIN article_category
                                                    ON article.category_id = article_category.id
                                                    WHERE article.id=?");
        $connection_query->bind_param("i", $article_id);
        $connection_query->execute();
        $result = $connection_query->get_result();
        $row = $result->fetch_assoc();


        $result->close();
        $connection_db->close();
        return $row;
    }

    function get_categories()
    {
        $connection_db = connect_db();

        $categories = $connection_db->query("SELECT * FROM article_category ORDER BY name");
        if (!$categories) die($connection_db->error);
        $rows = $categories->fetch_all(MYSQLI_ASSOC);

        $categories->close();
        $connection_db->close();
        return $rows;
    }

    function add_one_article($title, $category, $content, $user_id)
    {
        $connection_db = connect_db();
        $title = sanitizeString($title);
        $content = sanitizeString($content);
        $content = parser_text_with_BBCode_into_html($content);
        $connection_query = $connection_db->prepare("INSERT INTO article VALUES (DEFAULT, ?, \"пусто\", ?, (SELECT id FROM article_category WHERE name = ?), NULL, NULL, ?, NOW(), DEFAULT)");
        $connection_query->bind_param("sssi", $title, $content,$category, $user_id);
        $connection_query->execute();


        $connection_query->close();
        $connection_db->close();
    }

    function add_one_comment($user_id, $article_id, $text)
    {
        $text = sanitizeString($text);
        $connection_db = connect_db();
        $connection_query = $connection_db->prepare("INSERT INTO comment VALUES(DEFAULT, ?, ?, ?, NULL, NOW(), NULL)");
        $connection_query->bind_param("sss", $text, $user_id, $article_id);
        $connection_query->execute();


        $connection_query->close();
        $connection_db->close();
    }

    function get_comments($article_id)
    {
        $connection_db = connect_db();
        $connection_query = $connection_db->prepare("SELECT comment.*, user.id, username, photo FROM comment INNER JOIN user ON comment.user_id = user.id WHERE article_id = ? ORDER By comment.create_time DESC");
        $connection_query->bind_param("s", $article_id);
        $connection_query->execute();

        $comments = $connection_query->get_result()->fetch_all(MYSQLI_ASSOC);

        $connection_query->close();
        $connection_db->close();

        return $comments;

    }

    function  get_categories_and_counts()
    {
        
    $connection_db = connect_db();
        $connection_query = $connection_db->prepare("SELECT  COUNT(article.id) AS count, article_category.*
                                                    FROM article
                                                    RIGHT JOIN article_category
                                                    ON article.category_id = article_category.id
                                                    GROUP BY article_category.name
                                                    ORDER BY COUNT(article.id) DESC");
        $connection_query->execute();

        $category = $connection_query->get_result()->fetch_all(MYSQLI_ASSOC);

        $connection_query->close();
        $connection_db->close();

        return $category;
    }
}