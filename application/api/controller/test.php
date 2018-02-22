<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 上午10:57
 */
namespace app\api\controller;
use app\common\lib\AliSms;
use app\common\lib\IAuth;
use app\common\lib\Jpush;
use think\controller;
use app\common\lib\exception\ApiException;
class test extends Common {
    public function index(){
        return [
            'ssss',
            'ddddd',
        ];
    }
    public function update($id = 0){
//        echo $id;exit();
         halt(input('put.')) ;
        return $id;
    }

    public function save(){
//        $data = input('post.');
//        if ($data['111'] != 1){
//            throw new ApiException('数据不合法',400);
//        }
        //获取到提交数据 差入库
        //给客户端app =》接口数据
        //
//        $data = [
//           'status'=>1,
//            'message'=>'ok',
//            'data'=>input('post.'),
//        ];
        return show(1,'ok',input('post.'),201);
    }

    public function sendSms(){
        halt(AliSms::getInstance()->setSmsIdentify('13004588611'));

    }

    public function token(){
        echo IAuth::setAppLoginToken('111');
    }

    public function push(){
        $obj = new Jpush();
        Jpush::push('hi','8');

    }
}