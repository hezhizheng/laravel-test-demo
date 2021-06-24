<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/18
 * Time: 16:14
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use App\Http\Controllers\Controller;
use App\Services\Lock\FileLock;
use App\Services\Lock\PolicyLock;
use App\Services\Lock\RedisLock;
use Illuminate\Http\Request;

class LockController extends Controller
{
//    protected $policyLock;
//
//    public function __construct(PolicyLock $policyLock)
//    {
//        $this->policyLock = $policyLock;
//    }

    public function index(Request $request)
    {
        $policyLock = new PolicyLock(new RedisLock('default2'));
//        $policyLock = new PolicyLock(new FileLock());

//        $pessimisticLock = $policyLock->service->pessimisticLock('pessimistic',function (){
//            return '$pessimisticLock'.'service';
//        });

        $pessimisticLock = $policyLock->serve()->pessimisticLock('pessimistic',function (){
            return '$pessimisticLock'.'service';
        });

        $optimismLock = $policyLock->lock('optimism', 'optimism', function () {
//            logger('$optimismLock');
//            sleep(5);
            return '$optimismLock';
        });

        $pessimisticLock = $policyLock->lock('pessimistic', 'pessimistic', function () {
            logger('$pessimisticLock');
//            sleep(5);
            return '$pessimisticLock';
        });

        dd($optimismLock, $pessimisticLock);

    }
}
