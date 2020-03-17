<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/3/6
 * Time: 11:05
 * Created by PhpStorm.
 */

namespace Tests\Unit;

use App\Models\Time;
use App\Services\Utils\Helper;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RedisTest extends TestCase
{
    public function testHset()
    {

       $x = Redis::hset("xxxx",'123','3456');

       dump($x);
       $this->assertTrue(true);
    }

    public function testHget()
    {
        $x = Redis::hget("xxxx",'123');

        dump($x,get_class_methods(Redis::class));
        $this->assertTrue(true);
    }
}
