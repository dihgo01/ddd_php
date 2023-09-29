<?php

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserCreateInputDto;
use Core\DTO\User\UserCreateOutputDto;
use Core\UseCases\User\CreateUserUseCase;
use Mockery as Mockery;
use Mockery\MockInterface;

describe('UseCases User unit tests', function () {
    it('should create a user using DTO and use Cases', function () {

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
            $mock->shouldReceive('insert')->andReturn($mock_user);
        });

        $mock_user_input_dto = Mockery::mock(UserCreateInputDto::class, [
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

        $useCase = new CreateUserUseCase($mock_user_repository);

        $responseUseCase = $useCase->execute($mock_user_input_dto);

        expect($responseUseCase)->toBeInstanceOf(UserCreateOutputDto::class);
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
