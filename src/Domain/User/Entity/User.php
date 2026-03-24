<?php

namespace App\Domain\User\Entity;

class User
{
    public function __construct(
        private ?int   $id,
        private string $username,
        private string $email,
        private string $password_hash,
        private \DateTimeImmutable $createdAt,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getEmail(): string
    {
        return $this->username;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}