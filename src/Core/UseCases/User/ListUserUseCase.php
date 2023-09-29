<?php

namespace Core\UseCases\User;

use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserInputDto;
use Core\DTO\User\UserOutputDto;

class ListUserUseCase
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserInputDto $input): UserOutputDto
    {
        $user = $this->repository->findById($input->id);

        return new UserOutputDto(
            id: $user->id,
            uuid: $user->uuid,
            type: $user->type,
            is_root: $user->is_root,
            name: $user->name,
            email: $user->email,
            is_blocked: $user->is_blocked,
            customer_id: $user->customer_id
        );
    }
}
