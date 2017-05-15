<?php

namespace Habu\TaskSchedulerBundle\Worker;

use Psr\Container\ContainerInterface;

class Worker
{
    /**
     * @var ContainerInterface
     */
    private $taskLocator;

    /**
     * Worker constructor.
     *
     * @param ContainerInterface $taskLocator
     */
    public function __construct(ContainerInterface $taskLocator)
    {
        $this->taskLocator = $taskLocator;
    }

    /**
     * Execute a method on a task service contained within our
     * service locator.
     *
     * @param string $cls
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function run($cls, $method, $args)
    {
        if (!$this->taskLocator->has($cls)) {
            throw new \Exception(sprintf('No task for class \'%s\' defined.', $cls));
        }

        $task = $this->taskLocator->get($cls);

        return call_user_func_array([$task, $method], $args);
    }
}
