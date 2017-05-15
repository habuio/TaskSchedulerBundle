<?php

namespace Habu\TaskSchedulerBundle\Traits;

use Habu\TaskSchedulerBundle\Proxy\MethodProxy;

trait MethodProxyTrait
{
    use SchedulerServiceAwareTrait;

    /**
     * Use magic __get to define properties named after methods that
     * refer to special method proxies that control when a method should
     * be executed.
     *
     * @param string $name
     *
     * @return MethodProxy
     *
     * @throws \Exception
     */
    public function __get($name): MethodProxy
    {
        if (!method_exists($this, $name)) {
            throw new \Exception(sprintf('Cannot install method proxy on non-existent method \'%s\'.', $name));
        }

        $proxy = new MethodProxy(get_class($this), $name);
        $proxy->setSchedulerService($this->getSchedulerService());

        return $proxy;
    }
}
