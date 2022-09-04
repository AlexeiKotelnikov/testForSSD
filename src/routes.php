<?php
//'~^users/register/$~' - слеш в конце убрать
return [
    '~^users/register$~' => [Controllers\UsersController::class, 'signUp'],
    '~^users/login$~' => [Controllers\UsersController::class, 'login'],
    '~^users/logout$~' => [Controllers\UsersController::class, 'logout'],
    '~^$~' => [\Controllers\MainController::class, 'main']
];