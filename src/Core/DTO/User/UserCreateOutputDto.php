<?php

namespace Core\DTO\User;

class UserCreateOutputDto
{
    public function __construct(
        public string $id,
        public string $uuid,
        public string $type,
        public string $is_root,
        public string $name,
        public string $email,
        public string $is_blocked,
        public string $customer_id = '',
        public string $path_profile_photo = '',
    ) {
    }
}