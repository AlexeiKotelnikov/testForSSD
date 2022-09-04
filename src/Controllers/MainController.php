<?php

declare(strict_types=1);

namespace Controllers;

use Models\Users\User;
use Models\Users\UsersAuthService;
use View\View;

class MainController
{
    private View $view;
    private User|null $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../templates');
        $this->view->setVar('user', $this->user);
    }

    public function main(): void
    {
        $this->view->renderHtml('main/main.php', [
            'user' => UsersAuthService::getUserByToken()
        ]);
    }
}