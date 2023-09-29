<?php

namespace Core\UseCases\User;

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserCreateInputDto;
use Core\DTO\User\UserCreateOutputDto;

class CreateUserUseCase
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserCreateInputDto $input): UserCreateOutputDto
    {
        $user = new User(
            id: $input->id,
            uuid: $input->uuid,
            type: $input->type,
            is_root: $input->is_root,
            name: $input->name,
            email: $input->email,
            password: $input->password,
            is_blocked: $input->is_blocked,
            customer_id: $input->customer_id
        );

        $newUser = $this->repository->insert($user);

        return new UserCreateOutputDto(
            id: $newUser->id,
            uuid: $newUser->uuid,
            type: $newUser->type,
            is_root: $newUser->is_root,
            name: $newUser->name,
            email: $newUser->email,
            is_blocked: $newUser->is_blocked,
            customer_id: $newUser->customer_id
        );
    }
}
