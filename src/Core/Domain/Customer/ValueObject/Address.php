<?php

namespace Core\Domain\Customer\ValueObject;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Traits\MethodsMagicTrait;
use Core\Domain\Validation\DomainValidation;

class Address
{
    use MethodsMagicTrait;

    public function __construct(
        protected string $zipcode,
        protected string $address,
        protected int $number,
        protected string $neighborhood,
        protected string $city_id,
        protected string $complement = '',
    ) {
        $this->validate();
    }

    public function validate(): void
    {
        DomainValidation::validateZipcode($this->zipcode, 'Please enter a valid zip code');
        DomainValidation::notNull($this->address, 'The address field is required');
        DomainValidation::notNull($this->number, 'The number field is required');
        DomainValidation::notNullAndStringMinChar($this->neighborhood, 'The neighborhood field is required and must be at least 3 characters');

        if (empty($this->number) || $this->number < 0) {
            throw new EntityValidationException('The number field is required');
        }

        if (empty($this->city_id)) {
            throw new EntityValidationException('The city_id field is required');
        }
    }
}
