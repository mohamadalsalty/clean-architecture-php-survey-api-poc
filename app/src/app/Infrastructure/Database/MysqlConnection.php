<?php

namespace App\Infrastructure\Database;

use PDO;

/**
 *
 */
class MysqlConnection
{
    /**
     * @return PDO
     */
    public static function connect(): PDO
    {
        $host = "db";
        $dbname = "surveys";
        $username = "root";
        $password = "root";

        return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }
}
