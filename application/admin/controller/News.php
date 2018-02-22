<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/17
 * Time: 下午5:28
 */
namespace app\admin\controller;

use think\Controller;

class News extends Base
{


    public function index(){
        $data = input('param.');
        $query = http_build_query($data);
        $whereData = [];
        // 转换查询条件
        if (!empty($data['start_time']) && !empty($data['end_time']) &&$data['end_time'] >$data['start_time'] )
        {
            $whereData['create_time'] = [
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])],
            ];
        }

        if (!empty($data['catid'])){
            $whereData['catid'] = intval($data['catid']);
        }

        if (!empty($data['title'])){
            $whereData['title']=['like','%'.$data['title'].'%'];
        }
        // 获取数据 填充到模板
        // 模式一
        //$news = model('News')->getNews();

        // 模式二
        // page size from  limit from size

        $this->getPageAndSize($data);

        //获取表里数据
        $news = model('News')->getNewsByCondition($whereData,$this->from,$this->size);
        // 获取满足条件的数据总数=》有多少页
        $total = model('News')->getNewsCountByCondition($whereData);
        // 结合总数 + size =》有多少页
        $pageTotal = ceil($total / $this->size);
        return $this->fetch('',[
            'cats'=>config('cat.lists'),
            'news' => $news,
            'pageTotal'=>$pageTotal,
            'curr'=>$this->page,
            'start_time'=> empty($data['start_time'])?'':$data['start_time'],
            'end_time'=>empty($data['end_time'])?'':$data['end_time'],
            'catid'=>empty($data['catid'])?'':$data['catid'],
            'title'=>empty($data['title'])?'':$data['title'],
            'query'=>$query,
        ]);
    }
    public function add(){
        if (request()->isPost()){
//            return $this->result('',0,'新增失败');
            $data = input('post.');
            // 数据需要做校验 validate机制
            try{
                $id = model('News')->add($data);
            }catch (\Exception $e){
                return $this->result('',0,'新增失败');
            }
            if ($id){
                return $this->result(['jump_url'=>url('news/index')],1,'ok');
            }else{
                return $this->result('',0,'新增失败');
            }


        }else {

            return $this->fetch('', [
                'cats' => config('cat.lists'),
            ]);
        }
    }

    public function edit(){


        if (request()->isPost()){
            $data = input('post.');
            $id = input('param.')['id'];
            // 数据需要做校验 validate机制
            try{
                $id = model('News')->save($data,['id'=>$id]);
            }catch (\Exception $e){
                return $this->result('',0,'新增失败');
            }
            if ($id){
                return $this->result(['jump_url'=>url('news/index')],1,'ok');
            }else{
                return $this->result('',0,'新增失败');
            }
        }else{
            $data = input('param.');

            try{
                $model = model('News')->get(['id'=>$data['id']]);
            }catch (\Exception $e){
               $this->error($e->getMessage());
            }
            return $this->fetch('', [
                'cats' => config('cat.lists'),
                'model'=>$model,

            ]);
        }


    }





}
