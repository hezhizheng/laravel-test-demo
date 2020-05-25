<?php


namespace App\Services\Order;


class Order implements BehaviorOrderCreateInterface
{

    public function do(RobotOrderCreate $robotOrderCreate)
    {
        // TODO: Implement do() method.
        $do = __CLASS__ . '' . __FUNCTION__ . PHP_EOL;
        dump($do);
        // 往上下文依赖中写入 订单信息
        $robotOrderCreate->context = [
            'order_info' => $do
        ];

        return $do;
    }
}
