<?php

namespace App\Listeners;

use App\Events\TestEvent;
use App\Services\Utils\Helper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TestEventListener implements ShouldQueue
{
    /**
     * 任务连接名称。
     *
     * @var string|null
     */
//    public $connection = 'sqs';

    /**
     * 任务发送到的队列的名称.
     *
     * @var string|null
     */
//    public $queue = 'listeners';

    /**
     * 处理任务的延迟时间.
     *
     * @var int
     */
//    public $delay = 60;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * @param TestEvent $event
     * @return array|bool|string
     * @throws \Exception
     */
    public function handle(TestEvent $event)
    {
        $send = Helper::dingTalkRobot($event->getOS(), __CLASS__ . " " . __FUNCTION__);

        return $send;
    }
}
