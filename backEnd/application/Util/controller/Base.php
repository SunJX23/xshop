<?php

namespace app\util\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    public function index()
    {
        return '<style type="text/css">.w{margin:10%;position:absolute;}.p{margin:20% 10%;position:absolute;}.pl{float:left}a{position:absolute;float:right;font-size:1.5em;-webkit-margin-before:0.83em;font-weight:bold;margin-left:15px;}</style><h2 class="w">Welcome to My X-shop App</h2><div class="p"><h2 class="pl">Please Click </h2><a href="http://localhost:8080/#/">APP_Portal</a></div> ';
    }

    public function miss()
    {
        if (Request::instance()->isOptions()) {
            return ;
        } else {
            return '<h2 style="margin:5%">你输的啥你再好好瞅瞅  有这地址么你就瞎输</h2>';
        }
    }
}
 