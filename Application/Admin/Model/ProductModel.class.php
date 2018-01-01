<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/3
 * Time: 14:50
 */
namespace Admin\Model;

use Think\Model;

class ProductModel extends Model{
    //获得产品信息数据列表
    public function getList($page,$rows,$sort,$order){
        $object=$this->field('product_name,
                           product_info,
                           uid,
                           create_time,
                           savename,
                           savepath')
                    ->order(array($sort=>$order))
                    ->limit(($rows*($page-1)),$rows)
                    ->select();
        return array(
            'total'=>$this->count(),
            'rows'=>$object ? $object : ''
        );
    }
}