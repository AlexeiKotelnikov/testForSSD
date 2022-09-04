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
        <td>
            <p>Ну очень важная информация</p>
        </td>

        <td width="300px" class="sidebar">
            <div class="sidebarHeader">Меню</div>
            <ul>
                <li><a href="<?= BASE_URL ?>">Главная страница</a></li>
                <li><a href="<?= BASE_URL ?>/users/register/">Регистрация</a></li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="footer" colspan="2">Все права защищены (c) Мое тестовое</td>
    </tr>
</table>

</body>
</html>