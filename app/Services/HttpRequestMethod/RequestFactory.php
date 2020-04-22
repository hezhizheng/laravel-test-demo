<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/23
 * Time: 1:21
 * Created by PhpStorm.
 */

namespace App\Services\HttpRequestMethod;


class RequestFactory
{
    protected static $request_type;

    protected static $request_map = [
        'GET' => 'App\Services\HttpRequestMethod\HttpGet',
        'POST' => 'App\Services\HttpRequestMethod\HttpGet',
        'PUT' => 'App\Services\HttpRequestMethod\HttpGet',
        'DELETE' => 'App\Services\HttpRequestMethod\HttpGet',
    ];

    public static function create()
    {
        return new self::$request_map[$_SERVER['REQUEST_METHOD']];
    }

    public static function request($input)
    {
        return self::create()->request($input);
    }


}
