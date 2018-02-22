<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/17
 * Time: 下午5:28
 */
namespace app\admin\controller;

use think\Controller;
use app\common\AdminUser;
use app\common\lib\IAuth;

class Login extends Base
{
    public function _initialize(){}
    public function index(){
        // 如果后台用户登录了 跳转到后台首页
        $isLogin = $this->isLogin();
        if ($isLogin){
            return $this->redirect('index/index');
        }
        return $this->fetch();
    }


    public function check(){
        if (request()->isPost()){
            $data = input('post.');
            if (!captcha_check($data['code'])){
                $this->error('验证码错误');
            }
            // 判定username password
            // validate机制

            try {
                $user = model('AdminUser')->get(['username' => $data['username']]);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if (!$user || $user->status != config('code.status_normal')) {
                $this->error('该用户不存在');
            }
            //再对密码进行处理
            if (IAuth::setPassword($data['password']) != $user->password) {
                $this->error('密码不正确');
            }

            // 更新数据库 登录时间  ip
            $udata = [
                'last_login_time' => time(),
                'last_login_ip' => request()->ip(),
            ];
            try{
                model('AdminUser')->save($udata, ['id' => $user->id]);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            // session
            session(config('admin.session_user'),$user,config('admin.session_user_scope'));
            $this->success('登录成功','index/index');

        }else{
            $this->error('请求不合法');
        }


    }

    /**
     * 退出登录
     * 清空session 跳转登录页面
     */
    public function logout(){
        session(null,config('admin.session_user_scope'));
        $this->redirect('login/index');
    }


}
