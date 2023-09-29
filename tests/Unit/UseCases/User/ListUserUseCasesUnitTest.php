<?php

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserInputDto;
use Core\DTO\User\UserOutputDto;
use Core\UseCases\User\ListUserUseCase;
use Mockery as Mockery;
use Mockery\MockInterface;

describe('UseCases User unit tests', function () {
    it('should list a user of the UseCase layer', function () {

        $mock_user = Mockery::mock(User::class, [
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

        $mock_user_repository = Mockery::mock(UserRepositoryInterface::class, function (MockInterface $mock) use ($mock_user) {
            $mock->shouldReceive('findById')->with($mock_user->id)->andReturn($mock_user);
        });

        $mock_user_input_dto = Mockery::mock(UserInputDto::class, [
            '1',
        ]);

        $useCase = new ListUserUseCase($mock_user_repository);

        $responseUseCase = $useCase->execute($mock_user_input_dto);

        expect($responseUseCase)->toBeInstanceOf(UserOutputDto::class);
        expect($responseUseCase->uuid)->toBe('123');
        expect($responseUseCase->customer_id)->toBe('1');
        expect($responseUseCase->type)->toBe('Licy');
        expect($responseUseCase->is_root)->toBe('Sim');
        expect($responseUseCase->name)->toBe('Test');
        expect($responseUseCase->email)->toBe('test@gmail.com');
        expect($responseUseCase->is_blocked)->toBe('Ativado');

        Mockery::close();
    });
});
