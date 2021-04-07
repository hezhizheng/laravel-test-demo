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

    public function __construct(LockInterface $lockInterface)
    {
        $this->lockInterface = $lockInterface;
        $this->service = $lockInterface;
    }

    public function lock(string $funcName, ...$arguments)
    {
        $funcName = $funcName . 'Lock';

        return $this->lockInterface->$funcName(... $arguments);
    }
}
