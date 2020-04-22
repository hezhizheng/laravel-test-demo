<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/23
 * Time: 1:05
 * Created by PhpStorm.
 */

namespace App\Services\HttpRequestMethod;


interface RequestInterface
{
//    public function get();
//    public function post();
//    public function put();
//    public function delete();

    public function request($input);
}
