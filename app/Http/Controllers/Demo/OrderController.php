<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/5/12
 * Time: 23:54
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use App\Http\Controllers\Controller;
use App\Services\Order\Log;
use App\Services\Order\Order;
use App\Services\Order\OrderItem;
use App\Services\Order\RobotOrderCreate;
use App\Services\Users\UserService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $userService;

//    public function __construct(UserService $userService)
//    {
//        $this->userService = $userService;
//    }

    public function index(Request $request, RobotOrderCreate $robotOrderCreate)
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

        dd(2);
    }
}
