<?php
namespace Tests\Unit;
use App\Services\DoubleEndedQueue;
use Tests\TestCase;

/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/10/10
 * Time: 10:26
 * Created by PhpStorm.
 */

class DoubleEndedQueueTest extends TestCase
{
    public function test_run()
    {
        $queue = new DoubleEndedQueue();

        $queue->addTop('9');
        $queue->addBottom('10');
        $queue->addTop('8');

        //
        $queue->removeTop();
        $queue->removeBottom();
        $queue->removeTop();


        $all = $queue->getAll();

        dump($all);

        $this->assertTrue(true);
    }
}
