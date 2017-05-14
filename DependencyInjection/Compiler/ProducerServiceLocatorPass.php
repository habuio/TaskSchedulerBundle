<?php

namespace Habu\TaskSchedulerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ProducerServiceLocatorPass implements CompilerPassInterface
{
    /**
     * Dynamically build a service locator object of all producer services
     * defined in the service definition of an application.
     *
     * This prevents the need to inject a full container into the scheduler
     * service, which offers too broad access to that service.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('task_scheduler.producer_locator')) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds('task_scheduler.producer');
        $locator = $container->getDefinition('task_scheduler.producer_locator');

        $producers = [];

        foreach ($taggedServices as $id => $attrs) {
            $key = array_slice(explode('.', $id), -1)[0];
            $producers[$key] = new Reference($id);
        }

        $locator->setArguments([$producers]);
    }
}
