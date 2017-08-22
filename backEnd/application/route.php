<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // '__pattern__' => [
    //     'name' => '\w+',
    // ],
    // '[hello]'     => [
    //     ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
    //     ':name' => ['index/hello', ['method' => 'post']],
    // ]
    '' => 'util/base/index',

    'signin' => 'user/admin/signin',
    'signup' => 'user/admin/signup',
    'checkUId' => 'user/admin/checkUID',

    // '[user]' => [
    //     ':signin' => 'User/User/signin',
    //     ':signup' => 'User/User/signup'
    // ],

    // MISS路由
	'__miss__'  => 'util/base/miss'
];
