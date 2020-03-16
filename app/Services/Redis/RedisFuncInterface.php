<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/1/9
 * Time: 15:00
 * Created by PhpStorm.
 */

namespace App\Services\Redis;


interface RedisFuncInterface
{
    public function set(string $key, string $value = RedisFuncService::LOCK_VALUE, int $ttl = RedisFuncService::LOCK_TTL);

    public function lock(string $key, string $value = RedisFuncService::LOCK_VALUE, int $ttl = RedisFuncService::LOCK_TTL);

    public function unlock(string $key, $value = RedisFuncService::LOCK_VALUE);

    public function optimismLock(string $key, callable $function, string $value = RedisFuncService::LOCK_VALUE, int $ttl = RedisFuncService::LOCK_TTL);

    public function pessimisticLock(string $key, callable $function, string $value = RedisFuncService::LOCK_VALUE, int $ttl = RedisFuncService::LOCK_TTL);
}
