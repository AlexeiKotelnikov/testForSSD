<?php

declare(strict_types=1);

namespace Controllers;

use Exceptions\InvalidArgumentException;
use Models\Users\User;
use View\View;

class UsersController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
    }

    public function signUp(): void
    {
        try {
            $user = User::signUp($_POST);
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
            return;
        }

        $this->view->renderHtml('users/signUp.php');
    }
}