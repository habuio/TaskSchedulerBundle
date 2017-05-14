<?php

namespace Habu\TaskSchedulerBundle;

use Habu\TaskSchedulerBundle\Interfaces\SchedulableInterface;
use Habu\TaskSchedulerBundle\Traits\SchedulerServiceAwareTrait;

abstract class Task implements SchedulableInterface
{
    use SchedulerServiceAwareTrait;
}
