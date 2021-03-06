<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:03
 * Created by PhpStorm.
 */

namespace App\Services\Encrypt;


class Sha1Service implements RobotEncryptInterface
{
    public function encrypt(string $string)
    {
        return sha1($string);
    }
}
