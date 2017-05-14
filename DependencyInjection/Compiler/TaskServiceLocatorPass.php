<?php

namespace Habu\TaskSchedulerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TaskServiceLocatorPass implements CompilerPassInterface
{
    /**
     * Dynamically build a service locator object of all Tasks services
     * defined in the service definitions of an application.
     *
     * This prevents the need for each application to define a fully
     * verbose service locator, or manually add all tasks to some configuration.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('task_scheduler.task_locator')) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds('task_scheduler.task');
        $locator = $container->getDefinition('task_scheduler.task_locator');

        $tasks = [];

        foreach ($taggedServices as $id => $attrs) {
            $definition = $container->findDefinition($id);
            $tasks[$definition->getClass()] = new Reference($id);
        }

        $locator->setArguments([$tasks]);
    }
}
