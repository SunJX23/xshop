<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use think\Request;
use app\Consts;

if (!function_exists('checkRequestParam')) {
    /**
     * 检查是否接收到正确的请求参数
     * @param string    $model   模型名
     * @param string    $name    参数名
     * @param string    $param_type 请求所接收的参数类型，默认为string，其他如数组为'/a'
     * @param string    $method  请求类型
     * @return boolean
     */
    function checkRequestParam($model, $name, $param_type = '', $method = 'post')
    {
        $request = Request::instance();
        $const = new Consts();

        if (!$request->has($name, $method))
            return $const -> ERROR__PARAMS_INCOMPLETE;
        
        $param = $request->$method($name.$param_type);
        if (is_null($param))
            return $const -> $error_const;
        
        $name = explode('_',$name)[1];
        $check_const = strtoupper($model).'__CHECK_'.strtoupper($name);
        $error_const = strtoupper($model).'__'.strtoupper($name).'_INVALID';
        $preg = $const -> $check_const;

        switch (gettype($param)) {
            case 'string':
                if (!preg_match($preg, $param)){
                    return $const -> $error_const;
                }
                break;
            default:
        }
        return $const -> CORRECT__PARAMS;
    }
}