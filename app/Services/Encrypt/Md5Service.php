<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:03
 * Created by PhpStorm.
 */

namespace App\Services\Encrypt;


class Md5Service implements RobotEncryptInterface
{
    public function encrypt(PolicyEncrypt $policyEncrypt)
    {
        return md5($policyEncrypt->string);
    }
}
