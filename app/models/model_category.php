<?php
class Model_Category extends Model
{
    public $title;
    public $text;

    function __construct()
    {

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

    function get_articles_from_category($category_id)
    {
        $connection_db = connect_db();

        $connection_query = $connection_db->prepare(" SELECT
                                                  article.id,
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
                                                  WHERE article_category.id = ?
                                                ORDER BY article.create_time DESC");
        $connection_query->bind_param("i", $category_id);
        $connection_query->execute();

        if (!$connection_query) die($connection_db->error);

        $rows = $connection_query->get_result()->fetch_all(MYSQLI_ASSOC);

        $connection_query->close();
        $connection_db->close();
        return $rows;
    }
    
    function get_category_by_id($category_id) 
    {
        $connection_db = connect_db();

        $connection_query = $connection_db->prepare("SELECT name FROM article_category WHERE id = ?");
        $connection_query->bind_param("i", $category_id);
        $connection_query->execute();

        if (!$connection_query) die($connection_db->error);

        $rows = $connection_query->get_result()->fetch_row();

        $connection_query->close();
        $connection_db->close();
        return $rows;
    }
}