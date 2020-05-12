<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/5/12
 * Time: 23:51
 * Created by PhpStorm.
 */

namespace App\Services\Users;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
       return $this->userRepository->model()->all();
    }
}
