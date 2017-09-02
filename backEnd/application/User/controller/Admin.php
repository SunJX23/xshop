<?php

namespace app\user\controller;

use app\common\controller\Common;
use think\Request;
use think\Model;

use app\user\model\User;

class Admin extends Common
{
    protected static $user;

    // 初始化
    public function _initialize()
    {
        parent::_initialize();
        Admin::$user = new User();
    }

    public function signIn()
    {
        return;
    }

    public function signUp()
    {
        return json_encode(Admin::$user->insertUser());
    }

    public function checkUID()
    {
        return json_encode(Admin::$user->checkIdExisted());
    }

    public function test()
    {

    }
    
}