<?php

use Core\Domain\Customer\Entity\Customer;
use Core\Domain\Customer\ValueObject\Address;
use Core\Domain\Customer\ValueObject\CorporateNumber;
use Core\Domain\Exception\EntityValidationException;

describe('Customer unit tests', function () {
    it('should create a client with all attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        $customer = new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );

        expect($customer)->toBeInstanceOf(Customer::class);
        expect($customer->uuid)->toBe('123');
        expect($customer->corporate_name)->toBe('Test S/A');
        expect($customer->trading_name)->toBe('Test S/A');
        expect($customer->system_name)->toBe('Test');
        expect($customer->corporate_number)->toBe($corporate_number);
        expect($customer->phone)->toBe('(67)3839-3702');
        expect($customer->mobile)->toBe('(67)3839-3702');
        expect($customer->email)->toEqual('test@gmail.com');
        expect($customer->address)->toBe($address);
        expect($customer->plan_id)->toBe('1');
        expect($customer->language_id)->toBe('1');
        expect($customer->wpp_gateway_id)->toBe('1');
        
    });

    it('should update a client with all attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        $customer = new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );

        $corporate_number2 = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address2 = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        $customer->update(
            corporate_name: 'Test Update S/A',
            trading_name: 'Test Update S/A',
            system_name: 'Test Update',
            corporate_number: $corporate_number2,
            phone: '(67)3839-9898',
            mobile: '(67)3839-9898',
            email: 'test1@gmail.com',
            address: $address2,
            plan_id: '2',
            language_id: '2',
            wpp_gateway_id: '2'
        );
   
        expect($customer)->toBeInstanceOf(Customer::class);
        expect($customer->uuid)->toBe('123');
        expect($customer->corporate_name)->toBe('Test Update S/A');
        expect($customer->trading_name)->toBe('Test Update S/A');
        expect($customer->system_name)->toBe('Test Update');
        expect($customer->corporate_number)->toBe($corporate_number2);
        expect($customer->phone)->toBe('(67)3839-9898');
        expect($customer->mobile)->toBe('(67)3839-9898');
        expect($customer->email)->toEqual('test1@gmail.com');
        expect($customer->address)->toBe($address2);
        expect($customer->plan_id)->toBe('2');
        expect($customer->language_id)->toBe('2');
        expect($customer->wpp_gateway_id)->toBe('2');
    });

    it('should throw exception when creating a client with invalid id attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The id field is required');

    it('should throw exception when creating a client with invalid uuid attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The uuid field is required');

    it('should throw exception when creating a client with invalid corporate_name attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: '',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The corporate_name field is required');

    it('should throw exception when creating a client with invalid trading_name attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: '',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The trading_name field is required');

    it('should throw exception when creating a client with invalid system_name attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: '',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The system_name field is required');

    it('should throw exception when creating a client with invalid phone attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-37',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The phone field is required');

    it('should throw exception when creating a client with invalid mobile attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The mobile field is required');

    it('should throw exception when creating a client with invalid email attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmailcom',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The email field is required');

    it('should throw exception when creating a client with invalid plan_id attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '',
            language_id: '1',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The plan_id field is required');

    it('should throw exception when creating a client with invalid language_id attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '',
            wpp_gateway_id: '1'
        );
    })->throws(EntityValidationException::class, 'The language_id field is required');

    it('should throw exception when creating a client with invalid wpp_gateway_id attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '69.260.735/0001-50',
        );

        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

        new Customer(
            id: '1',
            uuid: '123',
            corporate_name: 'Test S/A',
            trading_name: 'Test S/A',
            system_name: 'Test',
            corporate_number: $corporate_number,
            phone: '(67)3839-3702',
            mobile: '(67)3839-3702',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: ''
        );
    })->throws(EntityValidationException::class, 'The wpp_gateway_id field is required');

    it('should throw exception when creating a corporate number with invalid attributes', function () {
        new CorporateNumber(
            corporate_number: '69.260.735/0001-',
        );
    })->throws(EntityValidationException::class, 'The corporate number field is not valid');

    it('should return an error if field is less than 8 or empty', function () {
        $address = new Address(
            zipcode: '1234567',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

    })->throws(EntityValidationException::class, 'Please enter a valid zip code');

    it('should return an error if field address is empty', function () {
        $address = new Address(
            zipcode: '12345678',
            address: '',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

    })->throws(EntityValidationException::class, 'The address field is required');

    it('should return an error if the field number is less than 1', function () {
        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 0,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '1',
        );

    })->throws(EntityValidationException::class, 'The number field is required');

    it('should return an error if field city_id is empty', function () {
        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: 'Test',
            city_id: '',
        );

    })->throws(EntityValidationException::class, 'The city_id field is required');

    it('should return an error if field neighborhood is empty', function () {
        $address = new Address(
            zipcode: '12345678',
            address: 'Test',
            number: 123,
            complement: 'Test',
            neighborhood: '',
            city_id: '',
        );

    })->throws(EntityValidationException::class, 'The neighborhood field is required and must be at least 3 characters');
});
