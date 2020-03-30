<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/3/30
 * Time: 10:03
 * Created by PhpStorm.
 */
namespace Tests\Unit;

use App\Events\TestEvent;
use Tests\TestCase;

class EventTest extends TestCase
{
    public function testEventTransfer()
    {
        // 这里为什么会 sync ？？？
        event(new TestEvent());

        $this->assertTrue(true);
    }
}
