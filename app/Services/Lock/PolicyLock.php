<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/18
 * Time: 16:18
 * Created by PhpStorm.
 */

namespace App\Services\Lock;


class PolicyLock
{
    private $lockInterface;

    public $service;

    private $serve;

    public function __construct(LockInterface $lockInterface)
    {
        $this->lockInterface = $lockInterface;
        $this->service = $lockInterface;
        $this->serve = $lockInterface;
    }

    /**
     * @return LockInterface
     */
    public function serve() :LockInterface
    {
        return $this->serve;
    }

    public function lock(string $funcName, ...$arguments)
    {
        $funcName = $funcName . 'Lock';

        return $this->lockInterface->$funcName(... $arguments);
    }
}
