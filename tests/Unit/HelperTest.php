<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/3/6
 * Time: 11:05
 * Created by PhpStorm.
 */

namespace Tests\Unit;

use App\Services\Utils\Helper;

use Tests\TestCase;

class HelperTest extends TestCase
{
    public function test1GenerateUniqueCode()
    {
        $code = Helper::generateUniqueCode();

        dump($code);

        $this->assertNotNull($code);
    }
}
