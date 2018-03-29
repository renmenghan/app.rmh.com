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
class Cat extends Common {
    /**
     * 栏目接口
     * @return array
     */
    public function read(){
        $cats = config('cat.lists');
        $result['cats'] = [
            ['catid' => 0,
            'catname'=>'首页',]
        ];
        foreach ($cats as $catid=>$catname){
            $result['cats'][] = [
                'catid'=>$catid,
                'catname'=>$catname,
            ];
        }
        return show(config('code.success'),'ok',$result,200);
    }

}