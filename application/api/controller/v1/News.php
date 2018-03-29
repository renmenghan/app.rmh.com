<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 上午10:57
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
class News extends Common {

    public function index(){
        // validate 做相关校验
        $data = input('get.');
        $this->getPageAndSize($data);

        $whereData['status']=config('code.status_normal');
        if (!empty(input('get.catid'))){
            $whereData['catid']=input('get.catid',0,'intval');
        }

        if (!empty($data['title'])){
            $whereData['title']=['like','%'.$data['title'].'%'];
        }

        $total = model('News')->getNewsCountByCondition($whereData);

        $news = model('News')->getNewsByCondition($whereData,$this->from,$this->size);

        $result = [
            'total' =>$total,
            'page_num'=>ceil($total / $this->size),
            'list' =>$this->getDealNews($news),
        ];
        if (empty($whereData['catid'])){
            $heads = model('News')->getIndexHeadNormalNews();
            $heads = $this->getDealNews($heads);
            $result['heads'] = $heads;
        }

        return show(config('code.success'),'ok',$result,200);

    }
    /**
     * 获取详情接口
     */
    public function read() {
        // 详情页面 APP -》 1、x.com/3.html  2、 接口

//        var_dump(input('param.id'));exit();
        $id = input('param.id', 0, 'intval');
        if(empty($id)) {
            return new ApiException('id is not ', 404);
        }

        // 通过id 去获取数据表里面的数据
        // try catch untodo
        $news = model('News')->get($id);
//        halt($news);
        if(empty($news) || $news->status != config('code.status_normal')) {
            return new ApiException('不存在该新闻', 404);
        }

        try {
            model('News')->where(['id' => $id])->setInc('read_count');
        }catch(\Exception $e) {
            return new ApiException('error', 400);
        }

        $cats = config('cat.lists');
        $news->catname = $cats[$news->catid];



        return show(config('code.success'), 'OK', $news, 200);
    }

}