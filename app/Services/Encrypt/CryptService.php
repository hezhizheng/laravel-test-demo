<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:06
 * Created by PhpStorm.
 */

namespace App\Services\Encrypt;


class CryptService implements RobotEncryptInterface
{
    public function encrypt(PolicyEncrypt $policyEncrypt)
    {
        return crypt($policyEncrypt->string);
    }
}
