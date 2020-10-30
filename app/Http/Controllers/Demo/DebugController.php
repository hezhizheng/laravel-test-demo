<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/10
 * Time: 20:55
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use App\Services\Redis\PolicyRedisFunc;
use App\Services\Redis\RedisFuncService;
use App\Services\Utils\Helper;
use Hzz\File;
use Hzz\FreePic;


class DebugController
{
    protected $redisFuncService;

    protected $redisConnectName = 'default2';

    public function __construct()
    {
        $redisFuncService = new RedisFuncService($this->redisConnectName);

//        $this->redisFuncService = new PolicyRedisFunc($redisFuncService);
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
        //        $now = Helper::generateUniqueCode();
        $now = Helper::generateUniqueCodeOptimism();

        dd($this->redisFuncService->set('wq1eqeq', $now, -1));


        logger($now);

        return compact('now', 'insert');
    }

    /**
     * @link http://varobj.com/Blog/PHP_2019-09-06_%E9%9B%AA%E8%8A%B1%E7%AE%97%E6%B3%95-PHP%E7%89%88%E6%9C%AC%EF%BC%88%E5%9F%BA%E4%BA%8E%E4%BF%A1%E5%8F%B7%E9%87%8F%EF%BC%89%E7%9A%84%E5%AE%9E%E7%8E%B0.md
     * @link https://github.com/godruoyi/php-snowflake
     * @return string
     * @throws \Exception
     */
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

    public function dd()
    {
        $yieldAry = $this->yieldAry();

//        dd($yieldAry);
        foreach ($yieldAry as $item) {
//            sleep(1);
            echo $item . "\n";
        }

    }

    /**
     * @return array|\Generator
     */
    private function yieldAry()
    {
        $ary = [];

        // 800W 左右就凉了，跟ini的内存设定有关，这么大的数据
        // yield可以输出,到了最大内存设定一样会抛出内存不足的问题
        for ($i = 0; $i < 70000000; $i++) {
//            usleep(500);
            yield array_push($ary, $i); // 用 yield 不用返回值
//            array_push($ary, $i);
        }

//        return $ary;
    }

    public function freePic()
    {
        dump(request()->method());
        if ( request()->method() == "POST" ) {
            $path = File::singleton()->upload();
            $url = FreePic::create()->upload($path);
            File::singleton()->delete($path);
            dd($url);
        }

       return view('free-pic.upload');
    }

}
