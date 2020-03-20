<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/3/4
 * Time: 14:06
 * Created by PhpStorm.
 */

namespace App\Services\Utils;

use App\Services\Redis\PolicyRedisFunc;
use App\Services\Redis\RedisFuncService;

class Helper
{
    /**
     * 生成唯一id(微秒级时间戳)
     * @return string
     * @throws \Exception
     */
    public static function generateUniqueCode()
    {
        $redisFuncService = new PolicyRedisFunc(new RedisFuncService);

        $key = __CLASS__ . __FUNCTION__;
        return $redisFuncService->pessimisticLock($key, function () {
            return (new \DateTime())->format("YmdHisu");
        });
    }

    /**
     *
     * @return mixed
     */
    public static function generateUniqueCodeOptimism()
    {
        $redisFuncService = new PolicyRedisFunc(new RedisFuncService);

        $key = __CLASS__ . __FUNCTION__;
        return $redisFuncService->optimismLock($key, function () {
            return (new \DateTime())->format("YmdHisu");
        });
    }
}
