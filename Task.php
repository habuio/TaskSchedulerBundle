<?php

namespace Habu\TaskSchedulerBundle;

use TaskSchedulerBundle\Interfaces\SchedulableInterface;
use TaskSchedulerBundle\Traits\SchedulerAwareTrait;

abstract class Task implements SchedulableInterface
{
    use SchedulerAwareTrait;
}
