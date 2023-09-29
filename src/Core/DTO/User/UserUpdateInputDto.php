<?php

namespace Core\DTO\User;

class UserUpdateInputDto
{
    public function __construct(
        public string $id,
        public string $type,
        public string $is_root,
        public string $name,
        public string $email,
        public string $password,
        public string $is_blocked,
        public string|null $customer_id = '',
        public string|null $path_profile_photo = '',
    ) {
    }
}