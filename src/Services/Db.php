<?php

declare(strict_types=1);

namespace Services;

use Exception;
use Exceptions\DbException;
use PDO;
use PDOException;

class Db
{
    private static $instance;

    private PDO $pdo;
    const DB_NAME = 'users12.sqlite';

    /**
     * @throws DbException
     * @throws Exception
     */
    function __construct()
    {
        $this->pdo = new PDO('sqlite:users12.sqlite');
        if (!filesize(self::DB_NAME)) {
            try {
                $sql = "CREATE TABLE users(
                    id INTEGER  PRIMARY KEY AUTO_INCREMENT  NOT NULL  UNIQUE,
                    nickname TEXT,
                    email TEXT,
                    password_hash TEXT,
                    age INTEGER,
                    auth_token TEXT)";
                if (!$this->pdo->exec($sql))
                    throw new Exception('Не могу создать таблицу');
            } catch (PDOException $e) {
                throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
            }
        } else{return true;}

    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(PDO::FETCH_CLASS, $className);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }
}