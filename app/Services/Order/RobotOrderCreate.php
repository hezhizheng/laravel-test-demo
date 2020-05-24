<?php

namespace App\Services\Order;


class RobotOrderCreate
{
    private $infoUser = [];

    private $behaviorList = [];

    public function __construct()
    {

    }

    public function registerBehavior(\Closure ...$behavior)
    {
        $this->behaviorList = array_merge($this->behaviorList, $behavior);
        return $this;
    }

    public function create()
    {
        try {
            /** @var \Closure $behavior */
            foreach ($this->behaviorList as $behavior) {
                /** @var BehaviorOrderCreateInterface $interface */
                $interface = $behavior();
                $interface->do($this);
            }
        } catch (\Exception $exception) {

        }
    }
}


