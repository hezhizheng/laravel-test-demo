<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/23
 * Time: 1:14
 * Created by PhpStorm.
 */

namespace App\Services\HttpRequestMethod;


class HttpGet implements RequestInterface
{

    public function request($input)
    {
        // TODO: Implement request() method.

        var_dump($input);
        return $input;
    }
}
{

}
