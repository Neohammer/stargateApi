<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;

interface UserRepositoryInterface
{
    public function findAll(array $filters = [], ?string $sort = null, string $order = 'ASC'): array;

    public function findById(int $id): ?User;

    public function save(User $user): User;

    public function delete(int $id): void;
}