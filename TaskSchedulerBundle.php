<?php

namespace Habu\TaskSchedulerBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TaskSchedulerBundle\DependencyInjection\Compiler\InjectSchedulerServicePass;
use TaskSchedulerBundle\DependencyInjection\Compiler\ProducerServiceLocatorPass;
use TaskSchedulerBundle\DependencyInjection\Compiler\TaskServiceLocatorPass;

class TaskSchedulerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new InjectSchedulerServicePass());
        $container->addCompilerPass(new TaskServiceLocatorPass());
        $container->addCompilerPass(new ProducerServiceLocatorPass());
    }
}
