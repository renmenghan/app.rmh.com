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
use app\common\lib\Upload;
use think\controller;
use app\common\lib\exception\ApiException;
class Image extends AuthBase {

    /**
     * 获取用户信息
     * 用户的基本信息非常隐私 需要加密处理
     */
    public function save(){


        $image = Upload::image();
        if ($image){
            return show(config('code.success'),'ok',config('qiniu.image_url').'/'.$image);

        }
        //print_r($_FILES);
//        $obj = new Aes();


    }



}