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
use app\common\lib\IAuth;
use think\controller;
use app\common\lib\exception\ApiException;
class Upvote extends AuthBase {

    /**
     * 新闻点赞功能开发
     */
    public function save(){
        $id = input('post.id',0,'intval');

        if (empty($id)){
            return show(config('code.error'),'id不存在',[],404);
        }
        // 判定 id新闻 是否在ent_news
        $data = [
            'user_id' =>$this->user->id,
            'news_id' =>$id,
        ];
        $userNews = model('UserNews')->get($data);
        if ($userNews){
            return show(config('code.error'),'已经过点赞了，不能再次点赞',[],401);
        }
        try{
            $userNewsId = model('UserNews')->add($data);
            if ($userNewsId){
                model('News')->where(['id' => $id])->setInc('upvote_count');

                return show(config('code.success'),'ok',[],202);
            }else{
                return show(config('code.error'),'内部错误点赞失败',[],500);
            }
        }catch (\Exception $e){
            return show(config('code.error'),'内部错误点赞失败',[],500);

        }

    }
    public function delete(){
        $id = input('post.id');
        if (empty($id)){
            return show(config('code.error'),'id不存在',[],404);
        }

        $data = [
            'user_id' =>$this->user->id,
            'news_id' =>$id,
        ];
        $userNews = model('UserNews')->get($data);

        if (empty($userNews)){
            return show(config('code.error'),'没被点过赞，无法取消',[],401);
        }


        try{
            $userNewsId = model('UserNews')
                ->where($data)
                ->delete();

            if ($userNewsId){
                model('News')->where(['id' => $id])->setDec('upvote_count');
                return show(config('code.success'),'ok',[],202);
            }else{
                return show(config('code.error'),'取消失败',[],500);
            }
        }catch (\Exception $e){
            return show(config('code.error'),'内部错误取消点赞失败',[],500);

        }
    }

    /**
     * 查看文章是否被改用户点赞
     */
    public function read(){
        $id = input('param.id',0,'intval'); //id = 1,2,3

        if (empty($id)){
            return show(config('code.error'),'id不存在',[],404);
        }
        $data = [
            'user_id' =>$this->user->id,
            'news_id' =>$id,
        ];

         $userNews = model('UserNews')->get($data);

        if ($userNews){
            return show(config('code.success'),'ok',['is_upvote' => 1],200);
        }else{
            return show(config('code.success'),'ok',['is_upvote' => 0],200);

        }
    }
}