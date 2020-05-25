<?php


namespace App\Services\Order;


class OrderService
{
    public function __construct()
    {

    }

    public function create(array $params, RobotOrderCreate $robotOrderCreate)
    {
        $robotOrderCreate->registerBehavior(
            function () {
                return new Order();
            },
            function () {
                return new OrderItem();
            },
            function () {
                return new Log();
            }
        )->create();
    }
}
