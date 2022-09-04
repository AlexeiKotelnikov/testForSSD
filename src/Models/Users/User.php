<?php

declare(strict_types=1);

namespace Models\Users;

use Exception;
use Exceptions\InvalidArgumentException;
use Models\DataBase\ActiveRecordEntity;

class User extends ActiveRecordEntity
{

    protected string $nickname;

    protected string $email;


    protected string $passwordHash;

    protected string $authToken;

    protected int $age;


    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public static function signUp(array $userData): User
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }

        if (!preg_match('/^[a-zA-Z\d]+$/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
        }

        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }

        if (empty($userData['age'])) {
            throw new InvalidArgumentException('Не передан возраст');
        }

        if (!preg_match('/^[1-9]\d*$/', $userData['age'])) {
            throw new InvalidArgumentException('Возраст может состоять только из положительных цифр');
        }

        if (static::findOneByColumn('nickname', $userData['nickname']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким Nickname уже существует');
        }

        if (static::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }

        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->age = (int)$userData['age'];
        $user->save();

        return $user;
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public static function login(array $loginData): User
    {
        if (empty($loginData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        $user = User::findOneByColumn('nickname', $loginData['nickname']);
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким nickname');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        $user->refreshAuthToken();
        $token = $user->getAuthToken();
        $a = ['auth_token' => $token];
        $user->update($a);

        return $user;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @throws Exception
     */
    private function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    protected static function getTableName(): string
    {
        return 'users';
    }
}