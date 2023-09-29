<?php

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserDeleteInputDto;
use Core\DTO\User\UserDeleteOutputDto;
use Core\UseCases\User\DeleteUserUseCase;
use Mockery as Mockery;
use Mockery\MockInterface;

describe('UseCases User unit tests', function () {
    it('should delete a user using DTO and use Cases', function () {

        $mock_user_delete = Mockery::mock(User::class, [
            '1',
            '123',
            'Licy',
            'Sim',
            'Test',
            'test@gmail.com',
            '123456',
            'Ativado',
            '1'
        ]);

        $mock_user_repository = Mockery::mock(UserRepositoryInterface::class, function (MockInterface $mock) use ($mock_user_delete) {
            $mock->shouldReceive('findById')->andReturn($mock_user_delete);
            $mock->shouldReceive('delete')->andReturn(true);
        });

        $mock_user_input_dto = Mockery::mock(UserDeleteInputDto::class, [
            '1',
        ]);

        $useCase = new DeleteUserUseCase($mock_user_repository);

        $responseUseCase = $useCase->execute($mock_user_input_dto);

        expect($responseUseCase)->toBeInstanceOf(UserDeleteOutputDto::class);
        expect($responseUseCase->response)->toBeTrue(true);

        Mockery::close();
    });
});
