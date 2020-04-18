<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/18
 * Time: 16:04
 * Created by PhpStorm.
 */

namespace App\Services\Lock;

interface LockInterface
{
    public function optimismLock(string $key, callable $func, array $option = []);

    public function pessimisticLock(string $key, callable $func, array $option = []);
}
