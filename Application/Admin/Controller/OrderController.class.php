<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/14
 * Time: 19:42
 */
namespace Admin\Controller;
use Think\Controller;
class OrderController extends BaseController{
    //展示Order List 列表
    public function getList(){
        if(IS_AJAX){
            $Order=D('Order');
            $this->ajaxReturn($Order->getList(I('post.order'),I('post.page'),I('post.rows'),I('post.sort'),I('post.order_status'),
                I('post.order_cancel'), I('post.keywords'),I('post.goodsType'),I('post.cancel')));
        }else{
            $this->error('非法操作！');
        }
    }

    //受理订单
    public function receive(){
        if(IS_AJAX){
            $Order=D('Order');
            echo $Order->receive(I('post.id'),I('post.order_status'));
        }else{
            $this->error('非法操作');
        }
    }

    //同意取消订单
    public function undo(){
        if(IS_AJAX){
            $Order=D('Order');
            echo $Order->undo(I('post.id'),I('post.order_status'),I('post.order_cancel'));
        }else{
            $this->error('非法操作');
        }
    }

    //同意退货
    public function return_goods(){
        if(IS_AJAX){
            $Order=D('Order');
            echo $Order->return_goods(I('post.id'),I('post.order_status'));
        }else{
            $this->error('非法操作');
        }
    }
}