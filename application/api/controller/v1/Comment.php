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
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\model\User;
class Comment extends AuthBase {

    /**
     * 评论回复功能
     */
    public function save(){
        $data = input('post.',[]);

        // news_id content to_user_id parent_id

        //validate

        //news_id是否存在

        $data['user_id'] = $this->user->id;
        try{
            $commentId = model('Comment')->add($data);
            if ($commentId){
                return show(config('code.success'),'ok',[],203);
            }else{
                return show(config('code.error'),'评论失败',[],500);
            }
        }catch(\Exception $e){

        }
    }

    /**
     * 评论列表
     */
    /*
    public function read(){
        // select * from ent_comment as a join ent_user as b on a.user_id=b.id and a.news_id=8
        $newsId = input('param.id',0,'intval');
        if (empty($newsId)){
            return show(config('code.error'),'id不存在',[],404);
        }

        $this->getPageAndSize(input('param.'));

        $count = model('Comment')->getNormalCommentsCountByCondition(['news_id' => $newsId]);
        $comments = model('Comment')->getNormalCommentsByCondition(['news_id' => $newsId],$this->from,$this->size);

        $result = [
            'total' =>$count,
            'page_num'=>ceil($count / $this->size),
            'list' =>$comments,
        ];

        return show(config('code.success'),'ok',$result);
    }
    */
    public function read(){

        // select * from ent_comment as a join ent_user as b on a.user_id=b.id and a.news_id=8
        $newsId = input('param.id',0,'intval');
        if (empty($newsId)){
            return show(config('code.error'),'id不存在',[],404);
        }

        $param['news_id']=$newsId;

        $count = model('Comment')->getCountByCondition($param);

        $this->getPageAndSize(input('param.'));

        $userIds = [];

        $comments = model('Comment')->getListsByCondition($param,$this->from,$this->size);
        if ($comments){
            foreach ($comments as $comment){
                $userIds[] = $comment['user_id'];
                if ($comment['to_user_id']){
                    $userIds[] = $comment['to_user_id'];
                }
            }
            $userIds = array_unique($userIds);
        }

        $userIds = model('User')->getUsersUserId($userIds);

//        halt($userIds);
        if (empty($userIds)){
            $userIdNames = [];
        }else{
            foreach ($userIds as $userId){
                $userIdNames[$userId->id] = $userId;
            }
        }

        $resultData = [];
        foreach ($comments as $comment){
            $resultData[] = [
                'id'            =>$comment->id,
                'user_id'       =>$comment->user_id,
                'to_user_id'    =>$comment->to_user_id,
                'content'       =>$comment->content,
                'username'      =>!empty($userIdNames[$comment->user_id])? $userIdNames[$comment->user_id]->username : '',
                'tousername'    =>!empty($userIdNames[$comment->to_user_id])?$userIdNames[$comment->to_user_id]->username : '',
                'parent_id'     =>$comment->parent_id,
                'create_time'   =>$comment->create_time,
                'image'         =>!empty($userIdNames[$comment->user_id])?$userIdNames[$comment->user_id]->image : '',
            ];

        }

        $result = [
            'total' =>$count,
            'page_num'=>ceil($count / $this->size),
            'list' =>$resultData,
        ];

        return show(config('code.success'),'ok',$result);
    }
}