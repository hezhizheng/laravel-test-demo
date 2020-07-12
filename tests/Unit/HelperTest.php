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

    public function test_binaryQuery()
    {
        $ary = [1,2,3,4,5,6,7,8];
        $t = 7;
//        $index = Helper::binaryQuery($ary,$t);
        $index = Helper::binaryQueryRecursive($ary,$t);

        dump($index);

        $this->assertTrue(true);
    }

    public function test_sort()
    {
        $ary = [4,3,0,2,1];
        $index = Helper::bubbleSort($ary);

        dump($index);
        $this->assertTrue(true);
    }
}
