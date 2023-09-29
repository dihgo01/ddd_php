<?php

namespace Core\UseCases\User;

use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserAllInputDto;
use Core\DTO\User\UserAllOutputDto;

class ListAllUserUseCase
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserAllInputDto $input): UserAllOutputDto
    {
        $user = $this->repository->paginate(
            filter: $input->filter , 
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage,
        );

        return new UserAllOutputDto(
            items: $user->items(),
            total: $user->total(),
            current_page: $user->currentPage(),
            last_page: $user->lastPage(),
            first_page: $user->firstPage(),
            per_page: $user->perPage(),
            to: $user->to(),
            from: $user->from(),
        );
    }
}
