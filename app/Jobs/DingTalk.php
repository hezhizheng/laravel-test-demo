<?php

namespace App\Jobs;

use App\Services\Utils\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DingTalk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $os;
    protected $mark;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data =[])
    {
        //
        $this->os = [
            'php_os' => PHP_OS,
            'php_uname' => php_uname('s'),
        ];

        $this->mark = $data;
    }


    /**
     * @return array|bool|string
     * @throws \Exception
     */
    public function handle()
    {
        //
        $msg = array_merge($this->os,$this->mark);
        $send = Helper::dingTalkRobot($msg, __CLASS__ . " " . __FUNCTION__);

        var_dump($msg);

        return $send;
    }
}
