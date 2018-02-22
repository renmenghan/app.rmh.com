<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 上午10:57
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use think\controller;
use app\common\lib\exception\ApiException;
use think\Log;

class Index extends Common {
    /**
     * 获取首页接口
     * 头图4-6
     * 推荐位列表 默认40条
     */
    public function Index(){

        $heads = model('News')->getIndexHeadNormalNews();
        $heads = $this->getDealNews($heads);

        $position = model('News')->getPositionNormalNews();
        $position = $this->getDealNews($position);

        $result = [
            'heads' => $heads,
            'positions' =>$position,
        ];
        return show(config('code.success'),'ok',$result,200);
    }

    /**
     * 客户端初始化接口
     * 检测app是否需要升级
     */
    public function init(){
        // try
        $version = model('Version')->getLastNormalVersionByAppType($this->headers['app_type']);

        if (empty($version)){
            return new ApiException('error',404);
        }

        if ($version->version > $this->headers['version']){
            $version->is_update = $version->is_force==1?2:1;
        }else{
            $version->is_update = 0;// 0 不更新 1更新 2强制更新
        }
        // 记录用户基本信息用于统计
        $active = [
            'version'=>$this->headers['version'],
            'app_type'=>$this->headers['app_type'],
            'did'=>$this->headers['did'],
        ];
        try{
            model('AppActive')->add($active);
        }catch (\Exception $e){
            Log::write();
        }


        return show(config('code.success'),'ok',$version,200);
    }

}