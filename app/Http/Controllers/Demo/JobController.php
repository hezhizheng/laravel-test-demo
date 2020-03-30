<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/3/30
 * Time: 11:31
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use App\Http\Controllers\Controller;
use App\Jobs\DingTalk;

class JobController extends Controller
{
    public function index()
    {
        logger(__CLASS__.__FUNCTION__);
        DingTalk::dispatch();
        dump(__CLASS__.__FUNCTION__);
    }
}
