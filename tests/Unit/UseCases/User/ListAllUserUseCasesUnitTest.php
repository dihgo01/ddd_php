<?php

use Core\Domain\Interfaces\PaginationInterface;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\DTO\User\UserAllInputDto;
use Core\DTO\User\UserAllOutputDto;
use Core\UseCases\User\ListAllUserUseCase;
use Mockery as Mockery;
use stdClass;
use Mockery\MockInterface;

describe('UseCases User unit tests', function () {
    it('should list all users from the UseCase layer and return empty', function () {
        $items = [];

        $mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class, function (MockInterface $mock) use ($items) {
            $mock->shouldReceive('items')->andReturn($items);
            $mock->shouldReceive('total')->andReturn(0);
            $mock->shouldReceive('currentPage')->andReturn(0);
            $mock->shouldReceive('firstPage')->andReturn(0);
            $mock->shouldReceive('lastPage')->andReturn(0);
            $mock->shouldReceive('perPage')->andReturn(0);
            $mock->shouldReceive('to')->andReturn(0);
            $mock->shouldReceive('from')->andReturn(0);
        });

        $mock_user_repository = Mockery::mock(UserRepositoryInterface::class, function (MockInterface $mock) use ($mockPagination) {
            $mock->shouldReceive('paginate')->andReturn($mockPagination);
        });

        $mock_user_input_dto = Mockery::mock(UserAllInputDto::class, [
            'filter',
            'desc',
        ]);

        $useCase = new ListAllUserUseCase($mock_user_repository);

        $responseUseCase = $useCase->execute($mock_user_input_dto);

        expect($responseUseCase)->toBeInstanceOf(UserAllOutputDto::class);
        expect($responseUseCase->items)->toBe([]);

        Mockery::close();
    });

    it('should list all users from the UseCase layer and return object', function () {

        $register = new stdClass();
        $register->id = '1';
        $register->uuid = '123';
        $register->type = 'Cliente';
        $register->is_root = 'Sim';
        $register->name = 'Test';
        $register->email = 'test@gmail.com';
        $register->password = '1234567';
        $register->is_blocked = 'Ativado';
        $register->customer_id = '1';
        $register->created_at = 'created_at';
        $register->updated_at = 'created_at';
        $register->deleted_at = 'created_at';
       
        $mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class, function (MockInterface $mock) use ($register) {
            $mock->shouldReceive('items')->andReturn([$register]);
            $mock->shouldReceive('total')->andReturn(0);
            $mock->shouldReceive('currentPage')->andReturn(0);
            $mock->shouldReceive('firstPage')->andReturn(0);
            $mock->shouldReceive('lastPage')->andReturn(0);
            $mock->shouldReceive('perPage')->andReturn(0);
            $mock->shouldReceive('to')->andReturn(0);
            $mock->shouldReceive('from')->andReturn(0);
        });

        $mock_user_repository = Mockery::mock(UserRepositoryInterface::class, function (MockInterface $mock) use ($mockPagination) {
            $mock->shouldReceive('paginate')->andReturn($mockPagination);
        });

        $mock_user_input_dto = Mockery::mock(UserAllInputDto::class, [
            'filter',
            'desc',
        ]);

        $useCase = new ListAllUserUseCase($mock_user_repository);

        $responseUseCase = $useCase->execute($mock_user_input_dto);

        expect($responseUseCase)->toBeInstanceOf(UserAllOutputDto::class);
        expect($responseUseCase->items[0])->toBe($register);

        Mockery::close();
    });

});
