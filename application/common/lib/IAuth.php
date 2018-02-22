<?php

namespace app\common\lib;
use app\common\lib\Aes;
use think\Cache;

class IAuth {
    /**
     * 设置密码
     * @param $data
     * @return string
     */
    public static function setPassword($data){
        return md5($data.config('app.password_pre_halt'));
    }


    /**
     * 生成每次请求的sign
     * @param array $data
     * @return string
     */
    public static function setSign($data=[]){
        // 按字段排序
        ksort($data);
        // 拼接字符串数据
        $string = http_build_query($data);
        // 通过aes加密
        $string = (new Aes())->encrypt($string);
        return $string;
    }

    /**
     * 检查sign是否正常
     * @param $data
     * @return boolean
     */
    public static function checkSignPass($data){

        $str = (new Aes())->decrypt($data['sign']);

        if (empty($str)){
            return false;
        }

        // did=xx&app
        parse_str($str,$arr);


        if (!is_array($arr) || empty($arr['did'] || $arr['did'] != $data['did'])){

            return false;
        }



        if (!config('app_debug')){
            if((time() - ceil($arr['time'] / 1000)) >config('app.app_sign_time')){
                return false;
            }

            // 唯一性判断
            if (Cache::get($data['sign'])){
                return false;
            }
        }

       // echo Cache::get($data['sign']);exit();


        return true;
    }

    /**
     * 设置登录token
     * @return string
     */
    public static function setAppLoginToken($phone = ''){


        $str = md5(uniqid(md5(microtime(true)),true));
        $str = sha1($str.$phone);

        return $str;
    }
}
