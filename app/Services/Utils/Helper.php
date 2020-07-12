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
     * 先取数组中间的值 floor((low+top)/2) 然后通过与所需查找的数字进行比较，
     * 若比中间值大则将首值替换为中间位置下一个位置，继续第一步的操作；
     * 若比中间值小，则将尾值替换为中间位置上一个位置，继续第一步操作
     * 重复第二步操作直至找出目标数字
     * @param array $container 必须是从小到大的顺序数组 e.g 1,2,3,4,5
     * @param $search
     * @return int|string
     */
    public static function binaryQuery(array $container, $search)
    {
        $top = count($container);
        $low = 0;
        while ($low <= $top) {
            $mid = intval(floor(($low + $top) / 2));
            if (!isset($container[$mid])) {
                return '没找着哦';
            }
            if ($container[$mid] == $search) {
                return $mid;
            }
            $container[$mid] < $search && $low = $mid + 1;
            $container[$mid] > $search && $top = $mid - 1;
        }
    }

    /**
     * 递归
     * @param array $container
     * @param $search
     * @param string $top
     * @param int $low
     * @return int|string
     */
    public static function binaryQueryRecursive(array $container, $search, $top = 'default', $low = 0)
    {
        $top = is_numeric($top) ? $top : count($container);

        // floor 返回不大于 value 的最接近的整数，将 value 的小数部分舍去取整

        $mid = intval(floor(($low + $top) / 2));

        if (!isset($container[$mid])) {
            return 'no';
        }
        if ($container[$mid] == $search) {
            return $mid;
        } elseif ($container[$mid] < $search) { // 如果中间值小于搜索的值，则最小位置= mid + 1
            $low = $mid + 1;
            return self::binaryQueryRecursive($container, $search, $top, $low);
        } elseif ($container[$mid] > $search) { // 如果中间值大于搜索额值，则最大位置= mid - 1
            $top = $mid - 1;
            return self::binaryQueryRecursive($container, $search, $top, $low);
        }
    }

    /**
     * 冒泡排序(从小到大、两两比较)
     * @param array $container
     * @return array
     */
    public static function bubbleSort(array $container)
    {
        $count = count($container);
        for ($j = 1; $j < $count; $j++) {
            echo $j.PHP_EOL;
            for ($i = 0; $i < $count - $j; $i++) {
                echo 'IIIIII'.$i.PHP_EOL;
                if ($container[$i] > $container[$i + 1]) {
                    $temp = $container[$i];
                    $container[$i] = $container[$i + 1];
                    $container[$i + 1] = $temp;
                }
                // todo 一直对数组元素做两两比较
//                if ( $i==0 && $j==2)
//                {
//                    dd(3,$container);
//                }
            }
        }
        return $container;
    }
}
