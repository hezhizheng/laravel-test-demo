<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/18
 * Time: 16:10
 * Created by PhpStorm.
 */

namespace App\Services\Lock;


use App\Services\Redis\RedisFuncService;

class RedisLock implements LockInterface
{
    protected $redisConnectName;
    protected $redisFuncService;

    public function __construct(string $redisConnectName = '')
    {
        $this->redisConnectName = $redisConnectName;
        $this->redisFuncService = new RedisFuncService($this->redisConnectName);
    }

    /**
     * @param string $key
     * @param callable $func
     * @param array $option
     * @return mixed
     * @throws \Exception
     */
    public function optimismLock(string $key, callable $func, array $option = [])
    {
        list($value, $ttl) = $this->serializationOptions($option);

        return $this->redisFuncService->optimismLock($key, $func, $value, $ttl);
    }

    /**
     * @param string $key
     * @param callable $func
     * @param array $option
     * @return mixed
     * @throws \Exception
     */
    public function pessimisticLock(string $key, callable $func, array $option = [])
    {
        list($value, $ttl) = $this->serializationOptions($option);
        return $this->redisFuncService->pessimisticLock($key, $func, $value, $ttl);
    }

    /**
     * @param array $option
     * @return array
     */
    private function serializationOptions(array $option = [])
    {
        $value = $option['value'] ?? RedisFuncService::LOCK_VALUE;
        $ttl = $option['ttl'] ?? RedisFuncService::LOCK_TTL;

        return [$value, $ttl];
    }
}
