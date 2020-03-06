<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/3/6
 * Time: 11:05
 * Created by PhpStorm.
 */

namespace Tests\Unit;

use App\Models\Time;
use App\Services\Utils\Helper;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class HelperTest extends TestCase
{
    public function test1GenerateUniqueCode()
    {
       $code = Helper::generateUniqueCode();

       $this->assertNotNull($code);
    }
}
