<?php
class Model_Account extends Model
{
    public $title;
    public $text;
    function __construct()
    {
        $wtf = "@jkhjkhdff_323ujkljkljkljl4flknm4m3i";
    }
    function add_user($username, $password, $email)
    {
        $connection_db = connect_db();
        $username = sanitizeString($username);
        $password = sanitizeString($password);
        $email = sanitizeString($email);


        $password = password_hash($password, PASSWORD_BCRYPT);

        $connection_query = $connection_db->prepare("INSERT INTO user VALUES (DEFAULT, ?, ?, ?, 3, NOW(), DEFAULT, NULL, NULL, NULL, NULL, NULL, NULL, DEFAULT)");
        $connection_query->bind_param("sss", $username, $password, $email);
        $connection_query->execute();

        $connection_query->close();
        $connection_db->close();
    }

    function check_user($username, $password)
    {
        $username = sanitizeString($username);
        $password = sanitizeString($password);

        $row = $this->get_user_by_username($username); //$connection_query->fetch();



        $verify = password_verify($password, $row['password']);

//        $connection_query->close();

        if ($verify)
            return $row;
        else
            return false;

    }

    function get_user_by_username($username)
    {
        $connection_db = connect_db();
        $connection_query = $connection_db->prepare("SELECT
                                                    user.*,
                                                    COUNT(article.id) as article_count
                                                    FROM
                                                    user
                                                    LEFT JOIN article
                                                    ON user.id = article.user_id
                                                    WHERE
                                                    username = ? GROUP BY user.id");
        $connection_query->bind_param("s", $username);
        $connection_query->execute();

        $user = $connection_query->get_result()->fetch_assoc();
        
        $connection_query->close();
        $connection_db->close();
        return $user;
    }

    function update_user_info($username, $last_name, $second_name, $first_name,$birth_date, $gender, $about, $photo)
    {
        $connection_db = connect_db();
        $connection_query = $connection_db->prepare("UPDATE user SET last_name = ?, second_name = ?, first_name = ?, birth_date = ?, gender = ?, about = ?, photo = ?, update_time = NOW() WHERE username = ?");
        $connection_query->bind_param("ssssssss", $last_name, $second_name, $first_name, $birth_date, $gender, $about, $photo, $username);
        $connection_query->execute();

        $connection_query->close();
        $connection_db->close();
    }


    function get_comment_count_from_username($username) 
    {
        $connection_db = connect_db();
        $connection_query = $connection_db->prepare("SELECT
                                                    COUNT(comment.id) as comment_count
                                                    FROM
                                                    user
                                                    LEFT JOIN comment
                                                    ON user.id = comment.user_id
                                                    WHERE
                                                    username = ?");
        $connection_query->bind_param("s", $username);
        $connection_query->execute();

        $comment_count = $connection_query->get_result()->fetch_assoc();

        $connection_query->close();
        $connection_db->close();
        return $comment_count;
    }
}