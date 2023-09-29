<?php

namespace Core\Domain\User\Repository;

use Core\Domain\Interfaces\PaginationInterface;
use Core\Domain\User\Entity\User;

interface UserRepositoryInterface
{
    public function insert(User $data): User;
    public function findById(string $id): User;
    public function findAll(string $filter = '', string $order = 'DESC'): array;
    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;
    public function update(User $data): User;
    public function delete(string $id): bool;
}
