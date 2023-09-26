<?php

use Core\Domain\User\Entity\User;
use Core\Domain\Exception\EntityValidationException;

describe('User unit tests', function () {
    it('must check if all attributes are correct', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );

        expect($user)->toBeInstanceOf(User::class);
        expect($user->uuid)->toBe('123');
        expect($user->customer_id)->toBe('1');
        expect($user->type)->toBe('Licy');
        expect($user->is_root)->toBe('Sim');
        expect($user->name)->toBe('Test');
        expect($user->email)->toBe('test@gmail.com');
        expect($user->password)->toBe('123456');
        expect($user->is_blocked)->toBe('Ativado');
    });

    it('must deactivate the user and activate it again', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );

        expect($user->is_blocked)->toBe('Ativado');

        $user->block_user();

        expect($user->is_blocked)->toBe('Desativado');

        $user->unblock_user();

        expect($user->is_blocked)->toBe('Ativado');
    });

    it('must update the user and validate the information', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );

        $user->update(
            type: 'Cliente',
            is_root: 'Não',
            name: 'New_name_test',
            email: 'test1@gmail.com',
            password: '1234567',
            is_blocked: 'Desativado',
            customer_id: '2'
        );

        expect($user->type)->toEqual('Cliente');
        expect($user->is_root)->toEqual('Não');
        expect($user->name)->toEqual('New_name_test');
        expect($user->email)->toEqual('test1@gmail.com');
        expect($user->password)->toEqual('1234567');
        expect($user->is_blocked)->toEqual('Desativado');
        expect($user->customer_id)->toEqual('2');
    });

    it('should only update the information that was provided', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );

        $user->update(
            is_root: 'Não',
            name: 'New_name_test',
            password: '1234567',
            customer_id: '2'
        );

        expect($user->type)->toEqual('Licy');
        expect($user->is_root)->toEqual('Não');
        expect($user->name)->toEqual('New_name_test');
        expect($user->email)->toEqual('test@gmail.com');
        expect($user->password)->toEqual('1234567');
        expect($user->is_blocked)->toEqual('Ativado');
        expect($user->customer_id)->toEqual('2');
    });

    it('should return an error if it does not have the uuid fields', function () {

        $user = new User(
            id: '1',
            uuid: ' ',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );

    })->throws(EntityValidationException::class, 'The uuid field is required');

    it('should return an error if it does not have the type fields', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Lic',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );

    })->throws(EntityValidationException::class, 'The type field is required');

    it('should return an error if it does not have the is_root fields', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: '',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );
  
    })->throws(EntityValidationException::class, 'The is_root field is required');

    it('should return an error if it does not have the name fields', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: ' ',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );
  
    })->throws(EntityValidationException::class, 'The name field is required and must be at least 3 characters');

    it('should return an error if it does not have the email fields', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'testgmail.com',
            password: '123456',
            is_blocked: 'Ativado',
            customer_id: '1'
        );
  
    })->throws(EntityValidationException::class, 'The email field is required');

    it('should return an error if it does not have the password fields', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '12345',
            is_blocked: 'Ativado',
            customer_id: '1'
        );
  
    })->throws(EntityValidationException::class, 'The password field is required');

    it('should return an error if it does not have the is_blocked fields', function () {

        $user = new User(
            id: '1',
            uuid: '123',
            type: 'Licy',
            is_root: 'Sim',
            name: 'Test',
            email: 'test@gmail.com',
            password: '123456',
            is_blocked: 'Ativa',
            customer_id: '1'
        );
  
    })->throws(EntityValidationException::class, 'The is_blocked field is required');


});
