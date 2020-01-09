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

use App\Services\Encrypt\PolicyEncrypt;
use App\Services\Encrypt\RobotEncryptInterface;
use Illuminate\Http\Request;


class EncryptController extends Controller
{
    protected $policyEncrypt;

    public function __construct(RobotEncryptInterface $policyEncrypt)
    {
        $this->policyEncrypt = $policyEncrypt;
    }

    public function encrypt(Request $request)
    {
       return $this->policyEncrypt->encrypt( new PolicyEncrypt($request) );
    }
}
