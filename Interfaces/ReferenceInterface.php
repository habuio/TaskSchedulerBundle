<?php

namespace Habu\TaskSchedulerBundle\Interfaces;

interface ReferenceInterface
{
    /**
     * Wait for, and return the result of deferred executed
     * task method.
     *
     * @return mixed
     */
    public function get();

    /**
     * Calling this method blocks execution of application
     * flow until the execution of associated deferred task
     * has been completed, and a result is available.
     *
     * @return void
     */
    public function wait();
}
