<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/10
 * Time: 13:57
 * Created by PhpStorm.
 */

namespace App\Services\Encrypt;

class EncryptFactory
{
    private static $map = [
        'md5' => 'App\Services\Encrypt\Md5Service',
        'sha1' => 'App\Services\Encrypt\Sha1Service',
        'crypt' => 'App\Services\Encrypt\CryptService',
    ];

    /**
     * @param $type
     * @return CryptService|Md5Service|Sha1Service|RobotEncryptInterface
     * @throws \Exception
     */
    public static function create($type)
    {
//        switch ($type) {
//            case 'md5';
//                return new Md5Service();
//                break;
//            case 'sha1';
//                return new Sha1Service();
//                break;
//            case 'crypt';
//                return new CryptService();
//                break;
//            default :
//                throw new \Exception("not support type!");
//        }

        return new self::$map[$type];
    }
}
