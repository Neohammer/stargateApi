<?php

namespace App\Shared\Exception;

class BadRequestException extends HttpException
{
    public function __construct(
        string $message = 'Bad Request',
        string $errorCode = 'BAD_REQUEST'
    ) {
        parent::__construct($message, 400, $errorCode);
    }
}