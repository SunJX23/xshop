<?php

namespace app;

class const_info
{
    // 全局错误码
    private $error = array(

    );

    // User模型
    private $user = array(

        /********************正则匹配检测参数是否合法********************/
        // id必须为英文、下划线、数字，且不得以数字开头，长度在 3-10 个字符
        'CHECK_ID' => '/^[a-zA-Z_]+[a-zA-Z0-9_]{3,10}$/',
        // 密码必须为英文、下划线、数字，长度在 6-30 个字符
        'CHECK_PSW' => '/^[a-zA-Z0-9_]{6,30}$/',
        // 昵称必须为中文、英文、下划线、数字，长度在 2-30 个字符
        'CHECK_NICK' => '/^[a-zA-Z0-9_\u4e00-\u9fa5]{3,30}$/',


    );
}