<?php

declare(strict_types=1);

namespace Controllers;

use Exceptions\InvalidArgumentException;
use Models\Users\User;
use Models\Users\UsersAuthService;

class UsersController extends AbstractController
{

    public function signUp(): void
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }

    public function login(): void
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: ' . BASE_URL );
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('users/login.php');
    }
}