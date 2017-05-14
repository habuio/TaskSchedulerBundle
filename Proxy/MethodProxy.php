<?php

namespace Habu\TaskSchedulerBundle\Proxy;

use TaskSchedulerBundle\Interfaces\ReferenceInterface;
use TaskSchedulerBundle\Service\SchedulerService;

class MethodProxy
{
    private $scheduler;
    private $cls;
    private $method;

    public function __construct(SchedulerService $scheduler, $cls, $method)
    {
        $this->scheduler = $scheduler;
        $this->cls = $cls;
        $this->method = $method;
    }

    /**
     * @param array ...$args
     * @return ReferenceInterface
     */
    public function delay(...$args): ReferenceInterface
    {
        return $this->scheduler->schedule($this->cls, $this->method, $args, new \DateTime());
    }

    /**
     * @param \DateTime $dateTime
     * @param array ...$args
     * @return ReferenceInterface
     */
    public function schedule(\DateTime $dateTime, ...$args): ReferenceInterface
    {
        return $this->scheduler->schedule($this->cls, $this->method, $args, $dateTime);
    }
}