<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:00
 * Created by PhpStorm.
 */

namespace App\Services\Encrypt;


interface RobotEncryptInterface
{
    public function encrypt(PolicyEncrypt $policyEncrypt);
}
