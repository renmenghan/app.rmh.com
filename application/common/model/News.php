<?php

namespace app\common\model;

use think\Model;
use app\common\model\Base;

class News extends Base{

    /**
     * 后台自动化分页
     * @param array $data
     * @return array
     */
    public function getNews($data=[]){
        $data['status'] = [
            'neq',config('code.status_delete')
        ];
        $order = ['id' => 'desc'];
            $result = $this->where($data)
            ->order($order)
            ->paginate();

//        echo $this->getLastSql();
        return $result;
    }

    /**
     * @param array $condition
     * @param int $from
     * @param int $size
     * @return false|\PDOStatement|string|\think\Collection
     */
    public  function getNewsByCondition($condition = [],$from=0,$size=5){

        if (!isset($condition['status'])){
            $condition['status'] = [
                'neq',config('code.status_delete')
            ];
        }


        $order = ['id' => 'desc'];

        // limit a,b
        $result = $this->where($condition)
            ->limit($from,$size)
            ->order($order)
            ->field($this->_getListField())
            ->select();

        //echo $this->getLastSql();
        return $result;
    }

    /**
     * 根据条件来获取数据的总数
     * @param $param
     */
    public  function getNewsCountByCondition($condition=[]){

        if (!isset($condition['status'])){
            $condition['status'] = [
                'neq',config('code.status_delete')
            ];
        }

        return $this->where($condition)
            ->count();
        //echo $this->getLastSql();
    }


    /**
     * 获取首页头伏数据
     * @param int $num
     * @return array result
     */
    public function getIndexHeadNormalNews($num = 4){
        $data = [
            'status'=>1,
            'is_head_figure' =>1,
        ];
        $order = ['id'=>'desc'];

        return $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();
    }

    public function getPositionNormalNews($num = 40){
        $data = [
            'status'=>1,
            'is_position' =>1,
        ];
        $order = ['id'=>'desc'];

        return $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();
    }


    /**
     * 获取排行榜数据
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getRankNormalNews($num = 5){
        $data = [
            'status'=>1,

        ];
        $order = ['read_count'=>'desc'];

        return $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();
    }

    /**
     * 通用化获取参数的数据字段
     */
    private function _getListField(){
        return [
            'id',
            'catid',
            'image',
            'title',
            'read_count',
            'is_position',
            'update_time',
            'create_time',
            'status'
        ];
    }

}