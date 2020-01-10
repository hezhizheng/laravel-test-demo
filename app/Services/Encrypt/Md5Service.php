<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:03
 * Created by PhpStorm.
 */

namespace App\Services\Encrypt;


use App\User;

class Md5Service implements RobotEncryptInterface
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function encrypt(string $string)
    {
        return md5($string);
    }
}
