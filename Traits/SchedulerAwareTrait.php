<?php

namespace Habu\TaskSchedulerBundle\Traits;

use TaskSchedulerBundle\Proxy\MethodProxy;
use TaskSchedulerBundle\Reference;
use TaskSchedulerBundle\Service\SchedulerService;

trait SchedulerAwareTrait
{
    /**
     * @var SchedulerService
     */
    private $schedulerService;

    /**
     * @param SchedulerService $schedulerService
     */
    public function setSchedulerService(SchedulerService $schedulerService)
    {
        $this->schedulerService = $schedulerService;
    }

    /**
     * @return SchedulerService
     */
    protected function getSchedulerService(): SchedulerService
    {
        return $this->schedulerService;
    }

    /**
     * @param $name
     * @return MethodProxy
     * @throws \Exception
     */
    public function __get($name): MethodProxy
    {
        if (!method_exists($this, $name)) {
            throw new \Exception('Cannot schedule non-existant method.');
        }

        return new MethodProxy($this->getSchedulerService(), get_class($this), $name);
    }
}
