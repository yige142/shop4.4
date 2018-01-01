<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/14
 * Time: 19:58
 */
namespace Admin\Model;

use Think\Model;
class OrderModel extends Model{
    //展示list
    public function getList($order, $page, $rows, $sort,$order_status=false,
                           $order_cancel=false,$keywords,$goodsType,$cancel){

        $map = $keywords_map =  array();
        //商品状态字段获取值
        if($order_status){
            return $this->field('shop_order.order_status')->group('shop_order.order_status')->select();
        }
        //是否是取消的订单字段 获取值
        if($order_cancel){
            return $this->field('shop_order.order_cancel')->group('shop_order.order_cancel')->select();
        }

        //如果关键字有值 合并 或搜索该字段
        if ($keywords)
        {
            $keywords_map['shop_order.order_name'] = array('like', '%'.$keywords.'%');
            $keywords_map['shop_order.orderSn'] = array('like', '%'.$keywords.'%');
            $keywords_map['_logic'] = 'OR';
        }
        //把关键字SQL组入$map
        if (!empty($keywords_map)) {
            $map['_complex'] = $keywords_map;
        }

        if($goodsType){
            $map['shop_order.order_status']=$goodsType;
        }
        if($cancel){
            $map['shop_order.order_cancel']=$cancel;
        }
       // $map['shop_order.user_id']=$id;
        $object=$this->field(
                    'shop_order.orderId,
                   shop_order.order_name,
                   shop_order.orderSn,
                   shop_order.create_time,
                   shop_order.unit_price,
                   shop_order.number,
                   shop_order.total_price,
                   shop_order.order_status,
                   shop_order.order_cancel,
                   shop_goods.goodsId,
                   shop_goods.goods_info,
                   shop_goods.goods_name,
                   shop_goods.thumb_path')
            ->join('shop_goods ON shop_order.goods_id=shop_goods.goodsId','LEFT')
            ->where($map)
            ->order(array($sort => $order))
            ->limit(($rows * ($page - 1)), $rows)
            ->select();
        return array(
            'total' => $this->count(),
            'rows' => $object ? $object : ''
        );
    }

    //受理订单
    public function receive($id,$order_status){
        $StateDate=array(
            'orderId'=>$id,
            'order_status'=>$order_status
        );
        return $this->save($StateDate);
    }

    //同意取消订单

    //受理订单
    public function undo($id,$order_status,$order_cancel){
        $StateDate=array(
            'orderId'=>$id,
            'order_status'=>$order_status,
            'order_cancel'=>$order_cancel
        );
        return $this->save($StateDate);
    }

    //同意退货
    public function return_goods($id,$order_status){
        $StateDate=array(
            'orderId'=>$id,
            'order_status'=>$order_status
        );
        return $this->save($StateDate);
    }
}