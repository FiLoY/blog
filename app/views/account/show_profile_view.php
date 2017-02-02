<div class="topic"><span>Профиль</span></div>


<article class="show-profile">
    <div class="show-profile-image">
        <img src='<?php echo $user['photo']; ?>' class='user-icon-100'>
    </div>
    <div class="show-profile-info">
        <div class="show-profile-username"><?php echo $user['username']; ?></div>
        <div class="show-profile-fio"><?php echo $user['last_name'] . " " . $user['first_name'] . " " . $user['second_name']; ?></div>
        <div class="show-profile-gender">Пол: <?php echo $user['gender']; ?></div>
        <div class="show-profile-birth-date">Дата рождения: <?php echo $user['birth_date'] == '0000-00-00' ? '' : $user['birth_date']; ?></div>
    </div>
    <div class="show-profile-buttons">
        <input class="show-profile-button1" type="submit" value="Публикации: <?php echo $user['article_count']; ?>" name="save">
        <input type="submit" value="Комментарии: <?php echo $comment_count['comment_count']; ?>" name="save">
<!--        <a class="profile-logout" href="/account/logout/">Кнопка2</a>-->

    </div>

</article>
