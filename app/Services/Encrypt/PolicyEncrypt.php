<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:40
 * Created by PhpStorm.
 */

namespace App\Services\Encrypt;

use Illuminate\Http\Request;

class PolicyEncrypt
{
    public $type = 'md5';
    public $string = '';

    public function encrypt(RobotEncryptInterface $robotEncrypt, $string)
    {
        return $robotEncrypt->encrypt($string);
    }
}
