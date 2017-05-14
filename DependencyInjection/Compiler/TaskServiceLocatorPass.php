<?php

namespace Habu\TaskSchedulerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TaskServiceLocatorPass implements CompilerPassInterface
{
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
