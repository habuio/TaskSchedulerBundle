<?php

namespace Habu\TaskSchedulerBundle\Service;

use Psr\Container\ContainerInterface;
use TaskSchedulerBundle\Interfaces\ReferenceInterface;

class SchedulerService
{
    private $producerLocator;

    public function __construct(ContainerInterface $producerLocator)
    {
        $this->producerLocator = $producerLocator;
    }

    /**
     * @TODO - Replace static call to transient producer with real logic from configuration
     */
    public function schedule($cls, $method, $args, \DateTime $dateTime): ReferenceInterface
    {
        $producer = $this->producerLocator->get('transient');

        return $producer->produce($cls, $method, $args);
    }
}
