<?php

namespace App\Infrastructure\Persistence;

use App\Domain\User\Entity\User;
use PDO;

class PdoUserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM sg1_user WHERE username = :username');
        $stmt->execute(['username' => $username]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM sg1_user WHERE email = :email');
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function create(string $username, string $email, string $passwordHash): User
    {
        $stmt = $this->pdo->prepare("
        INSERT INTO sg1_user (username, email, password_hash, created_at)
        VALUES (:username, :email, :password_hash, NOW())
    ");

        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password_hash' => $passwordHash,
        ]);

        $id = (int)$this->pdo->lastInsertId();

        return new User(
            $id,
            $username,
            $email,
            $passwordHash,
            new \DateTimeImmutable()
        );
    }
}