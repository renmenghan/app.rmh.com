<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 上午10:57
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\AliSms;
use app\common\lib\IAuth;
use app\common\model\User;

class Login extends Common {


    public function save(){

        if (!request()->isPost()){
            return show(config('code.error'),'没有权限',[],403);
        }

        $param = input('param.');
        if (empty($param['phone'])){
            return show(config('code.error'),'手机号码不合法',[],404);

        }
        if (empty($param['code']) && empty($param['password'])){
            return show(config('code.error'),'验证码或者密码不合法',[],404);
        }

        if (!empty($param['code'])){
            //$param['code'] = Aes::decrypt($param['code']);
            $code = AliSms::getInstance()->checkSmsIdentify($param['phone']);
            if ($code != $param['code']){
                return show(config('code.error'),'验证码不存在',[],404);
            }
        }
        // validate


        $token = IAuth::setAppLoginToken($param['phone']);
        $data = [
            'token'=>$token,
            'time_out'=>strtotime("+".config('app.login_time_out_day')."days"),
        ];
        // 查询这个手机号是否存在
        $user = User::get(['phone' => $param['phone']]);
        if ($user && $user->status == 1){
            if (!empty($param['password'])){
                if (IAuth::setPassword($param['password']) != $user->password){
                    return show(config('code.error'),'密码不正确',[],403);
                }
            }
            $id = model('User')->save($data,['phone'=>$param['phone']]);

        }else {
            if (!empty($param['code'])){
                // 第一次登录 注册数据
                $data['username'] = 'spl'.$param['phone'];
                $data['status'] = 1;
                $data['phone']=$param['phone'];
                $id = model('User')->add($data);

            }else{
                return show(config('code.error'), '用户不存在', [], 403);
            }
        }

        $obj = new Aes();
        if ($id){
            $result = [
                'token'=> $obj->encrypt($token."||".$id),
            ];
            return show(config('code.success'),'ok',$result,500);
        }else{
            return show(config('code.error'),'登录失败',[],403);

        }

    }

}