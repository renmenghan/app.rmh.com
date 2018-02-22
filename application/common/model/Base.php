<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/18
 * Time: 下午5:22
 */
namespace app\common\model;

use think\Model;

class Base extends Model{

    protected $autoWriteTimestamp = true;

    /**
     * 新增
     * @param $data
     * @return mixed
     */
    public function add($data) {

        if (!is_array($data)) {
            //tp
            exception('传递的数据不合法');
        }

        // 表中的字段不包含data中的 会自动过滤
        $this->allowField(true)->save($data);

        return $this->id;
    }
}