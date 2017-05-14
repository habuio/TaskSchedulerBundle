<?php

namespace Habu\TaskSchedulerBundle\Producer;

use TaskSchedulerBundle\Interfaces\ProducerInterface;
use TaskSchedulerBundle\Reference\TransientReference;
use TaskSchedulerBundle\Worker\Worker;

class TransientProducer implements ProducerInterface
{
    private $worker;

    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    public function produce($cls, $method, $args)
    {
        return new TransientReference($this->worker->run($cls, $method, $args));
    }
}
