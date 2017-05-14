<?php

namespace Habu\TaskSchedulerBundle\Worker;

use Psr\Container\ContainerInterface;

class Worker
{
    private $taskLocator;

    public function __construct(ContainerInterface $taskLocator)
    {
        $this->taskLocator = $taskLocator;
    }

    public function run($cls, $method, $args)
    {
        if (!$this->taskLocator->has($cls)) {
            throw new \Exception('No such task.');
        }

        $task = $this->taskLocator->get($cls);

        return call_user_func_array([$task, $method], $args);
    }
}
