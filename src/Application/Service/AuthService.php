<?php

namespace App\Application\Service;

use App\Application\DTO\LoginInputDto;
use App\Application\DTO\LoginOutputDto;
use App\Application\DTO\RegisterInputDto;
use App\Domain\User\Entity\User;
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

        $token = $this->createToken($user);

        return new LoginOutputDto(
            $user->getId(), $token
        );
    }

    private function createToken(User $user): string
    {
        return $this->jwtService->generateToken($user->getId(), $user->getEmail());
    }


    public function register(RegisterInputDto $input): LoginOutputDto
    {
        if (empty($input->username) || empty($input->email) || empty($input->password)) {
            throw new \InvalidArgumentException('Missing fields');
        }

        if ($this->userRepository->findByUsername($input->username)) {
            throw new \RuntimeException('Username already exists');
        }

        if ($this->userRepository->findByEmail($input->email)) {
            throw new \RuntimeException('Email already exists');
        }

        // 3. hash password
        $passwordHash = password_hash($input->password, PASSWORD_DEFAULT);

        // 4. créer user
        $user = $this->userRepository->create(
            $input->username,
            $input->email,
            $passwordHash
        );

        // 5. générer token
        $token = $this->createToken($user);

        return new LoginOutputDto(
            $user->getId(),
            $token
        );
    }
}