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

    public function __construct(Request $request)
    {
        $this->type = $request->type;
        $this->string = $request->string;
    }

    public function policy()
    {
        return $this->{$this->type};
    }

    public function md5()
    {
       return new Md5Service();
    }

    public function crypt()
    {
        return new CryptService();
    }

    public function sha1()
    {
        return new Sha1Service();
    }
}
