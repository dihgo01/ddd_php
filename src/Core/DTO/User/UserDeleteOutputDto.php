<?php

namespace Core\DTO\User;

class UserDeleteOutputDto
{
    public function __construct(
        public bool $response,
    ) {
    }
}