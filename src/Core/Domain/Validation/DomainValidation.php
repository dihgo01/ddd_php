<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{

    public static function notNull(string $value, string $exceptMessage = null)
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptMessage ?? 'The field cannot be null');
        }
    }

    public static function notNullAndStringMinChar(string $value, string $exceptMessage = null)
    {
        if (empty($value) || strlen($value) < 3) {
            throw new EntityValidationException($exceptMessage ?? 'The field cannot be null or less than three characters');
        }
    }

    public static function validateUuid(string $value, string $exceptMessage = null)
    {
        if (empty($value) || strlen($value) < 3) {
            throw new EntityValidationException($exceptMessage ?? 'Please enter a valid uuid');
        }
    }

    public static function validateEmail(string $value, string $exceptMessage = null)
    {
        if (empty($value) || strlen($value) < 3 || !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new EntityValidationException($exceptMessage ?? "Please enter a valid email");
        }
    }

    public static function validatePhone(string $value, string $exceptMessage = null)
    {
        $phone = preg_replace("/[^0-9]/", "", $value);

        if (empty($value) || strlen($phone) < 10) {
            throw new EntityValidationException($exceptMessage ?? "Please enter a valid phone");
        }
    }

    public static function validateZipCode(string $value, string $exceptMessage = null)
    {
        $zipcode = preg_replace("/[^0-9]/", "", $value);

        if (empty($value) || strlen($zipcode) < 8) {
            throw new EntityValidationException($exceptMessage ?? "Please enter a valid zip code");
        }
    }

    public static function validateCorporateNumber(string $value, string $exceptMessage = null)
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptMessage ?? "The corporate number field cannot be empty");
        }

        $cnpj = preg_replace("/[^0-9]/", "", $value);
        
        if (strlen($cnpj) != 14) {
            throw new EntityValidationException($exceptMessage ?? "The corporate number field is not valid");
        }

        if (
            $cnpj == '00000000000000' ||
            $cnpj == '11111111111111' ||
            $cnpj == '22222222222222' ||
            $cnpj == '33333333333333' ||
            $cnpj == '44444444444444' ||
            $cnpj == '55555555555555' ||
            $cnpj == '66666666666666' ||
            $cnpj == '77777777777777' ||
            $cnpj == '88888888888888' ||
            $cnpj == '99999999999999'
        ) {
            throw new EntityValidationException($exceptMessage ?? "The corporate number field is not valid");
        }
    }
}
