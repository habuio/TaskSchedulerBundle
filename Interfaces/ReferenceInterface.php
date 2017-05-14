<?php

namespace Habu\TaskSchedulerBundle\Interfaces;

interface ReferenceInterface
{
    public function get();

    public function wait();
}
