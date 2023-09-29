<?php

namespace Core\Domain\Customer\Repository;

use Core\Domain\Customer\Entity\Customer;
use Core\Domain\Interfaces\PaginationInterface;

interface CustomerRepositoryInterface
{
    public function create(Customer $data): Customer;
    public function find(string $id): Customer;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;
    public function update(array $data): Customer;
    public function delete(string $id): bool;
}
