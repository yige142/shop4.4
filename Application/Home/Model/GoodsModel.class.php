<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 11:06
 */

namespace Home\Model;

use Think\Model;
class GoodsModel extends Model{
    //获取商品数据列表
    public function getList(){
        $object=$this->field('goodsId,
                           goods_name,
                           goods_sn,
                           shop_price,
                           goods_status,
                           goods_unit,
                           goods_classify,
                           img_path,
                           thumb_path,
                           create_time')
//            ->order(array($sort=>$order))
//            ->limit(($rows * ($page -1)),$rows)

            ->limit(10)
            ->select();
//        return array(
//            'total'=>$this->count(),
//            'rows'=>$object?$object : ''
//        );
   return $object;
    }

    public function get_fresh_List(){
        $map['goods_classify']='生鲜';
        $object=$this->field('goodsId,
                           goods_name,
                           goods_sn,
                           shop_price,
                           goods_status,
                           goods_unit,
                           goods_classify,
                           img_path,
                           thumb_path,
                           create_time')
//            ->order(array($sort=>$order))
//            ->limit(($rows * ($page -1)),$rows)
            ->where($map)
            ->limit(10)
            ->select();

        return $object;
    }

    //根据ID打开该商品购买页
    public function getOne($id){
        $map['shop_goods.goodsId']=$id;
        $object=$this->field('shop_goods.goodsId,
                               shop_goods.goods_name,
                               shop_goods.img_path,
                               shop_goods.thumb_path,
                               shop_goods.goods_sn,
                               shop_goods.carriage,
                               shop_goods.shop_price,
                               shop_goods.goods_stock,
                               shop_goods.goods_unit,
                               shop_goods.goods_info,
                               shop_goods.goods_classify,
                               shop_goods.goods_status,
                               shop_goods.goods_recommend,
                               shop_goods.goods_competitive,
                               shop_goods.new_product,
                               shop_goods.hot_cakes,
                               shop_goods_extend.goods_describe')
            ->join('shop_goods_extend ON shop_goods.goodsId=shop_goods_extend.goodsId','LEFT')
            ->where($map)
            ->find();
        $object['goods_describe']=htmlspecialchars_decode($object['goods_describe']);
        return $object;
    }

    //注入审核订单的数据
    public function check_order_info($id,$number){
        $map['goodsId']=$id;
        $object=$this->field(
            'goodsId,goods_name,thumb_path,carriage,shop_price,
            goods_stock,goods_unit,goods_info,goods_classify'
        )->where($map)->find();
        $object['number']=$number;
        return $object;
    }

    //More 链接获取水果列表
    public function goods_get_list($map='',$page){
        $object=$this->field('goodsId,
                           goods_name,
                           goods_sn,
                           shop_price,
                           goods_status,
                           goods_unit,
                           goods_classify,
                           img_path,
                           thumb_path,
                           create_time')
//            ->order(array($sort=>$order))
             ->limit((20 * ($page -1)),20)
             ->where($map)
             //->limit(20)
             ->select();
//       echo $this->getLastSql();
       // print_r($object) ;

        return $object;
    }
    //More 链接获取水果列表
    public function goods_fruit_list(){
        $map['goods_classify']='水果';
        $page=1;
        return  $this->goods_get_list($map,$page);
    }

    //page 链接查看水果列表
    public function page_fruit_list($page){
        $map['goods_classify']='水果';
        return  $this->goods_get_list($map,$page);
    }

    //More 链接获取生鲜列表
    public function goods_fresh_list(){
        $map['goods_classify']='生鲜';
        $page=1;
        return  $this->goods_get_list($map,$page);
    }


    //page 链接查看生鲜列表
    public function page_fresh_list($page){
        $map['goods_classify']='生鲜';
        return  $this->goods_get_list($map,$page);
    }
}