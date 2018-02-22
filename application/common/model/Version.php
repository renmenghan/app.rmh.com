<?php

namespace app\common\model;

use think\Model;
use app\common\model\Base;

class Version extends Base{

    /**
     * @param string $appType
     * 通过apptype获取最后一条
     */
    public function getLastNormalVersionByAppType($appType=''){

        $data = [
            'status'=>1,
            'app_type'=>$appType,

        ];
        $order = ['id'=>'desc'];

        return $this->where($data)
            ->order($order)
            ->limit(1)
            ->find();

    }

}