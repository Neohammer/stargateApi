<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\DTO\LoginInputDto;
use App\Application\DTO\LoginOutputDto;
use App\Application\DTO\RegisterInputDto;
use App\Application\Service\AuthService;
use App\Infrastructure\Http\JsonResponse;
use App\Infrastructure\Http\Request;

class AuthController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(Request $request): JsonResponse
    {
        $body = $request->getBody();

        $input = new LoginInputDto(
            $body['username'] ?? '',
            $body['password'] ?? ''
        );


        $loginOutputDto = $this->authService->login($input);

        return JsonResponse::success($loginOutputDto);
    }


    public function register(Request $request): JsonResponse
    {
        $body = $request->getBody();

        $input = new RegisterInputDto(
            $body['username'] ?? '',
            $body['email'] ?? '',
            $body['password'] ?? ''
        );

        $loginOutputDto = $this->authService->register($input);

        return JsonResponse::success($loginOutputDto);
    }
}