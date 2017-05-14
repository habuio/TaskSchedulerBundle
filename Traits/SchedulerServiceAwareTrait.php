<?php

namespace Habu\TaskSchedulerBundle\Traits;

use Habu\TaskSchedulerBundle\Proxy\MethodProxy;
use Habu\TaskSchedulerBundle\Reference;
use Habu\TaskSchedulerBundle\Service\SchedulerService;

trait SchedulerServiceAwareTrait
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