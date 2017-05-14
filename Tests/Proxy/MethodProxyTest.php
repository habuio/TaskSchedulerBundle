<?php

namespace Habu\TaskSchedulerBundle\Tests;

use Habu\TaskSchedulerBundle\Proxy\MethodProxy;
use Habu\TaskSchedulerBundle\Service\SchedulerService;
use PHPUnit\Framework\TestCase;

final class MethodProxyTest extends TestCase
{
    private $methodProxy;

    protected function setUp()
    {
        $this->methodProxy = new MethodProxy(self::class, 'doSomething');
    }

    public function testDelay()
    {
        $service = $this->createMock(SchedulerService::class);

        $service->expects($this->once())
            ->method('schedule')
            ->with(
                $this->equalTo(self::class),
                $this->equalTo('doSomething'),
                $this->equalTo([2, 2]),
                $this->anything()
            );

        $this->methodProxy->setSchedulerService($service);
        $this->methodProxy->delay(2, 2);
    }

    public function testSchedule()
    {
        $service = $this->createMock(SchedulerService::class);
        $date = new \DateTime('2017-05-05 00:00:00');

        $service->expects($this->once())
            ->method('schedule')
            ->with(
                $this->equalTo(self::class),
                $this->equalTo('doSomething'),
                $this->equalTo([2, 2]),
                $date
            );

        $this->methodProxy->setSchedulerService($service);
        $this->methodProxy->schedule($date, 2, 2);
    }
}