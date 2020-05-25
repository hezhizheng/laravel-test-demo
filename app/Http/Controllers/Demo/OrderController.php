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
use App\Services\Order\OrderService;
use App\Services\Order\RobotOrderCreate;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request, RobotOrderCreate $robotOrderCreate)
    {
        $this->orderService->create($request->all(), $robotOrderCreate);
    }
}
