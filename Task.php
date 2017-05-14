<?php

namespace Habu\TaskSchedulerBundle;

use Habu\TaskSchedulerBundle\Interfaces\SchedulableInterface;
use Habu\TaskSchedulerBundle\Traits\MethodProxyTrait;
use Habu\TaskSchedulerBundle\Traits\SchedulerServiceAwareTrait;

/**
 * Shortcut class to be elegantly able to define Task classes without
 * needing to concern yourself with using Traits.
 */
abstract class Task implements SchedulableInterface
{
    use SchedulerServiceAwareTrait;
    use MethodProxyTrait;
}
