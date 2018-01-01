<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/14
 * Time: 1:40
 */
namespace Home\Model;
use Think\Model;

class OrderModel extends Model{
    //新增操作
    public function register($goods_id,$address_id,$user_id,$order_name,$payment_type,
                             $unit_price,$number,$total_price,$remark,$order_sn){
         $addData=array(
             'goods_id'=>$goods_id,
             'address_id'=>$address_id,
             'orderSn'=>$order_sn,
             'user_id'=>$user_id,
             'order_name'=>$order_name,
             'payment_type'=>$payment_type,
             'unit_price'=>$unit_price,
             'number'=>$number,
             'total_price'=>$total_price,
             'remark'=>$remark,
             'create_time'=>getTime()
         );
        if($this->create($addData)){
            $id=$this->add($addData);
            if($id){
                return $id;
            }else{
                return 0;
            }
        }else{
            return $this->getError();
        }
    }

    //展示list
    public function getList($id,$order, $page, $rows, $sort){
               $map['shop_order.user_id']=$id;
            $object=$this->field(
                   'shop_order.orderId,
                   shop_order.user_id,
                   shop_order.order_name,
                   shop_order.orderSn,
                   shop_order.create_time,
                   shop_order.unit_price,
                   shop_order.number,
                   shop_order.total_price,
                   shop_order.pay_status,
                   shop_order.order_status,
                   shop_order.order_cancel,
                   shop_goods.goodsId,
                   shop_goods.goods_name,
                   shop_goods.goods_info,
                   shop_goods.thumb_path')
                   ->join('shop_goods ON shop_order.goods_id=shop_goods.goodsId','LEFT')
                   ->where($map)
                   ->order(array($sort => $order))
                   ->limit(($rows * ($page - 1)), $rows)
                   ->select();
        return array(
            'total' => $this->field('shop_order.orderId,shop_order.user_id')->where($map)->count(),
            'rows' => $object ? $object : ''
        );
    }

    //用户取消订单
    public function cancel($id,$order_status){
        $StateDate=array(
            'orderId'=>$id,
            'order_status'=>$order_status
        );
        return $this->save($StateDate);
    }

    //用户退货
    public function return_goods($goods_id,$order_id,$return_goods_name,
                                 $return_order_sn,$return_money,$return_reason,$user_id){

        $addData=array(
            'goods_id'=>$goods_id,
            'order_id'=>$order_id,
            'return_goods_name'=>$return_goods_name,
            'return_order_sn'=>$return_order_sn,
            'return_money'=>$return_money,
            'return_reason'=>$return_reason,
            'user_id'=>$user_id,
            'createtime'=>get_date()
        );

            if(M('Return')->create($addData)){
                $id=M('Return')->add($addData);
                if($id){
                    $map['orderId']=$order_id;
                    $updateStatus=array('order_status'=>'退款中');
                    $object['updateOrder']=$this->where($map)->save($updateStatus);
                    return $object;
                }else{
                    return 0;
                }
            }else{
                return $this->getError();
            }

    }

    //用户收货
    public function receive_goods($id,$order_status,$number,$goods_id){
         $StateDate=array(
            'orderId'=>$id,
            'order_status'=>$order_status,
        );
          $object=$this->save($StateDate);
        if($object){
            if($goods_id){
                $map['shop_goods.GoodsId']=$goods_id;
                $updateStock=array(
                    'goods_stock'=>array('exp','goods_stock-'.$number)
                );
                $object['updateGoods']=M('Goods')->where($map)->save($updateStock);
            }
        }
        echo $this->getLastSql();
        return $object;
    }
}
