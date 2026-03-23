<?php

namespace App\Shared\Config;

final class AppConfig
{
    public function __construct(
        public  readonly string $env,
        public  readonly bool $debug,
        private readonly DatabaseConfig $database,
    )
    {
    }

    public function database(): DatabaseConfig
    {
        return $this->database;
    }

    public function isProd(): bool
    {
        return $this->env === 'prod';
    }

    public function isDev(): bool
    {
        return $this->env === 'dev';
    }
}