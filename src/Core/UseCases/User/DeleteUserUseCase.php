<?php

namespace Core\UseCases\User;

use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserDeleteInputDto;
use Core\DTO\User\UserDeleteOutputDto;

class DeleteUserUseCase
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserDeleteInputDto $input): UserDeleteOutputDto
    {
        $user = $this->repository->findById($input->id);
    
        $deleteUser = $this->repository->delete($user->id);

        return new UserDeleteOutputDto(
          response : $deleteUser
        );
    }
}
