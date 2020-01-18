<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/18
 * Time: 18:34
 * Created by PhpStorm.
 */

namespace App\Services\Redis;


use Illuminate\Support\Facades\Redis;

class RedisFuncService
{
    const LOCK_VALUE = "lock";
    const LOCK_TTL = 60;

    /**
     * @param $key
     * @param $value
     * @param int $ttl
     * @return mixed|bool
     */
    public function set(string $key, string $value = self::LOCK_VALUE, int $ttl = self::LOCK_TTL)
    {
        if ($ttl <= 0){
            $ttl = self::LOCK_TTL;
        }
        return Redis::set($key, $value, "EX", $ttl, 'NX');
    }

    /**
     * @param $key
     * @param $value
     * @param int $ttl
     * @return bool|mixed
     */
    public function lock(string $key, string $value = self::LOCK_VALUE, int $ttl = self::LOCK_TTL)
    {
        return $this->set($key,$value,$ttl);
    }

    /**
     * @param $key
     * @param string $value
     * @return mixed|int 1 or 0
     */
    public function unlock(string $key, $value = self::LOCK_VALUE)
    {
        $script = <<<LUA
if redis.call("get",KEYS[1]) == ARGV[1]
then
    return redis.call("del",KEYS[1])
else
    return 0
end
LUA;
        return Redis::eval($script, 1, $key, $value);
    }
}
