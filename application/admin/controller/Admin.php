<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/17
 * Time: 下午5:28
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\controller\ElemeCookies;
class Admin extends Controller
{

    public function add()
    {
        $this->model = 'AdminUser';
        // 判定是否是post提交
        if (request()->isPost()) {
            //dump(input('post.'));
            //halt(input('post.'));
            $data = input('post.');
            // validate
            $validate = validate('AdminUser');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            $data['password'] = IAuth::setPassword($data['password']);
            $data['status'] = config('code.status_normal');

            try {
                $id = model('AdminUser')->add($data);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }

            if ($id) {
                $this->success('id=' . $id . '的用户新增成功');
            } else {
                $this->error('error');
            }


        } else {
            return $this->fetch();
        }

    }

    public function hongbao()
    {
//        $this->model = 'AdminUser';
        // 判定是否是post提交
        if (request()->isPost()) {

            $data = input('post.');
            $hongbaoUrl = $data['password'];
            $query = $this->urlToObjc($hongbaoUrl);
            $origin = 'https://h5.ele.me';

            $headers = [
                'content-type'  =>      'text/plain;charset=UTF-8',
                'referer'       =>      $origin.'/hongbao/',
                'user-agent'    =>      'Mozilla/5.0 (Linux; Android 6.0; PRO 6 Build/MRA58K; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/53.0.2785.49 Mobile MQQBrowser/6.2 TBS/043221 Safari/537.36 V1_AND_SQ_7.0.0_676_YYB_D QQ/7.0.0.3135 NetType/WIFI WebP/0.3.0 Pixel/1080',
                'X-Shard'       =>      'eosid='.intval($query['sn'],16)
            ];

//            $result = $this->http('www.baidu.com',[],'GET');
            $index = -1;
            $luckIndex = 0;
            $cookieObj = new ElemeCookies();

            for ($i = 0 ; $i < $query['lucky_number'] ; $i++){
                $cookie = [];
                if ($index >= 18){
                    return '领取失败，系统资源不足(cookie或手机号)或者其他未知原因';
                }
                elseif ($index = -1){
                    $cookie =$cookieObj->cookie(false);
                }
                else{
                    $cookie =$cookieObj->cookie(true);

                }
                if (!$query['sn'] || !$query['lucky_number']) {
                    $this->error('饿了么红包链接不正确');
                }

                $phone = $cookieObj->randomPhone();
                if ($luckIndex == $index){
                    $phone = $data['username'];
                }

            }

        } else {
            return $this->fetch();
        }

    }

    public function lottery($phone = null){

    }


    public function http($url, $params, $method = 'GET', $header = array(), $multi = false)
    {
        $opts = array(
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => $header
        );

        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new Exception('不支持的请求方式！');
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error) throw new Exception('请求发生错误：' . $error);
        return  $data;

    }


    public function urlToObjc($urlString) {
        $url = $urlString;
        $arr = parse_url($url);
        $params=[];
        $paraStringArr = parse_str($arr['fragment'],$params)  ;

//halt($params);
//        $obj = $this->array_to_object($paraString);
        return $params;

    }

//    /**
//     * 数组 转 对象
//     *
//     * @param array $arr 数组
//     * @return object
//     */
//    function array_to_object($arr) {
//        if (gettype($arr) != 'array') {
//            return;
//        }
//        foreach ($arr as $k => $v) {
//            if (gettype($v) == 'array' || getType($v) == 'object') {
//                $arr[$k] = (object)array_to_object($v);
//            }
//        }
//
//        return (object)$arr;
//    }


}