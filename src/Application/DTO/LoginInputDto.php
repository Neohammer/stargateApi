<?php

namespace App\Application\DTO;

class LoginInputDto
{
    public function __construct(
        public readonly string $username,
        public readonly string $password
    )
    {
    }
}