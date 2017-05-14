<?php

namespace Habu\TaskSchedulerBundle\Proxy;

use Habu\TaskSchedulerBundle\Interfaces\ReferenceInterface;
use Habu\TaskSchedulerBundle\Service\SchedulerService;

class MethodProxy
{
    private $schedulerService;
    private $cls;
    private $method;

    public function __construct(SchedulerService $schedulerService, $cls, $method)
    {
        $this->schedulerService = $schedulerService;
        $this->cls = $cls;
        $this->method = $method;
    }

    /**
     * @param array ...$args
     * @return ReferenceInterface
     */
    public function delay(...$args): ReferenceInterface
    {
        return $this->schedulerService->schedule($this->cls, $this->method, $args, new \DateTime());
    }

    /**
     * @param \DateTime $dateTime
     * @param array ...$args
     * @return ReferenceInterface
     */
    public function schedule(\DateTime $dateTime, ...$args): ReferenceInterface
    {
        return $this->schedulerService->schedule($this->cls, $this->method, $args, $dateTime);
    }
}