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

        $type = $_SERVER['REQUEST_METHOD'];

        parse_str(file_get_contents('php://input'), $data);

        $data = array_merge($_GET, $_POST, $data);
        return $input;
    }
}
{

}
