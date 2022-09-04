<?php
//'~^users/register/$~' - слеш в конце убрать
return [
    '~^users/register/$~' => [\Controllers\UsersController::class, 'signUp'],
    '~^$~' => [\Controllers\MainController::class, 'main']
];