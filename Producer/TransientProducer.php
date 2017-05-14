<?php

namespace Habu\TaskSchedulerBundle\Producer;

use Habu\TaskSchedulerBundle\Interfaces\ProducerInterface;
use Habu\TaskSchedulerBundle\Reference\TransientReference;
use Habu\TaskSchedulerBundle\Worker\Worker;

class TransientProducer implements ProducerInterface
{
    /**
     * @var Worker
     */
    private $worker;

    /**
     * TransientProducer will execute a task within the same process as
     * the scheduler call, and wrap the result in a reference object.
     *
     * This allows you to be able to develop without requiring a
     * background task worker process, in cases where you need to
     * actually need the result.
     *
     * @TODO - Make it possible to execute lazy
     *
     * @param Worker $worker
     */
    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    public function produce($cls, $method, $args)
    {
        return new TransientReference($this->worker->run($cls, $method, $args));
    }
}
