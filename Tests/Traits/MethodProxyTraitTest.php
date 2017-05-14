<?php

namespace Habu\TaskSchedulerBundle\Tests;

use Habu\TaskSchedulerBundle\Service\SchedulerService;
use Habu\TaskSchedulerBundle\Traits\MethodProxyTrait;
use PHPUnit\Framework\TestCase;

class MyClass
{
    use MethodProxyTrait;
    public function test($a, $b) {}
}


final class MethodProxyTraitTest extends TestCase
{
    private $m;

    protected function setUp()
    {
        $this->m = new MyClass();
        $this->m->setSchedulerService($this->createMock(SchedulerService::class));
    }

    public function testHasCorrectMethods()
    {
        $this->assertTrue(method_exists($this->m->test, 'delay'));
        $this->assertTrue(method_exists($this->m->test, 'schedule'));
    }
}