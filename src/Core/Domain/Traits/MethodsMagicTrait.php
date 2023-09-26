<?php

namespace Core\Domain\Traits;

trait MethodsMagicTrait
{
    public function __get($property)
    {
        if (isset($this->$property)) {
            return $this->{$property};
        } else {
            $class = get_class($this);
            throw new \Exception("The property {$property} not exists in the class {$class}");
        }
    }
}
