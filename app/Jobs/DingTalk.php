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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->os = [
            'php_os' => PHP_OS,
            'php_uname' => php_uname('s'),
        ];
    }


    /**
     * @return array|bool|string
     * @throws \Exception
     */
    public function handle()
    {
        //
        $send = Helper::dingTalkRobot($this->os, __CLASS__ . " " . __FUNCTION__);

        return $send;
    }
}
