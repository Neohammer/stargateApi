<?php

namespace App\Application\Service;

use App\Application\DTO\LoginInputDto;
use App\Application\DTO\LoginOutputDto;
use App\Infrastructure\Persistence\PdoUserRepository;
use App\Infrastructure\Security\JwtService;
use App\Shared\Exception\UnauthorizedException;

class AuthService
{
    public function __construct(
        private PdoUserRepository $userRepository,
        private JwtService        $jwtService,
    )
    {
    }

    public function login(LoginInputDto $input): LoginOutputDto
    {
        $user = $this->userRepository->findByUsername($input->username);

        if ($user === null) {
            throw new UnauthorizedException('Invalid credentials');
        }

        if (!password_verify($input->password, $user['password_hash'])) {
            throw new UnauthorizedException('Invalid credentials');
        }

        $token = $this->jwtService->generateToken($user->getId(), $user->getEmail());

        return new LoginOutputDto(
            $user->getId(), $token
        );
    }

    private function createToken(User $user): string
    {
        return $this->jwtService->generateToken($user->id, $user->email);
    }
}