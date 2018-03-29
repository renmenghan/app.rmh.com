<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/17
 * Time: 下午10:03
 */
return [
    'password_pre_halt' => '_#rmh_app', //密码加密盐
    'aeskey' =>'qwsxcfui',// 秘钥 服务端客户端必须保持一致
    'apptypes'=>[
        'android',
        'ios',
    ],
    'app_sign_time' => 10,//sign失效时间
    'app_sign_cache_time' => 20,//sign缓存时间
    'login_time_out_day'=>7,// 登录失效时间

];