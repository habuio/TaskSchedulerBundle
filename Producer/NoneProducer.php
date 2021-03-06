<?php

namespace Habu\TaskSchedulerBundle\Producer;

use Habu\TaskSchedulerBundle\Interfaces\ProducerInterface;
use Habu\TaskSchedulerBundle\Interfaces\ReferenceInterface;
use Habu\TaskSchedulerBundle\Reference\TransientReference;

class NoneProducer implements ProducerInterface
{
    /**
     * NoneProducer is a very handy producer that will do exactly
     * nothing and return a transient reference object with no value.
     *
     * Particularly useful for developing without requiring an actual
     * background worker to be running, in situations where you don't
     * actually need to do anything with the result.
     *
     * @param string    $cls
     * @param string    $method
     * @param array     $args
     * @param \DateTime $when
     *
     * @return ReferenceInterface
     */
    public function produce($cls, $method, $args, \DateTime $when): ReferenceInterface
    {
        return new TransientReference(null);
    }
}
