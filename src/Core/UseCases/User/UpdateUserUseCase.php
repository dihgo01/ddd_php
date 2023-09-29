<?php

namespace Core\UseCases\User;

use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserUpdateInputDto;
use Core\DTO\User\UserUpdateOutputDto;

class UpdateUserUseCase
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserUpdateInputDto $input): UserUpdateOutputDto
    {
        $user = $this->repository->findById($input->id);
    
        $user->update(
            type: $input->type,
            is_root: $input->is_root,
            name: $input->name,
            email: $input->email,
            password: $input->password,
            is_blocked: $input->is_blocked,
            customer_id: $input->customer_id,
            path_profile_photo: $input->path_profile_photo
        );

        $updateUser = $this->repository->update($user);

        return new UserUpdateOutputDto(
            id: $updateUser->id,
            uuid: $updateUser->uuid,
            type: $updateUser->type,
            is_root: $updateUser->is_root,
            name: $updateUser->name,
            email: $updateUser->email,
            is_blocked: $updateUser->is_blocked,
            customer_id: $updateUser->customer_id
        );
    }
}
