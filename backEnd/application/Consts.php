<?php

namespace app;

class Consts
{
    // 正确信息
    private $correct = array(
        'OK' => array(100, '无异常请继续'),
        'PARAMS' => array(200, '请求参数正确')
    );

    // 全局错误码
    private $error = array(
        /************************ 数据请求相关 ************************/
        'UNKNOWN_TYPE' => array(101, '未获得正确错误码'),

        /************************ 网络连接相关 ************************/
        'PARAMS_INCOMPLETE' => array(121, '服务器未接收到正确参数！')

        /************************* 数据库相关 *************************/
        
    );

    // User模型
    private $user = array(
        /******************* 正则匹配检验参数是否合法 *******************/
        // id必须为英文、下划线、数字，且不得以数字开头，长度在 3-10 个字符
        'CHECK_ID' => '/^[a-zA-Z_]+[a-zA-Z0-9_]{2,10}$/',
        // 密码必须为英文、下划线、数字，长度在 6-30 个字符
        'CHECK_PSW' => '/^[a-zA-Z0-9_]{6,30}$/',
        // 昵称必须为中文、英文、下划线、数字，长度在 2-13 个字符
        'CHECK_NICK' => '/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]{2,13}$/u',

        /*********************** User模型错误码 ***********************/
        'USER_EXISTED' => array(201, '用户名已存在'),
        'ID_INVALID' => array(202, '用户名格式错误'),
        'NICK_INVALID' => array(203, '昵称格式错误'),
        'PSW_INVALID' => array(204, '密码格式错误'),
    );
    public function __get($param) {
        $const = explode("__", $param);
        $model = strtolower($const[0]);
        $key = $const[1];
        $consts = $this->$model;
        if (array_key_exists($key, $consts)) {
            $ret = $model === 'correct' ? 1 : -1;
            if (explode('_', $key)[0] === 'CHECK') {
                return $consts[$key];
            } else {
                return array('ret' => $ret, 'code' => $consts[$key][0], 'msg' => $consts[$key][1]);
            }
        } else {
            throw exception($model." 模块下不存在 ".$key); 
        }
    }
}