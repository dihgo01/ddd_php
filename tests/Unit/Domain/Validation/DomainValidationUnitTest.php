<?php

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;

describe('Domain Validation unit tests', function () {
    it('should return an error if it does not have the email fields', function () {

        DomainValidation::notNull('');
        
    })->throws(EntityValidationException::class, 'The field cannot be null');
});
