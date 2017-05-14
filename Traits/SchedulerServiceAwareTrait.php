<?php

namespace Habu\TaskSchedulerBundle\Traits;

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
}
