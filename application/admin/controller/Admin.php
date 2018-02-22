<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/17
 * Time: 下午5:28
 */
namespace app\admin\controller;

use think\Controller;

class Admin extends Controller
{

    public function add(){
        $this->model = 'AdminUser';
        // 判定是否是post提交
        if (request()->isPost()){
            //dump(input('post.'));
            //halt(input('post.'));
            $data = input('post.');
            // validate
            $validate = validate('AdminUser');
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
            $data['password'] = IAuth::setPassword($data['password']);
            $data['status'] = config('code.status_normal');

            try{
                $id = model('AdminUser')->add($data);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            if ($id){
                $this->success('id='.$id.'的用户新增成功');
            }else{
                $this->error('error');
            }


        }else{
            return $this->fetch();
        }

    }
}
