<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Тестовое задание
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <?= !empty($user) ? 'Привет, ' . $user->getNickname() : 'Войдите на сайт' ?>
        </td>
    </tr>
    <tr>
        <td>
            <p>Инфо о пользователе</p>
            <ul>
                <li><?= !empty($user) ? 'Ваш email: ' . $user->getEmail() : '' ?></li>
                <li><?= !empty($user) ? 'Ваш возраст: ' . $user->getAge() : '' ?></li>
                <li><?= !empty($user) ? 'Ваш nickname: ' . $user->getNickname() : '' ?></li>
                <?php if (!empty($user) && ($user->getAge() < 18)): ?>
                    <h2>Только Здесь и Сейчас - Акция на вейпы!</h2>
                <?php elseif (!empty($user) && ($user->getAge() > 50)): ?>
                    <h2>Замечательные путевки в санаторий "Все тлен"</h2>
                <?php else : ?>
                    <h2>Для вас, к сожалению, у нас предложений нет :(</h2>
                <?php endif; ?>
            </ul>

        </td>

        <td width="300px" class="sidebar">
            <div class="sidebarHeader">Меню</div>
            <ul>
                <?php if (empty($user)): ?>
                    <li><a href="<?= BASE_URL ?>">Главная страница</a></li>
                    <li><a href="<?= BASE_URL ?>/users/login">Вход</a></li>
                    <li><a href="<?= BASE_URL ?>/users/register">Регистрация</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>">Главная страница</a></li>
                    <li><a href="<?= BASE_URL ?>/users/logout">Выход</a></li>
                <?php endif; ?>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="footer" colspan="2">Все права защищены (c) Мое тестовое</td>
    </tr>
</table>

</body>
</html>