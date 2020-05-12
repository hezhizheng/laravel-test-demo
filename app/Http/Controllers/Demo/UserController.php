<?php
/**
 * Description:
 * Author: DexterHo <dexter.ho.cn@gmail.com>
 * Date: 2020/5/12
 * Time: 23:54
 * Created by PhpStorm.
 */

namespace App\Http\Controllers\Demo;


use App\Http\Controllers\Controller;
use App\Services\Users\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
       $all =  $this->userService->all();

       dd($all);
    }
}
