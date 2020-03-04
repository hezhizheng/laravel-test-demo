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
        $microsecond = (new \DateTime())->format("YmdHisu");

        $redisFuncService = new PolicyRedisFunc(new RedisFuncService);

        $lock = $redisFuncService->set("GenerateUniqueCode:" . $microsecond, RedisFuncService::LOCK_VALUE, 1);

        if (!$lock) {
            logger("重复：" . $microsecond);
            return self::GenerateUniqueCode();
        }

        return $microsecond;
    }
}
