<?php

namespace App\Shared\Exception;

class ConflictException extends HttpException
{
    public function __construct(
        string $message = 'Conflict',
        string $errorCode = 'CONFLICT'
    )
    {
        parent::__construct($message, 409, $errorCode);
    }
}