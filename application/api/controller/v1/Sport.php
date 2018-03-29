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
use app\common\lib\IAuth;
use think\Controller;
use app\common\lib\exception\ApiException;
class Sport extends AuthBase {

    public function index(){

        if (empty($this->user->id)){
            return show(config('code.error'),'数据不合法',[],404);
        }

        $datas = model('Sport')->getUserTotalsData($this->user->id);

        $distance = 0;
        $time = 0;
        $kcl  = 0;
        foreach ($datas as $value){

            $time  += $value->time;
            $distance += $value->distance;
            $kcl += $value->kcl;

        }

        $count = model('Sport')->getCountByUser($this->user->id);
        $result = [
            'distance'      => $distance,
            'time'          =>$time,
            'kcl'           =>$kcl,
            'count'         =>$count,
        ];
        return show(config('code.success'),'ok',$result,200);



    }

    public function save(){
        $postData = input('param.');
        // valudate 进行校验 自行完成

        if (empty($postData)){
            return show(config('code.error'),'数据不合法',[],404);
        }

        $postData['user_id'] = $this->user->id;
        $postData['status'] = 1;
        $postData['time_date'] = date('Y-m-d',time());
        try{
            $id = model('Sport')->add($postData);
            if ($id){
                return show(config('code.success'),'ok',[],200);

            }else{
                return show(config('code.error'),'添加失败',[],401);

            }
        }catch (\ Exception $e){
            return show(config('code.error'),$e->getMessage(),[],500);
        }
    }

    public function everyday(){
        if (empty($this->user->id)){
            return show(config('code.error'),'数据不合法',[],404);
        }

        $datas = model('Sport')->getUserEverydayData($this->user->id);

        $result = [
            'everyData'=>$datas,
        ];
        return show(config('code.success'),'ok',$result,200);

//        halt($datas);

    }
}