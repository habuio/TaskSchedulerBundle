<?php

namespace Habu\TaskSchedulerBundle\Reference;

use TaskSchedulerBundle\Interfaces\ReferenceInterface;

class TransientReference implements ReferenceInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function wait(): bool
    {
        return true;
    }

    public function get()
    {
        return $this->value;
    }
}
