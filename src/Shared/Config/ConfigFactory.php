<?php

namespace App\Shared\Config;

use RuntimeException;

final class ConfigFactory
{
    public static function createFromEnv(): AppConfig
    {
        $env = self::requireString('APP_ENV');
        $debug = self::requireBool('APP_DEBUG');

        $database = new DatabaseConfig(
            host: self::requireString('DB_HOST'),
            port: self::requireInt('DB_PORT'),
            name: self::requireString('DB_NAME'),
            user: self::requireString('DB_USER'),
            password: self::requireString('DB_PASSWORD'),
            charset: self::getString('DB_CHARSET', 'utf8mb4'),
        );

        return new AppConfig(
            env: $env,
            debug: $debug,
            database: $database,
        );
    }

    private static function requireString(string $key): string
    {
        $value = $_ENV[$key] ?? getenv($key);

        if (!is_string($value) || $value === '') {
            throw new RuntimeException("Missing config key: {$key}");
        }

        return $value;
    }

    private static function getString(string $key, string $default): string
    {
        $value = $_ENV[$key] ?? getenv($key);

        return is_string($value) && $value !== '' ? $value : $default;
    }

    private static function requireInt(string $key): int
    {
        $value = self::requireString($key);

        if (!is_numeric($value)) {
            throw new RuntimeException("Invalid integer config key: {$key}");
        }

        return (int) $value;
    }

    private static function requireBool(string $key): bool
    {
        $value = self::requireString($key);

        return filter_var($value, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)
            ?? throw new RuntimeException("Invalid boolean config key: {$key}");
    }
}