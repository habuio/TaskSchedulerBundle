<?php

namespace Habu\TaskSchedulerBundle\Tests;

use Habu\TaskSchedulerBundle\Service\SchedulerService;
use Habu\TaskSchedulerBundle\Traits\SchedulerServiceAwareTrait;
use PHPUnit\Framework\TestCase;

class MyClass2
{
    use SchedulerServiceAwareTrait { getSchedulerService as public; }
}


final class SchedulerServiceAwareTraitTest extends TestCase
{
    private $m;

    protected function setUp()
    {
        $this->m = new MyClass2();
    }

    public function testHasCorrectMethods()
    {
        $this->assertTrue(method_exists($this->m, 'setSchedulerService'));
        $this->assertTrue(method_exists($this->m, 'getSchedulerService'));
    }

    public function testInjectingWorks()
    {
        $mock = $this->createMock(SchedulerService::class);
        $this->m->setSchedulerService($mock);

        $this->assertEquals($mock, $this->m->getSchedulerService());
    }
}