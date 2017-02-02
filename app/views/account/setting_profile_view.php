<div class="topic"><span>Профиль</span></div>


<article class="profile">
    <form action="/account/<?php echo $_SESSION['user']['username']; ?>/" method="post" enctype="multipart/form-data">
        <div class="profile-image">
            <img id="bestava" src='<?php echo $user['photo']; ?>' class='user-icon-100'>
<!--            <input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px" multiple  onchange="alert();">-->
        </div>
        <div class="profile-info">
            <label><span>Имя пользователя:</span>
                <input type="text" value="<?php echo $user['username']; ?>" readonly name="username">
            </label>
            <label><span>Фамилия:</span>
                <input type="text" value="<?php echo $user['last_name']; ?>" name="last_name">
            </label>
            <label><span>Отчество:</span>
                <input type="text" value="<?php echo $user['second_name']; ?>" name="second_name">
            </label>
            <label><span>Имя:</span>
                <input type="text" value="<?php echo $user['first_name']; ?>" name="first_name">
            </label>
            <label><span>Дата рождения:</span>
                <div class="profile-birth_date">
                    <?php
                    $date = explode('-', $user['birth_date']);
                    $full_month_array = [1 => 'Января',
                                         2 => 'Февраля',
                                         3 => 'Марта',
                                         4 => 'Апреля',
                                         5 => 'Мая',
                                         6 => 'Июня',
                                         7 => 'Июля',
                                         8 => 'Августа',
                                         9 => 'Сентября',
                                         10 => 'Октября',
                                         11 => 'Ноября',
                                         12 => 'Декабря'];

                    $days_html = array();
                    $month_html = array();
                    $years_html = array();

                    if (empty($user['birth_date'])) {
                        $days_html[] = "<option selected value=''>Число</option>";
                        for ($i = 1;$i <= 31;$i++)
                            $days_html[] = "<option  value='$i'>$i</option>";

                        $month_html[] = "<option selected value=''>Месяц</option>";
                        for ($i = 1;$i <= 12;$i++)
                            $month_html[] = "<option  value='$i'>$full_month_array[$i]</option>";

                        $years_html[] = "<option selected value=''>Год</option>";
                        for ($i = date('Y')-150;$i <= date('Y')-18;$i++)
                            $years_html[] = "<option  value='$i'>$i</option>";
                    }
                    else {
                        $days_html[] = "<option  value=''>Число</option>";
                        for ($i = 1;$i <= 31;$i++)
                            $days_html[] = $i == $date[2] ? "<option selected value='$i'>$i</option>" : "<option value='$i'>$i</option>";

                        $month_html[] = "<option  value=''>Месяц</option>";
                        for ($i = 1;$i <= 12;$i++)
                            $month_html[] = $i == $date[1] ? "<option selected value='$i'>$full_month_array[$i]</option>" : "<option value='$i'>$full_month_array[$i]</option>";

                        $years_html[] = "<option  value=''>Год</option>";
                        for ($i = date('Y')-150;$i <= date('Y')-18;$i++)
                            $years_html[] = $i == $date[0] ? "<option selected value='$i'>$i</option>" : "<option value='$i'>$i</option>";
                    }

                    ?>
                    <select name="day">
                        <?php
                        foreach ($days_html as $day) echo $day;
                        ?>
                    </select>
                    <select name="month">
                        <?php
                        foreach ($month_html as $month) echo $month;
                        ?>
                    </select>
                    <select name="year">
                        <?php
                        foreach ($years_html as $year) echo $year;
                        ?>
                    </select>
                </div>
            </label>
            <label><span>Пол:</span>
                <select name="gender">

                        <option  <?php if ($user['gender'] != 'МУЖСКОЙ' && $user['gender'] != 'ЖЕНСКИЙ') echo 'selected'; ?> value="">Не определился</option>
                        <option <?php if ($user['gender'] == 'МУЖСКОЙ') echo 'selected'; ?> value="Мужской">Мужской</option>

                        <option <?php if ($user['gender'] == 'ЖЕНСКИЙ') echo 'selected'; ?> value="Женский">Женский</option>



                </select>
            </label>
            <label><span>Фото:</span>
                <input type="file" name="photo" class="load-photo">
            </label>
            <label><span>О себе:</span>
                <textarea name="about"><?php echo $user['about']; ?></textarea>
            </label>
        </div>
        <footer>
            <input type="submit" value="Сохранить" name="save">
            <a class="profile-logout" href="/account/logout/">Выйти из аккаунта</a>
        </footer>
    </form>
</article>
