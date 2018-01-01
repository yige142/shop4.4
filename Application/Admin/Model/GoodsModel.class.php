<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 20:29
 */
namespace Admin\Model;

use Think\Model;
class GoodsModel extends Model{
    //添加商品数据
    public function register  ($goods_name,$goods_sn,$carriage,$shop_price,
                                $goods_stock,$goods_unit,$goods_info,$goods_classify,
                                $goods_status,$goods_recommend,$goods_competitive,$new_product,
                                $hot_cakes,$img_path,$thumb_path,$goods_describe){
                      $addData=array(
                          'goods_name'=>$goods_name,
                          'goods_sn'=>$goods_sn,
                          'carriage'=>$carriage,
                          'shop_price'=>$shop_price,
                          'goods_stock'=>$goods_stock,
                          'goods_unit'=>$goods_unit,
                          'goods_info'=>$goods_info,
                          'goods_classify'=>$goods_classify,
                          'goods_status'=>$goods_status,
                          'goods_recommend'=>$goods_recommend,
                          'goods_competitive'=>$goods_competitive,
                          'new_product'=>$new_product,
                          'hot_cakes'=>$hot_cakes,
                          'img_path'=>$img_path,
                          'thumb_path'=>$thumb_path,
                          'create_time'=>getTime()
                      );
           if($this->create($addData)){
                $id=$this->add($addData);
               if($id){
                   //向extend附表添加数据
                   M('GoodsExtend')->add(array(
                        'goodsId'=>$id,
                        'goods_describe'=>$goods_describe,
                   ));
               }
               return $id;
           }else{
               return $this->getError();
           }
    }

    //获取商品数据列表
    public function getList($page, $rows, $sort, $order,$goods_search_type=false,$keywords,$goods_type){

        if ($goods_search_type)
        {
            return $this->field('goods_status')->group('goods_status')->select();
        }

       //关键字组合查询
        $map = $keywords_map =  array();
        if ($keywords)
        {
            $keywords_map['goods_name'] = array('like', '%'.$keywords.'%');
            $keywords_map['goods_sn'] = array('like', '%'.$keywords.'%');
            $keywords_map['goods_info'] = array('like', '%'.$keywords.'%');
            $keywords_map['_logic'] = 'OR';
        }
        //把关键字SQL组入$map
        if (!empty($keywords_map)) {
            $map['_complex'] = $keywords_map;
        }

        if($goods_type){
            $map['goods_status']=$goods_type;
        }
        $object=$this->field('goodsId,
                           goods_name,
                           goods_sn,
                           shop_price,
                           goods_recommend,
                           goods_competitive,
                           goods_status,
                           new_product,
                           goods_stock,
                           goods_info,
                           hot_cakes,
                           img_path,
                           thumb_path,
                           create_time')
            ->where($map)
            ->order(array($sort=>$order))
            ->limit(($rows * ($page -1)),$rows)
            ->select();
        return array(
            'total'=>$this->count(),
            'rows'=>$object?$object : ''
        );
    }

    //根据ID获取一条数据
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

    //根据ID修改一条记录
    public function update( $id,$goods_name,$goods_sn,$carriage,
                              $shop_price,$goods_stock,$goods_unit,$goods_info,
                              $goods_classify,$goods_status,$goods_recommend,$goods_competitive,
                              $new_product,$hot_cakes,$img_path,$thumb_path,$goods_describe){
          $updateDate=array(
              'goodsId'=>$id,
              'goods_name'=>$goods_name,
              'goods_sn'=>$goods_sn,
              'carriage'=>$carriage,
              'shop_price'=>$shop_price,
              'goods_stock'=>$goods_stock,
              'goods_unit'=>$goods_unit,
              'goods_info'=>$goods_info,
              'goods_classify'=>$goods_classify,
              'goods_status'=>$goods_status,
              'goods_recommend'=>$goods_recommend,
              'goods_competitive'=>$goods_competitive,
              'new_product'=>$new_product,
              'hot_cakes'=>$hot_cakes,
              'img_path'=>$img_path,
              'thumb_path'=>$thumb_path,
          );
          if($this->create($updateDate)){
              //修改主表
              $affectRow=$this->save($updateDate);
              //修改附表
              $map['goodsId']=$id;
              $extendAffectRow=M('GoodsExtend')->where($map)->save(array(
                  'goods_describe' =>$goods_describe
              ));
              return $affectRow || $extendAffectRow;
          }else{
              return $this->getError();
          }
    }

    //根据ID集合删除记录
    public function remove($ids){
        $affectRow=$this->delete($ids);
        if($affectRow){
            //删除附表
            $map['goodsId']=$ids;
            M(GoodsExtend)->where($map)->delete();
        }
        return $affectRow;
    }

    //商品下架
    public function down($id,$state){
        $StateDate=array(
            'goodsId'=>$id,
            'goods_status'=>$state
        );
        return $this->save($StateDate);
    }

    //审核商品推荐
    public function recommend($id,$state){
        $StateDate=array(
            'goodsId'=>$id,
            'goods_recommend'=>$state
        );
        return $this->save($StateDate);
    }

    //审核设置精品
    public function competitive($id,$state){
        $StateDate=array(
            'goodsId'=>$id,
            'goods_competitive'=>$state
        );
        return $this->save($StateDate);
    }

    //审核设置新品
    public function new_product($id,$state){
        $StateDate=array(
            'goodsId'=>$id,
            'new_product'=>$state
        );
        return $this->save($StateDate);
    }

    //审核设置热销
    public function hot_cakes($id,$state){
        $StateDate=array(
            'goodsId'=>$id,
            'hot_cakes'=>$state
        );
        return $this->save($StateDate);
    }
}