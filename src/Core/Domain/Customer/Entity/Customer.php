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

    public function update(
        string $corporate_name,
        string $trading_name,
        string $system_name,
        CorporateNumber $corporate_number,
        string $phone,
        string $mobile,
        string $email,
        Address $address, 
        string $plan_id,
        string $language_id,
        string $wpp_gateway_id,
    ): void {
        $this->corporate_name = $corporate_name ? $corporate_name : $this->corporate_name;
        $this->trading_name = $trading_name ? $trading_name : $this->trading_name;
        $this->system_name = $system_name ? $system_name : $this->system_name;
        $this->corporate_number = $corporate_number ? $corporate_number : $this->corporate_number;
        $this->phone = $phone ? $phone : $this->phone;
        $this->mobile = $mobile ? $mobile : $this->mobile;
        $this->email = $email ? $email : $this->email;
        $this->address = $address ? $address : $this->address;
        $this->plan_id = $plan_id ? $plan_id : $this->plan_id;
        $this->language_id = $language_id ? $language_id : $this->language_id;
        $this->wpp_gateway_id = $wpp_gateway_id ? $wpp_gateway_id : $this->wpp_gateway_id;

        $this->validate();
    }

    protected function validate() : void {
        DomainValidation::notNull($this->id, "The id field is required");
        DomainValidation::notNullAndStringMinChar($this->corporate_name, "The corporate_name field is required");
        DomainValidation::notNullAndStringMinChar($this->trading_name, "The trading_name field is required");
        DomainValidation::notNullAndStringMinChar($this->system_name, "The system_name field is required");
        DomainValidation::validatePhone($this->phone, "The phone field is required");
        DomainValidation::validatePhone($this->mobile, "The mobile field is required");
        DomainValidation::validateEmail($this->email, "The email field is required");
        DomainValidation::notNull($this->plan_id, "The plan_id field is required");
        DomainValidation::notNull($this->language_id, "The language_id field is required");
        DomainValidation::notNull($this->wpp_gateway_id, "The wpp_gateway_id field is required");
        DomainValidation::validateUuid($this->uuid, "The uuid field is required");
     
    }

}