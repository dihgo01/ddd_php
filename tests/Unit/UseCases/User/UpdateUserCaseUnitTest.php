<?php

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserUpdateInputDto;
use Core\DTO\User\UserUpdateOutputDto;
use Core\UseCases\User\UpdateUserUseCase;
use Mockery as Mockery;
use Mockery\MockInterface;

describe('UseCases User unit tests', function () {
    it('should update a user using DTO and use Cases', function () {

        $mock_user_update = Mockery::mock(User::class, [
            '1',
            '123',
            'Licy',
            'Sim',
            'Test',
            'test@gmail.com',
            '123456',
            'Ativado',
            '1'
        ], function (MockInterface $mock) {
            $mock->shouldReceive('update');
        });

        $mock_user_repository = Mockery::mock(UserRepositoryInterface::class, function (MockInterface $mock) use ($mock_user_update) {
            $mock->shouldReceive('findById')->andReturn($mock_user_update);
            $mock->shouldReceive('update')->andReturn($mock_user_update);
        });

        $mock_user_input_dto = Mockery::mock(UserUpdateInputDto::class, [
            '1',
            'Cliente',
            'Não',
            'Test1',
            'test1@gmail.com',
            '1234567',
            'Ativado',
            '2'
        ]);

        $useCase = new UpdateUserUseCase($mock_user_repository);

        $responseUseCase = $useCase->execute($mock_user_input_dto);

        expect($responseUseCase)->toBeInstanceOf(UserUpdateOutputDto::class);

        Mockery::close();
    });
});
