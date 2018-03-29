<?php

namespace app\common\model;

use think\Model;
use app\common\model\Base;

class Sport extends Base{
    /**
     * @param array $userIds
     */
    public function getUserTotalsData($userId){

        $data = [
            'user_id' => $userId,
            'status' => config('code.status_normal'),
        ];
//        $order = [
//            'id'=>'desc',
//        ];

        return $this->where($data)
            ->field(['distance','time','kcl'])
            ->select();
    }

    public function getCountByUser($userId){
        $data = [
            'user_id' => $userId,
            'status' => config('code.status_normal'),
        ];
        return $this->where($data)
            ->field('id')
            ->count();
    }

    public function getUserEverydayData($userId){
        $data = [
            'user_id' => $userId,
        ];

       return $this->query('SELECT time_date ,SUM(distance) as distance ,SUM(time) as time  ,SUM(kcl) as kcl FROM ent_sport where user_id= '.$userId.' GROUP BY time_date;

');
//         return $this->where($data)
//             ->formatDateTime('create_time','Y-m')
//             ->select();
    }
}