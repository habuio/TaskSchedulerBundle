<?php

namespace Habu\TaskSchedulerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class InjectSchedulerServicePass implements CompilerPassInterface
{
    /**
     * Compiler pass to abstract away the need to manually define the
     * argument '@task_scheduler.scheduler_service' for each task's
     * constructor, and instead be able to just append a service tag.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('task_scheduler.scheduler_service')) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds('task_scheduler.task');
        $scheduler = new Reference('task_scheduler.scheduler_service');

        foreach ($taggedServices as $id => $attrs) {
            $definition = $container->findDefinition($id);
            $definition->addMethodCall('setSchedulerService', [$scheduler]);
        }
    }
}
