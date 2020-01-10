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
        $now = (new \DateTime())->format("YmdHisu");

        logger($now);

        $insert = DB::table('time')->insert([
            'time' => $now
        ]);

        return compact('now','insert');
    }
}
