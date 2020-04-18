<?php
/**
 * @deprecated 实际有点多余
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:40
 * Created by PhpStorm.
 */

namespace App\Services\Redis;

class PolicyRedisFunc
{
    protected $redisFunc;

    public function __construct(RedisFuncInterface $redisFunc)
    {
        $this->redisFunc = $redisFunc;
    }

    public function set(
        string $key,
        string $value = RedisFuncService::LOCK_VALUE,
        int $ttl = RedisFuncService::LOCK_TTL
    ) {
        return $this->redisFunc->set($key, $value, $ttl);
    }

    public function lock(
        string $key,
        string $value = RedisFuncService::LOCK_VALUE,
        int $ttl = RedisFuncService::LOCK_TTL
    ) {
        return $this->redisFunc->lock($key, $value, $ttl);
    }

    public function unlock(string $key, $value = RedisFuncService::LOCK_VALUE)
    {
        return $this->redisFunc->unlock($key, $value);
    }

    public function optimismLock(
        string $key,
        callable $function,
        string $value = RedisFuncService::LOCK_VALUE,
        int $ttl = RedisFuncService::LOCK_TTL
    ) {
        return $this->redisFunc->optimismLock($key, $function, $value, $ttl);
    }

    public function pessimisticLock(
        string $key,
        callable $function,
        string $value = RedisFuncService::LOCK_VALUE,
        int $ttl = RedisFuncService::LOCK_TTL
    ) {
        return $this->redisFunc->pessimisticLock($key, $function, $value, $ttl);
    }
}
