<?php

namespace App\Application\DTO;

class RegisterInputDto
{
    public function __construct(
        public readonly string $username,
        public readonly string $email,
        public readonly string $password
    )
    {
    }
}