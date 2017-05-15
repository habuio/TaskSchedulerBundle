<?php

namespace Habu\TaskSchedulerBundle\Proxy;

use Habu\TaskSchedulerBundle\Interfaces\ReferenceInterface;
use Habu\TaskSchedulerBundle\Traits\SchedulerServiceAwareTrait;

class MethodProxy
{
    use SchedulerServiceAwareTrait;

    /**
     * @var string
     */
    private $cls;

    /**
     * @var string
     */
    private $method;

    /**
     * MethodProxy is a proxy object that will forward method calls with
     * the original parameters to the scheduler responsible for scheduling
     * execution of the task.
     *
     * @param string $cls
     * @param string $method
     */
    public function __construct($cls, $method)
    {
        $this->cls = $cls;
        $this->method = $method;
    }

    /**
     * Defer execution of this task to the background.
     *
     * @param array ...$args
     *
     * @return ReferenceInterface
     */
    public function delay(...$args): ReferenceInterface
    {
        return $this
            ->getSchedulerService()
            ->schedule($this->cls, $this->method, $args, new \DateTime());
    }

    /**
     * Defer execution of this task to the background, to be executed
     * at a very specific point in time.
     *
     * @param \DateTime $dateTime
     * @param array     ...$args
     *
     * @return ReferenceInterface
     */
    public function schedule(\DateTime $dateTime, ...$args): ReferenceInterface
    {
        return $this
            ->getSchedulerService()
            ->schedule($this->cls, $this->method, $args, $dateTime);
    }
}
