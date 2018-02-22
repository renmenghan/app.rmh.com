<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/17
 * Time: 下午5:28
 */
namespace app\admin\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
//        halt(session(config('admin.session_user'),'',config('admin.session_user_scope')));
        return $this->fetch();
    }

    public  function  welcome(){
        return 'welcome';
    }


}
