<?php

namespace App\Shared\Exception;

class HttpException extends \RuntimeException
{
    public function __construct(
        string $message,
        private int $statusCode,
        private string $errorCode = 'HTTP_ERROR'
    ) {
        parent::__construct($message);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}