<?php

namespace app\common\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    protected $request;
    public function _initialize()
    {
        parent::_initialize();
        /*防止跨域*/
        $http_origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : "*";
        header('Access-Control-Allow-Origin: '.$http_origin);
        if ($http_origin !== "*") {
            header('Access-Control-Allow-Credentials: true');
        }
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId");
        header('Content-Type: application/json; charset=utf-8');
        $request =  Request::instance();
    }

    public function object_array($array)
    {
        if (is_object($array)) {
            $array = (array)$array;
        }
        if (is_array($array)) {
            foreach ($array as $key=>$value) {
                $array[$key] = $this->object_array($value);
            }
        }
        return $array;
    }
}
 