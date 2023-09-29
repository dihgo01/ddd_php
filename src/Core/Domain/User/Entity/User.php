<?php

namespace Core\Domain\User\Entity;

use Core\Domain\Traits\MethodsMagicTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;

class User
{
    use MethodsMagicTrait;

    public function __construct(
        protected string $id,
        protected string $uuid,
        protected string $type,
        protected string $is_root,
        protected string $name,
        protected string $email,
        protected string $password,
        protected string $is_blocked,
        protected string $customer_id = '',
        protected string $path_profile_photo = '',
    ) {
        $this->validate();
    }

    public function block_user(): void
    {
        $this->is_blocked = 'Desativado';
    }

    public function unblock_user(): void
    {
        $this->is_blocked = 'Ativado';
    }

    public function update(
        string $type = null,
        string $is_root = null,
        string $name = null,
        string $email = null,
        string $password = null,
        string $is_blocked = null,
        string $path_profile_photo = null,
        string $customer_id = null
    ): void {
        $this->type = $type ? $type : $this->type;
        $this->is_root = $is_root ? $is_root : $this->is_root;
        $this->name = $name ? $name : $this->name;
        $this->email = $email ? $email : $this->email;
        $this->password = $password ? $password : $this->password;
        $this->is_blocked = $is_blocked ? $is_blocked : $this->is_blocked;
        $this->path_profile_photo = $path_profile_photo ? $path_profile_photo : $this->path_profile_photo;
        $this->customer_id = $customer_id ? $customer_id : $this->customer_id;

        $this->validate();
    }

    protected function validate()
    {
        $valide_type = ['Licy', 'Cliente'];
        $valide_is_root = ['Sim', 'Não'];
        $valide_is_blocked = ['Desativado', 'Ativado'];

        DomainValidation::notNull($this->id, "The id field is required");
        DomainValidation::validateUuid($this->uuid, "The uuid field is required");
        DomainValidation::validateEmail($this->email, "The email field is required");
        DomainValidation::notNullAndStringMinChar($this->name, "The name field is required and must be at least 3 characters");

        if (empty($this->type) || !in_array($this->type, $valide_type)) {
            throw new EntityValidationException("The type field is required");
        }

        if (empty($this->is_root) || !in_array($this->is_root, $valide_is_root)) {
            throw new EntityValidationException("The is_root field is required");
        }

        if (empty($this->password) || strlen($this->password) < 6) {
            throw new EntityValidationException("The password field is required");
        }

        if (empty($this->is_blocked) || !in_array($this->is_blocked, $valide_is_blocked)) {
            throw new EntityValidationException("The is_blocked field is required");
        }
    }
}
