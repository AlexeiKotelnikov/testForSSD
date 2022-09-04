<div style="text-align: center;">
    <h1>Вход</h1>
    <?php if (!empty($error)): ?>
        <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
    <?php endif; ?>
    <form action="<?= BASE_URL ?>/users/login" method="post">
        <label>Nickname <input type="text" name="nickname" value="<?= $_POST['nickname'] ?? '' ?>"></label>
        <br><br>
        <label>Password <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
        <br><br>
        <input type="submit" value="Войти">
    </form>
    <a href="<?= BASE_URL ?>/users/register">Регистрация</a>
</div>