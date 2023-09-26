<?php

use Core\Domain\Customer\Entity\Customer;
use Core\Domain\Customer\ValueObject\Address;
use Core\Domain\Customer\ValueObject\CorporateNumber;

describe('Customer unit tests', function () {
    test('should create a client with all attributes', function () {
        $corporate_number = new CorporateNumber(
            corporate_number: '123456789',
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
            phone: '123456789',
            mobile: '123456789',
            email: 'test@gmail.com',
            address: $address,
            plan_id: '1',
            language_id: '1',
            wpp_gateway_id: '1'
        );

   
        expect($customer->email)->toEqual('test@gmail.com');
        
    });
});
