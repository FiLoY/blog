<?php
class Controller_Account extends Controller
{
    function __construct()
    {
        $this->model = new Model_Account();
        $this->view = new View();
    }

    function action_index($availableActions=null, $requestAction=null)
    {

        for ($i=0; $i < count($availableActions); $i++) {

            if (preg_match("[$availableActions[$i]]", $requestAction)) {
                switch ($i) {
                    case 0:
                        $this->action_login();
                        return;
                    case 1:
                        $this->action_login();
                        return;
                    case 2:
                        $this->action_signup();
                        return;
                    case 3:
                        $this->action_logout();
                        return;
                    case 4:
                        $this->action_profile();
                        return;
                    case 5:
                        $this->action_profile($requestAction);
                        return;
                    default:
                        Route::ErrorPage404();
                        return;
                }

            }

        }

        Route::ErrorPage404();

    }

    function action_login()
    {
        if (!isset($_SESSION['user'])) {
            if (!empty($_POST)) {
                if ($user = $this->model->check_user($_POST['username'], $_POST['password'])) {

                    $_SESSION['user'] = $user;

                    $this->view->render('message_view.php',
                        'template_view.php',
                        array('title'         => 'Авторизация',
                              'message_class' => 'success-message',
                              'message'       => 'Успешная авторизация')
                    );
                } else {
                    $this->view->render('message_view.php',
                        'template_view.php',
                        array('title'         => 'Авторизация',
                              'message_class' => 'error-message',
                              'message'       => 'Возникли ошибки')
                    );
                }

            } else {
                $this->view->render('account/login_view.php', 'template_view.php', array('title' => 'Авторизация'));
            }
        }
        else {
            $this->action_profile();
        }
    }

    function action_logout() {
        unset($_SESSION['user']);
        $this->view->render('message_view.php',
            'template_view.php',
            array('title' => 'Авторизация',
                  'message_class' => 'success-message',
                  'message' => 'Вы успешно вышли из аккаунта.')
        );
    }

    function action_signup()
    {
        if (!isset($_SESSION['user'])) {

            if (empty($_POST)) {
                $this->view->render('account/signup_view.php', 'template_view.php', array('title' => 'Регистрация'));
            } else {
                $err = array();
                $username = sanitizeString($_POST['username']);
                $password = sanitizeString($_POST['password']);
                $email = sanitizeString($_POST['email']);
                if ($this->model->get_user_by_username($username)) $err[] = "Данное имя пользователя уже используется, придумайте другое.";
                if (mb_strlen($username) <= 3 || mb_strlen($username) >= 25) $err[] = "Имя пользователя должно быть от 3х до 25 символов.";
                if (!preg_match('[^([a-zA-Z0-9]+)$]u', $username)) $err[] = "Имя пользователя должно содержать только a-zA-Z0-9 символы.";
                if (mb_strlen($password) <= 6 || mb_strlen($password) >= 30) $err[] = "Пароль должен быть от 6 до 30 символов.";
                if (mb_strlen($email) <= 5 || mb_strlen($email) >= 95) $err[] = "Email должен быть от 5 до 95 символов.";
                if (!preg_match('[^[a-zA-Z0-9._-]{1,20}@[a-zA-Z0-9]{1,10}.[a-zA-Z]{2,6}$]u', $email)) $err[] = "Вы ввели некорректный email.";
                if (empty($err)) {

                    $this->model->add_user($_POST['username'], $_POST['password'], $_POST['email']);


                    $this->view->render('message_view.php',
                        'template_view.php',
                        array('title'         => 'Регистрация',
                              'message_class' => 'success-message',
                              'message'       => 'Создание аккаунта прошло успешно!')
                    );
                    if ($user = $this->model->check_user($username, $password)) {
                        $_SESSION['user'] = $user;
                    }

                } else {


                    $this->view->render('message_view.php',
                        'template_view.php',
                        array('title'         => 'Регистрация',
                              'message_class' => 'error-message',
                              'message'       => 'В ходе создания аккаунта произошли ошибки:',
                              'err'           => $err)
                    );
                }
            }

        }
        else {
            $this->action_profile();
        }
    }

    function action_profile($username = null)
    {
        $user = $this->model->get_user_by_username($username);

        if ($user) {//can edit
            if (isset($_SESSION['user'])) {


                if ($_SESSION['user']['username'] == $username) {
                    if (empty($_POST['save'])) {
                        $this->view->render('account/setting_profile_view.php',
                            'template_view.php',
                            array('title' => 'Профиль',
                                  'user'  => $user,
                                  'edit'  => true));
                    } else {
                        $uploadfile = "";
                        $err = array();
                        // проверка вводимых данных
                        if (mb_strlen($_POST['last_name']) >= 100 || !preg_match('[^([а-яА-ЯЁё]*)$]u', $_POST['last_name']))
                            $err[] = "Фамилия должна не превышать 100 символов и должна содержать только а-яА-ЯЁё символы.";
                        if (mb_strlen($_POST['second_name']) >= 100 || !preg_match('[^([а-яА-ЯЁё]*)$]u', $_POST['second_name']))
                            $err[] = "Отчество должно не превышать 100 символов и должно содержать только а-яА-ЯЁё символы.";
                        if (mb_strlen($_POST['first_name']) >= 100 || !preg_match('[^([а-яА-ЯЁё]*)$]u', $_POST['first_name']))
                            $err[] = "Имя должно не превышать 100 символов и должно содержать только а-яА-ЯЁё символы.";
                        if ((!empty($_POST['year']) or !empty($_POST['month']) or !empty($_POST['day'])) and (empty($_POST['year']) or empty($_POST['month']) or empty($_POST['day'])))
                            $err[] = "Дата рождения не заполнена полностью.";
                        if (mb_strlen($_POST['about']) >= 1000)
                            $err[] = "Поле \"О себе\" должно не превышать 1000 символов.";

                        if (0 == $_FILES['photo']['error'] && ($_FILES['photo']['size'] >= 1024 * 1024 * 3 || !preg_match('[^image/]', $_FILES['photo']['type'])))
                            $err[] = "Фото не должно превышать размер 3мб и должно быть изображением.";
                        else {
                            $path = $_SERVER['DOCUMENT_ROOT'];
                            $photo_name = basename($_FILES['photo']['name']);
                            $photo_name_array = explode(".", $photo_name);
                            $uploadfile = "/images/avatars/" . $_SESSION['user']['username'] . "." . end($photo_name_array);//изменить на динам директорию//изменил чуть ниже
                            move_uploaded_file($_FILES['photo']['tmp_name'], "$path" . $uploadfile);
                        }

                        $birth_date = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
                        if (empty($err)) {
                            $uploadfile = empty($_FILES['photo']['error']) ? $uploadfile : $_SESSION['user']['photo'];
                            $this->model->update_user_info($_SESSION['user']['username'], $_POST['last_name'], $_POST['second_name'], $_POST['first_name'], $birth_date, $_POST['gender'], $_POST['about'], $uploadfile);
                            $this->view->render('message_view.php',
                                'template_view.php',
                                array('title'         => 'Профиль',
                                      'message_class' => 'success-message',
                                      'message'       => 'Данные успешно обновлены.')
                            );
                        }
                        else {
                            $this->view->render('message_view.php',
                                'template_view.php',
                                array('title'         => 'Профиль',
                                      'message_class' => 'error-message',
                                      'message'       => 'При изменинии данных возникли ошибки:',
                                      'err'           => $err)
                            );
                        }
                    }

                }
                else {//cant edit view

                    $this->view->render('account/show_profile_view.php',
                        'template_view.php',
                        array('title' => 'Профиль',
                              'user' => $user,
                              'edit' => false,
                              'comment_count' => $this->model->get_comment_count_from_username($username)));
                }
            }
            else {//cant edit view

                $this->view->render('account/show_profile_view.php',
                    'template_view.php',
                    array('title' => 'Профиль',
                          'user' => $user,
                          'edit' => false,
                          'comment_count' => $this->model->get_comment_count_from_username($username)));
            }
        }
        else {
            Route::ErrorPage404();
        }
    }

}