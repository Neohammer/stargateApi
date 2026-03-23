<?php

namespace App\Infrastructure\Persistence;

use App\Shared\Config\DatabaseConfig;
use PDO;

class DatabaseConnection
{
    public static function create(
        DatabaseConfig $config
    ): PDO {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $config->host,
            $config->port,
            $config->name,
            $config->charset
        );

        $pdo = new PDO($dsn, $config->user, $config->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}