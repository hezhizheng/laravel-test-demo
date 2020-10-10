<?php
/**
 * Description: PHP 双向队列（头尾部的入栈与出栈）
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/10/10
 * Time: 10:11
 * Created by PhpStorm.
 */

namespace App\Services;


class DoubleEndedQueue
{
    protected $queue = [];

    public function addBottom($item)
    {
        // array_push 数组末尾追加元素
        return array_push($this->queue, $item);
    }

    public function removeBottom()
    {
        // array_pop 移除数组末尾元素
        return array_pop($this->queue);
    }

    public function addTop($item)
    {
        // array_unshift 数组头部追加元素
        return array_unshift($this->queue, $item);
    }

    public function removeTop()
    {
        // array_shift 移除数组头部元素
        return array_shift($this->queue);
    }

    public function getAll()
    {
        return $this->queue;
    }
}
