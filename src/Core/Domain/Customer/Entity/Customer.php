<?php 

namespace Core\Domain\Customer\Entity;

use Core\Domain\Traits\MethodsMagicTrait;
use Core\Domain\Customer\ValueObject\Address;
use Core\Domain\Customer\ValueObject\CorporateNumber;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;

class Customer {

    use MethodsMagicTrait;

    public function __construct(
        protected string $id,
        protected string $uuid,
        protected string $corporate_name,
        protected string $trading_name,
        protected string $system_name,
        protected CorporateNumber $corporate_number,
        protected string $phone,
        protected string $mobile,
        protected string $email,
        protected Address $address,
        protected string $plan_id,
        protected string $language_id,
        protected string $wpp_gateway_id,
    )
    {
        $this->validate();
    }

    public function validate() : void {
        DomainValidation::notNull($this->corporate_name, "The corporate_name field is required");
        DomainValidation::validateUuid($this->uuid, "The uuid field is required");
        DomainValidation::validateEmail($this->email, "The email field is required");
     
    }

}