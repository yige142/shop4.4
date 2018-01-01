<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8
 * Time: 21:16
 */
namespace Admin\Model;

use Think\Model;
class  ReturnModel extends Model{
    //根据ID获得数据
    public function getOne($order_id){
        $map['order_id']=$order_id;
        $object=$this->field(
            'return_id,
            user_id,
            goods_id,
            order_id,
            return_goods_name,
            return_order_sn,
            return_money,
            return_reason,
            createtime'
        )->where($map)->find();
        return $object;
    }
}