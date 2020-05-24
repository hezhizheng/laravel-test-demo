<?php

namespace App\Services\Order;


interface BehaviorOrderCreateInterface
{
    public function do(RobotOrderCreate $robotOrderCreate);
}
