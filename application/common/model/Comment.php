<?php

namespace app\common\model;

use think\Db;
use think\Model;
use app\common\model\Base;

class Comment extends Base{

    /**
     * 通过条件获取评论的数量
     * @param array $param
     */
    public function getNormalCommentsCountByCondition($param = []){
        // status = 1 自行
        $count = Db::table('ent_comment')
            ->alias(['ent_comment' => 'a','ent_user' =>'b'])
            ->join('ent_user','a.user_id = b.id AND a.news_id ='.$param['news_id'])
            ->count();

        return $count;
    }

    /**
     * 通过条件获取列表
     * @param array $param
     * @param $
     * @param int $from
     * @param int $size
     */
    public function getNormalCommentsByCondition($param=[],$from=0,$size=5){
       $result = Db::table('ent_comment')
            ->alias(['ent_comment' => 'a','ent_user' =>'b'])
            ->join('ent_user','a.user_id = b.id AND a.news_id ='.$param['news_id'])
            ->limit($from,$size)
           ->order(['a.id'=>'desc'])
           ->select();
//        halt($result);
       return $result;
    }


    public function getCountByCondition($param = []){
        return $this->where($param)
            ->field('id')
            ->count();
    }

    public function getListsByCondition($param=[],$from=0,$size=5){
        return $this->where($param)
            ->field('*')
            ->limit($from,$size)
            ->order(['id'=>'desc'])
            ->select();

    }

}