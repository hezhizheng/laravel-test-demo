<?php

namespace App\Services\Order;


use Illuminate\Support\Facades\DB;

class RobotOrderCreate
{
    private $infoUser = [];

    // 用于存储上下文的依赖
    public $context = [];

    public $rollback = 0;

    private $behaviorList = [];

    public function __construct()
    {

    }

    public function registerBehavior(\Closure ...$behavior)
    {
        $this->behaviorList = array_merge($this->behaviorList, $behavior);
        return $this;
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            /** @var \Closure $behavior */
            foreach ($this->behaviorList as $behavior) {
                // todo 按实际情况
                if ($this->rollback) {
                    throw new \Exception("rollback 1");
                    break;
                }
                /** @var BehaviorOrderCreateInterface $interface */
                $interface = $behavior();
                $interface->do($this);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
}


