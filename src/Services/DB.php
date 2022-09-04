<?php

namespace Services;

use Exception;
use Exceptions\DbException;
use PDO;
use PDOException;
use SQLite3;

class DB
{
    private static $instance;

    private PDO $pdo;
    const DB_NAME = 'users1.sqlite';
    const ERROR_PROP = 'Wrong property name';
    private SQLite3 $_db;

    function __construct()
    {
        $this->_db = new SQLite3(self::DB_NAME);
        if (!filesize(self::DB_NAME)) {
            try {
                $sql = "CREATE TABLE users(
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL  UNIQUE,
                    name TEXT,
                    email TEXT,
                    password TEXT,
                    password_hash TEXT,
                    age INTEGER,
                    auth_token TEXT,
                    datetime INTEGER)";
                if (!$this->_db->exec($sql))
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