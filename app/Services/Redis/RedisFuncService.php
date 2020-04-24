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

class RedisFuncService implements RedisFuncInterface
{
    const LOCK_VALUE = "lock";
    const LOCK_TTL = 60;

    protected $client = null;

    public $redisConnectName = '';

    public function __construct(string $redisConnectName = '')
    {
        $this->redisConnectName = $redisConnectName;
    }

    public function client()
    {
        if ($this->client === null) {
            $this->client = Redis::connection($this->redisConnectName);
        }
        return $this->client;
    }

    /**
     * @param $key
     * @param $value
     * @param int $ttl
     * @return mixed|bool
     */
    public function set(string $key, string $value = self::LOCK_VALUE, int $ttl = self::LOCK_TTL)
    {
        if ($ttl <= 0) {
            // forever set or setex
            return $this->client()->set($key, $value);
        }
        return $this->client()->set($key, $value, "EX", $ttl, 'NX');
    }

    /**
     * set 会过期的 redis key
     * @param string $key
     * @param string $value
     * @param int $ttl
     * @return mixed
     */
    public function setExpireEx(string $key, string $value = self::LOCK_VALUE, int $ttl = self::LOCK_TTL)
    {
        if ($ttl <= 0) {
            $ttl = self::LOCK_TTL;
        }

        // todo: return $this->client()->expire($key,777); 可用
        return $this->client()->set($key, $value, "EX", $ttl);
    }


    /**
     * @param $key
     * @param $value
     * @param int $ttl
     * @return bool|mixed
     */
    public function lock(string $key, string $value = self::LOCK_VALUE, int $ttl = self::LOCK_TTL)
    {
        if ($ttl <= 0) {
            $ttl = self::LOCK_TTL;
        }
        return $this->set($key, $value, $ttl);
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
        return $this->client()->eval($script, 1, $key, $value);
    }


    /**
     * 乐观锁
     * @param string $key
     * @param callable $function
     * @param string $value
     * @param int $ttl
     * @return mixed
     * @throws \Exception
     */
    public function optimismLock(
        string $key,
        callable $function,
        string $value = RedisFuncService::LOCK_VALUE,
        int $ttl = RedisFuncService::LOCK_TTL
    )
    {
        try {
            $lock = $this->lock($key, $value, $ttl);

            if (!$lock) {
                logger("get lock fail return", compact('key'));
                throw new \Exception("locking");
            }
            // 执行主程序
            $action = $function();
            // 执行完毕，解锁
            $this->unlock($key, $value);
        } catch (\Exception $exception) {
            $this->unlock($key, $value);
            throw new \Exception($exception->getMessage());
        }

        return $action;
    }


    /**
     * 悲观锁
     * 常用于解决缓存击穿问题
     * @param string $key
     * @param callable $function
     * @param string $value
     * @param int $ttl
     * @return mixed
     * @throws \Exception
     */
    public function pessimisticLock(
        string $key,
        callable $function,
        string $value = RedisFuncService::LOCK_VALUE,
        int $ttl = RedisFuncService::LOCK_TTL
    )
    {
        try {

            do {
                $lock = $this->lock($key, $value, $ttl);

                if (!$lock) {
                    // 继续等待拿锁成功
                    logger("get lock fail waiting", compact('key'));
                    usleep(5000); // 微妙
                } else {
                    // 拿锁成功直接跳出执行主程序
                    break;
                }

            } while (!$lock);

            // 执行主程序
            $action = $function();
            // 执行完毕，解锁
            $this->unlock($key, $value);
        } catch (\Exception $exception) {
            $this->unlock($key, $value);
            throw new \Exception($exception->getMessage());
        }

        return $action;
    }
}
