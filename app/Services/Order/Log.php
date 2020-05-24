<?php


namespace App\Services\Order;


class Log implements BehaviorOrderCreateInterface
{

    public function do(RobotOrderCreate $robotOrderCreate)
    {
        // TODO: Implement do() method.
        $do =  __CLASS__ . '' . __FUNCTION__ . PHP_EOL;
        var_dump($do);
    }
}
