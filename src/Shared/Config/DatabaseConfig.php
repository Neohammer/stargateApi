<?php

namespace App\Shared\Config;

final class DatabaseConfig
{
    public function __construct(
        public readonly string $host,
        public readonly int $port,
        public readonly string $name,
        public readonly string $user,
        public readonly string $password,
        public readonly string $charset = 'utf8mb4',
    )
    {
    }
}