<?php

namespace App\Infrastructure\Persistence;

use PDO;

class PdoUserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM sg1_user WHERE username = :username');
        $stmt->execute(['username' => $username]);

        $user = $stmt->fetch();

        return $user ?: null;
    }
}