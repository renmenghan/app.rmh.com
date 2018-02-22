<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/17
 * Time: 下午5:28
 */
namespace app\admin\controller;

use think\Controller;

/**
 * 后台基础类库
 * Class Base
 * @package app\admin\controller
 */
class Base extends Controller
{
    /**
     * page
     * @var string
     */
    public $page = '';

    /**
     * 每页多少行
     * @var string
     */
    public $size = '';

    /**
     * 查询其实位置
     * @var string
     */
    public $from = '';

    /**
     * 定义model
     * @var string
     */
    public $model = '';


    /**
     * 初始化的方法
     */
    public function _initialize(){
        // 判断用户是否登录
       $isLogin = $this->isLogin();
       if (!$isLogin){
           return $this->redirect('login/index');
       }
    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function isLogin(){
        $user =session(config('admin.session_user'),'',config('admin.session_user_scope'));
        if ($user && $user->id){
            return true;
        }
        return false;
    }

    /**
     *获取分页和size
     */
    public function getPageAndSize($data){
        $this->page =!empty($data['page']) ?$data['page'] : 1;
        $this->size =!empty($data['size']) ?$data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }


    /**
     * 删除操作
     * @param $id
     */
    public function delete($id){
        if (!intval($id)){
            return $this->result('',0,'id不合法');
        }
        // 如果表和控制器文件名一样
        // 但是我们不一样的
        $model = $this->model?$this->model:request()->controller();
        // php7 $model = $this->??request()->controller()

        //echo $model;exit();
        try{
            $res = model($model)->save(['status'=> -1],['id'=>$id]);
        }catch (\Exception $e){
            return $this->result('',0,$e->getMessage());

        }
        if ($res){
            return $this->result(['jump_url'=>$_SERVER['HTTP_REFERER']],1,'ok');
        }
        return $this->result('',0,'删除失败');

    }

    /**
     * 通用化修改状态
     */
    public function status(){
        $data = input('param.');
        // tp5校验 id status

        // 通过id去库中查询记录是否存在
//        model('News')->get($data['id']);
        $model = $this->model?$this->model:request()->controller();

        try{
            $res = model($model)->save(['status'=> $data['status']],['id'=>$data['id']]);
        }catch (\Exception $e){
            return $this->result('',0,$e->getMessage());

        }
        if ($res){
            return $this->result(['jump_url'=>$_SERVER['HTTP_REFERER']],1,'ok');
        }
        return $this->result('',0,'修改失败');


    }
}
