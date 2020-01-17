<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/10
 * Time: 20:55
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class DebugController
{
    /**
     * 返回微秒级流水
     * @link https://www.php.net/manual/zh/function.date.php
     * @return string|array
     * @throws \Exception
     */
    public function time()
    {
//        $now = (new \DateTime())->format("YmdHisu");
        $now = $this->GenerateUniqueCode();

        logger($now);

//        $insert = DB::table('time')->insert([
//            'time' => $now
//        ]);

        return compact('now','insert');
    }

    public function GenerateUniqueCode()
    {
        $microsecond = (new \DateTime())->format("YmdHisu");

        // 6.0 推荐用 phpredis（C扩展） 了 不是 predis(纯php实现)
        do{
            $lock = Redis::set("GenerateUniqueCode:".$microsecond, "GenerateUniqueCode", 'NX', 'EX', 1);
        }while (!$lock);

        return $microsecond;

    }
}
