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
     * 生成唯一id(微秒级时间戳),悲观锁/互斥
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
     * 生成唯一id(微秒级时间戳),乐光锁
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


    /**
     * @param $message
     * @param string $title
     * @return array|bool|string
     * @throws \Exception
     */
    public static function dingTalkRobot($message, $title = '测试')
    {
        $access_token = config('ding.reboot.token');
        $webhook = "https://oapi.dingtalk.com/robot/send?access_token=" . $access_token;

        if (is_array($message)) {
            $message = json_encode($message);
        }

        $data = [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => $title,
                'text' => date('Y-m-d H:i:s') . "：\n" . "### " . $title . "\n" . $message,
            ]
        ];
        $data_string = json_encode($data);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $webhook);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
            // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * 二分查找
     * todo 有问题！！！
     * @param $ary
     * @param $target
     * @return int
     */
    public static function binarySearch($ary, $target)
    {
        $len = count($ary);

//        return $len;
        $left = 0;
        $right = $len - 1;

        while ($left <= $right) {
            $m = intval(($left + $right) % 2);
            dump($m);
            if ($ary[$m] == $target )
            {
                return $m;
            }elseif ( $ary[$m] < $target ){
                $left = $m +1;
            }elseif ($ary[$m] > $target){
                $right = $m -1;
            }

        }

        return -1;

    }
}
