<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/4/18
 * Time: 16:08
 * Created by PhpStorm.
 */

namespace App\Services\Lock;


use App\Services\Redis\RedisFuncService;

class FileLock implements LockInterface
{
    public function optimismLock(string $file_name, callable $func, array $option = [])
    {
        list($mode) = $this->serializationOptions($option);

        $file_name = storage_path($file_name);
        $fp = fopen($file_name, $mode);


        try {

            if (!flock($fp, LOCK_EX | LOCK_NB)) { // 强占锁，不阻塞，$function没执行完直接返回错误
                throw new \Exception("file locking");
            }

            $func = $func();

            flock($fp, LOCK_UN);

            fclose($fp);

            @unlink($file_name);
        } catch (\Exception $exception) {
            flock($fp, LOCK_UN);

            fclose($fp);

            @unlink($file_name);
            throw new \Exception($exception->getMessage());
        }

        return $func;

    }

    public function pessimisticLock(string $file_name, callable $func, array $option = [])
    {
        list($mode) = $this->serializationOptions($option);

        $file_name = storage_path($file_name);

        $fp = fopen($file_name, $mode);

        try {
            if (flock($fp, LOCK_EX)) { // 强占锁 ，阻塞，执行完$function 才解锁
                $func = $func();
                flock($fp, LOCK_UN);
            }
            fclose($fp);
            @unlink($file_name);
        } catch (\Exception $exception) {
            flock($fp, LOCK_UN);
            fclose($fp);
            @unlink($file_name);
            throw new \Exception($exception->getMessage());
        }

        return $func;
    }

    /**
     * @param array $option
     * @return array
     */
    private function serializationOptions(array $option = [])
    {
        $model = $option['model'] ?? "a+";

        return [$model];
    }
}
