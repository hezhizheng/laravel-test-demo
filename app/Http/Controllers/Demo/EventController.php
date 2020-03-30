<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/3/30
 * Time: 10:42
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use App\Events\TestEvent;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        event(new TestEvent());
    }
}
