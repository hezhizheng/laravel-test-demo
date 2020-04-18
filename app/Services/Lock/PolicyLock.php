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

    public function __construct(LockInterface $lockInterface)
    {
        $this->lockInterface = $lockInterface;
    }

    public function lock(string $funcName, ...$arguments)
    {
        $funcName = $funcName . 'Lock';

        return $this->$funcName(... $arguments);
    }

    private function optimismLock(...$arguments)
    {
        return $this->lockInterface->optimismLock(... $arguments);
    }

    private function pessimisticLock(...$arguments)
    {
        return $this->lockInterface->pessimisticLock(... $arguments);
    }
}
