<?php

namespace Habu\TaskSchedulerBundle\Service;

use Psr\Container\ContainerInterface;
use Habu\TaskSchedulerBundle\Interfaces\ReferenceInterface;

class SchedulerService
{
    /**
     * @var ContainerInterface
     */
    private $producerLocator;

    /**
     * SchedulerService constructor.
     *
     * @param ContainerInterface $producerLocator
     */
    public function __construct(ContainerInterface $producerLocator)
    {
        $this->producerLocator = $producerLocator;
    }

    /**
     * @TODO - Replace static call to transient producer with real logic from configuration
     */
    public function schedule($cls, $method, $args, \DateTime $when): ReferenceInterface
    {
        $producer = $this->producerLocator->get('transient');

        return $producer->produce($cls, $method, $args, $when);
    }
}
