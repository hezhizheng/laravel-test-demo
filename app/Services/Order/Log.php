<?php


namespace App\Services\Order;


class Log implements BehaviorOrderCreateInterface
{

    public function do(RobotOrderCreate $robotOrderCreate)
    {
        // TODO: Implement do() method.
        $do = __CLASS__ . '' . __FUNCTION__ . PHP_EOL;
        dump($do);
        dump("这里是log 实现类，获取上下文信息为",$robotOrderCreate->context);
    }
}
