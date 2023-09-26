<?php 

namespace Core\Domain\Exception;

use Exception;
use Throwable;

class EntityValidationException extends Exception
{
    public function __construct($message = "Entity validation error", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}