<?php

namespace Habu\TaskSchedulerBundle;

use Habu\TaskSchedulerBundle\Interfaces\SchedulableInterface;
use Habu\TaskSchedulerBundle\Traits\SchedulerAwareTrait;

abstract class Task implements SchedulableInterface
{
    use SchedulerAwareTrait;
}
