<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:11
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;

use App\Services\Encrypt\EncryptFactory;
use App\Services\Encrypt\PolicyEncrypt;
use App\Services\Encrypt\RobotEncryptInterface;
use Illuminate\Http\Request;


class EncryptController extends Controller
{
    /** @var RobotEncryptInterface|PolicyEncrypt $policyEncrypt */
    protected $policyEncrypt;

    public function __construct(PolicyEncrypt $policyEncrypt)
    {
        $this->policyEncrypt = $policyEncrypt;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function encrypt(Request $request)
    {
        $string = $request->string;

        $robot = EncryptFactory::create($request->type);

        return $this->policyEncrypt->encrypt($robot, $string);
    }
}
