<?php

namespace Habu\TaskSchedulerBundle\Tests\Producer;

use Habu\TaskSchedulerBundle\Interfaces\ReferenceInterface;
use Habu\TaskSchedulerBundle\Producer\NoneProducer;
use PHPUnit\Framework\TestCase;

class NoneProducerTest extends TestCase
{
    private $producer;

    protected function setUp()
    {
        $this->producer = new NoneProducer();
    }

    public function testGetNone()
    {
        $ref = $this->producer->produce(self::class, 'bla', []);

        $this->assertInstanceOf(ReferenceInterface::class, $ref);
        $this->assertEquals(null, $ref->get());
    }
}