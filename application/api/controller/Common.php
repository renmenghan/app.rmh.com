<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 上午10:57
 */
namespace app\api\controller;
use Qiniu\Auth;
use think\Cache;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\IAuth;
use app\common\lib\Time;
/**
 * API模块 公共控制器
 * Class Common
 * @package app\api\controller
 */
class Common extends Controller{

    /**
     * page
     * @var string
     */
    public $page = '';

    /**
     * 每页多少行
     * @var string
     */
    public $size = '';

    /**
     * 查询其实位置
     * @var string
     */
    public $from = '';

    /**
     * header头
     * @var string
     */
    public $headers = '';
    /**
     * 初始化方法
     */
    public function _initialize() {

//        phpinfo();exit();
        $this->checkRequestAuth();
        //$this->testAes();
    }

    /**
     * 检查每次app请求的数据是否合法
     */
    public function checkRequestAuth(){
        // 首先需要获取headers
        $headers = request()->header();
//        halt($headers);
        //todo

        //aes sign 加密 需要客户端工程师去做 解密服务端工程师
        // 1 headers body 仿照sign
        if (empty($headers['sign'])){
            throw new ApiException('sign不存在',400);
        }

        if (!in_array($headers['app_type'],config('app.apptypes'))){
            throw new ApiException('app_type不合法',400);
        }

        // sign
        if(!IAuth::checkSignPass($headers)){
            throw new ApiException('授权码sign失败',401);
        }

        //1.文件 2mysql 3redis
        Cache::set($headers['sign'],1,config('app.app_sign_cache_time'));

        $this->headers=$headers;

    }

    public function testAes(){

        $data = [
            'did'=>'123',
            'vsersion'=>1,
            'time'=>Time::get13TimeStamp(),
            ];

        $str = 'DVNxFPO5UEeVdYKDn9OqY9m6uZ4UvWgB7Up9wZJ+BSRx8W81qW2iVA==';
        //echo (new Aes())->decrypt($str);exit();
        echo IAuth::setSign($data);exit;
        //echo (new Aes())->decrypt('usgNs94NhY4kN/m7tCXUxRHDyN+4bKuNl1MwWIyhXfQ=');exit();
    }


    /**
     * 获取处理的新闻的内容数据
     */
    protected function getDealNews($news = []){
        if (empty($news)){
            return [];
        }

        $cats = config('cat.lists');

        foreach ($news as $key=>$new){
            $news[$key]['catname'] = $cats[$new['catid']] ? $cats[$new['catid']] : '-';

        }
        return $news;
    }


    /**
     *获取分页和size
     */
    public function getPageAndSize($data){
        $this->page =!empty($data['page']) ?$data['page'] : 1;
        $this->size =!empty($data['size']) ?$data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }
}