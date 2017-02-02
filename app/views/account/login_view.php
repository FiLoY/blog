<div class="topic">
    <span>Авторизация</span>
</div>

<article class="login">
    <header></header>
    <section>
        <form class="form-login" action="/account/" method="post">
            <label for="login">Имя пользователя:</label>
            <input type="text" name="username" id="login">
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password">
            <div class="form-login-buttons">
                <input type="submit" value="Войти">
                <a href="/account/signup/" class="form-login-button-signup">Создать аккаунт</a>
            </div>
        </form>
    </section>
</article>