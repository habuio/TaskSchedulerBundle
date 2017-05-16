<?php

namespace Habu\TaskSchedulerBundle\DependencyInjection\Compiler;

use Habu\TaskSchedulerBundle\Service\SchedulerService;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class InjectSchedulerServicePass implements CompilerPassInterface
{
    /**
     * Compiler pass to abstract away the need to manually define the
     * argument to inject task scheduler for each task's
     * constructor, and instead be able to just append a service tag.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(SchedulerService::class)) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds('task_scheduler.task');
        $scheduler = new Reference(SchedulerService::class);

        foreach ($taggedServices as $id => $attrs) {
            $definition = $container->findDefinition($id);
            $definition->addMethodCall('setSchedulerService', [$scheduler]);
        }
    }
}
