<?php

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;

describe('Domain Validation unit tests', function () {
    it('should return an error if field is blank', function () {
        $value = '';

        DomainValidation::notNull($value); 
        
    })->throws(EntityValidationException::class, 'The field cannot be null');

    it('should return an error if field is blank and returns custom message', function () {

        $value = '';
        $message = 'Please enter a valid email';
        DomainValidation::notNull($value, $message);
        
    })->throws(EntityValidationException::class, 'Please enter a valid email');

    it('should return an error if it does not have the email fields', function () {

        $value = '';
        DomainValidation::validateEmail($value);
        
    })->throws(EntityValidationException::class, 'Please enter a valid email');

    it('should return an error email is not valid', function () {

        $value = 'testgmail.c';
        DomainValidation::validateEmail($value);
        
    })->throws(EntityValidationException::class, 'Please enter a valid email');

    it('should return an error if field is less than 3', function () {

        $value = 'te';
        DomainValidation::notNullAndStringMinChar($value);
        
    })->throws(EntityValidationException::class, 'The field cannot be null or less than three characters');

    it('should return an error if field is blank or less than 3', function () {

        $value = '';
        DomainValidation::notNullAndStringMinChar($value);
        
    })->throws(EntityValidationException::class, 'The field cannot be null or less than three characters');

    it('should return an error if zipcode field is empty', function () {

        $value = '';
        DomainValidation::validateZipCode($value);
        
    })->throws(EntityValidationException::class, 'Please enter a valid zip code');

    it('should return an error if field is less than 8 or empty', function () {

        $value = '1234567';
        DomainValidation::validateZipCode($value);
        
    })->throws(EntityValidationException::class, 'Please enter a valid zip code');

    it('should return an error if the corporate number field is empty', function () {

        $value = '';
        DomainValidation::validateCorporateNumber($value);
        
    })->throws(EntityValidationException::class, 'The corporate number field cannot be empty');

    it('should return an error if corporate number field is less than 14', function () {

        $value = '1234567';
        DomainValidation::validateCorporateNumber($value);
        
    })->throws(EntityValidationException::class, 'The corporate number field is not valid');

    it('should return an error if the corporate number field is not valid', function () {

        $value = '11111111111111';
        DomainValidation::validateCorporateNumber($value);
        
    })->throws(EntityValidationException::class, 'The corporate number field is not valid');

    it('should return an error if the phone field is empty', function () {

        $value = '';
        DomainValidation::validatePhone($value);
        
    })->throws(EntityValidationException::class, 'Please enter a valid phone');

    it('should return an error if phone field has less than 10 characters', function () {

        $value = '1234565';
        DomainValidation::validatePhone($value);
        
    })->throws(EntityValidationException::class, 'Please enter a valid phone');
});
