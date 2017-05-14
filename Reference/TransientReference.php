<?php

namespace Habu\TaskSchedulerBundle\Reference;

use Habu\TaskSchedulerBundle\Interfaces\ReferenceInterface;

class TransientReference implements ReferenceInterface
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * TransientReference will contain a value and return it.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Do exactly nothing.
     */
    public function wait()
    {
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->value;
    }
}
