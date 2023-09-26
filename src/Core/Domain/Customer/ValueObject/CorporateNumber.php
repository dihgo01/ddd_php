<?php

namespace Core\Domain\Customer\ValueObject;

use Core\Domain\Traits\MethodsMagicTrait;
use Core\Domain\Validation\DomainValidation;

class CorporateNumber
{
    use MethodsMagicTrait;

    public function __construct(
        protected string $corporate_number,
    ) {
        $this->validate();
    }

    public function validate(): void
    {
       DomainValidation::validateCorporateNumber($this->corporate_number);
    }
}
