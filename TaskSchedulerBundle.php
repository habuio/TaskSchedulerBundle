<?php

namespace Habu\TaskSchedulerBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Habu\TaskSchedulerBundle\DependencyInjection\Compiler\InjectSchedulerServicePass;
use Habu\TaskSchedulerBundle\DependencyInjection\Compiler\ProducerServiceLocatorPass;
use Habu\TaskSchedulerBundle\DependencyInjection\Compiler\TaskServiceLocatorPass;

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
