<?php

namespace Core\DTO\Customer;

class CustomerCreateInputDto
{
    public function __construct(
        public string $id,
        public string $uuid,
        public string $type,
        public string $is_root,
        public string $name,
        public string $email,
        public string $password,
        public string $is_blocked,
        public string $path_profile_photo = '',
        public string $customer_id = '',
    ) {
    }
}