<?php

namespace Core\DTO\User;

class UserDeleteInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}