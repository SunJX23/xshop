<?php

namespace app\user\model;

use think\Model;
use think\Request;
use app\Common;
use app\Consts;

class User extends Model
{
    
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user';

    // 数据表主键 复合主键使用数组定义 不设置则自动获取(不晓得是怎么自动获取的反正我没看到)
    protected $pk = 'user_id';

    // 数据库查询对象
    protected $query;

    // 数据表字段信息
    protected $field;

    protected $consts;

    // 设置当前模型的数据库连接
    protected $connection = [
        // 数据库类型
        'type'        => 'mysql',
        // 服务器地址
        'hostname'    => '127.0.0.1',
        // 数据库名
        'database'    => 'shop',
        // 数据库用户名
        'username'    => 'root',
        // 数据库密码
        'password'    => '',
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => '',
        // 数据库调试模式
        'debug'       => true,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->consts = new Consts();
        $this->field = $this->getQuery()->getTableInfo('', 'fields');
    }

    protected function checkSignUp()
    {
        $user_post = [];
        foreach ($this->field as $name) {
            if ($name === 'user_logo')
                continue;
            $user_post[$name] = checkRequestParam('user', $name);
            if ($user_post[$name]['ret'] === -1){
                return $user_post[$name];
            }
        }
        return $user_post['user_id'];
    }

    public function checkIdExisted()
    {
        $id = Request::instance()->post('user_id');
        $result = $this->where('user_id', $id)->find();
        if (!is_null($result)){
            return $this->consts->USER__USER_EXISTED;
        }
        return $this->consts->CORRECT__OK;
    }

    public function insertUser()
    {
        $user_post = $this->checkSignUp();
        if ($user_post['ret'] === -1)
            return $user_post;
        $params = Request::instance()->only(['user_id','user_nick','user_psw']);
        $this->data($params);
        $this->save();
        return $user_post;
    }
}