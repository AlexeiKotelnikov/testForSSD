<?php
if (!empty($user)) {
    header('Location:' . BASE_URL);
    exit();
}
?>
<div style="text-align: center">
    <h1>Регистрация</h1>
    <?php if (!empty($error)): ?>
        <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
    <?php endif; ?>
    <form action="<?= BASE_URL ?>/users/register" method="post">
        <label>Nickname <input type="text" name="nickname" value="<?= $_POST['nickname'] ?? '' ?>"></label>
        <br><br>
        <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
        <br><br>
        <label>Password <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
        <br><br>
        <label>Age<input type="text" name="age" value="<?= $_POST['age'] ?? '' ?>"></label>
        <br><br>
        <input type="submit" value="Register">
    </form>
    <a href="<?= BASE_URL ?>">Главная страница</a>
</div>
