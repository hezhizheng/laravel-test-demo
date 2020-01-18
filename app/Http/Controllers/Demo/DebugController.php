<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/10
 * Time: 20:55
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use App\Services\Redis\RedisFuncService;


class DebugController
{
    protected $redisFuncService;

    public function __construct(RedisFuncService $redisFuncService)
    {
        $this->redisFuncService = $redisFuncService;
    }

    /**
     * 返回微秒级流水
     * @link https://www.php.net/manual/zh/function.date.php
     * @return string|array
     * @throws \Exception
     */
    public function time()
    {

        $now = $this->GenerateUniqueCode();

        logger($now);

//        $insert = DB::table('time')->insert([
//            'time' => $now
//        ]);

        return compact('now', 'insert');
    }

    public function GenerateUniqueCode()
    {
        $microsecond = (new \DateTime())->format("YmdHisu");

        $lock = $this->redisFuncService->set("GenerateUniqueCode:" . $microsecond, RedisFuncService::LOCK_VALUE, 1);

        if (!$lock) {
            logger("重复：" . $microsecond);
            return $this->GenerateUniqueCode();
        }

        return $microsecond;

    }

    public function testRedisLock()
    {
        $k = "xxx";
        $v = "xxx";
        $x = $this->redisFuncService->lock($k);

        $y = null;

        if (!$x) {
            $y = $this->redisFuncService->unlock($k);
        }

        dd($x, $y);
    }

}
