<?php

namespace Habu\TaskSchedulerBundle\Interfaces;

interface ProducerInterface
{
    public function produce($cls, $method, $args): ReferenceInterface;
}
