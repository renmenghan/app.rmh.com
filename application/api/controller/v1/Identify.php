<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 上午10:57
 */
namespace app\api\controller\v1;
use think\controller;
use app\common\lib\AliSms;
use app\api\controller\Common;
class Identify extends Common {

    public function save(){

        if (!request()->isPost()){
            return show(config('code.error'),'您提交数据不合法',[],403);
        }

        // 校验数据
        $validate = validate('Identify');

        if (!$validate->check(input('post.'))){

            return show(config('code.error'),$validate->getError(),[],403);
        }

        $id = input('param.id');
        if (AliSms::getInstance()->setSmsIdentify($id)){
            return show(config('code.success'),'验证码发送成功',[],201);

        }else{
            return show(config('code.error'),'发送失败',[],403);

        }

    }
}