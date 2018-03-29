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
class Rank extends Common {

    /**
     * 获取排行数据列表
     * 获取数据库 按readcount排序 5-10
     * 优化 redis
     */
    public function index(){

        try{
            $rands = model('News')->getRankNormalNews();
            $rands = $this->getDealNews($rands);
        }catch (\Exception $e){
            throw new ApiException('error',400);

        }

        return show(config('code.success'),'ok',$rands,200);


    }
}