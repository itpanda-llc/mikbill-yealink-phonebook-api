<?php

/**
 * Файл из репозитория MikBill-PhoneBook-API
 * @link https://github.com/itpanda-llc/mikbill-phonebook-api
 */

declare(strict_types=1);

namespace Panda\MikBill\PhoneBookApi;

/**
 * Class Db
 * @package Panda\MikBill\PhoneBookApi
 * Соединение с БД
 */
class Db
{
    /**
     * @var \PDO Обработчик запросов к БД
     */
    private static $dbh;

    /**
     * @return \PDO Обработчик запросов к БД
     */
    public static function connect(): \PDO
    {
        if (!isset(self::$dbh)) {
            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8",
                (string) Config::get()->parameters->mysql->host,
                (string) Config::get()->parameters->mysql->dbname);

            try {
                self::$dbh = new \PDO($dsn,
                    (string) Config::get()->parameters->mysql->username,
                    (string) Config::get()->parameters->mysql->password,
                    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
            } catch (\PDOException $e) {
                throw new Exception\DebugException($e->getMessage());
            }
        }

        return self::$dbh;
    }
}
