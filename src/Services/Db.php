<?php

namespace Services;

use Exception;
use Exceptions\DbException;
use PDO;
use PDOException;
use SQLite3;

class Db
{
    private static $instance;

    private PDO $pdo;
    const DB_NAME = 'users12.sqlite';
    const ERROR_PROP = 'Wrong property name';

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
                    auth_token TEXT,
                    datetime INTEGER)";
                if (!$this->pdo->exec($sql))
                    throw new Exception('Не могу создать таблицу');
            } catch (PDOException $e) {
                throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
            }
        }
    }

    /**
     * @throws DbException
     */
    /*private function __construct()
    {

        try {
            $this->pdo = new PDO('sqlite:users1.sqlite');
            $this->pdo->exec('SET NAMES UTF8');
        } catch (PDOException $e) {
            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
    }*/

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