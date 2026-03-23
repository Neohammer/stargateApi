<?php

namespace App\Application\DTO;

class LoginOutputDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $token,
    )
    {
    }
}