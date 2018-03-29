<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 上午10:57
 */
namespace app\api\controller;

use think\Controller;

class Time extends Controller {
    public function index(){
       return show(1,'ok',time());
    }
}