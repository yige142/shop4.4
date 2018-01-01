<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 11:04
 */

namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller{
    public function goods_detail(){
        if(session('admin')){
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }
    }


  //加载购买商品也详情
    public function getGoodsDetails(){
        if(session('admin')){
            $Goods=D('Goods');
            echo  $this->assign('Goods', $Goods->getOne(I('get.id')));
            $this->display('goods_detail');
        }else{
            $this->redirect('/Index/login');
        }
    }

   //查看水果更多 more 列表页
    public function goods_fruit_list(){
        if(session('admin')){
            $Goods=D('Goods');
            echo  $this->assign('list', $Goods->goods_fruit_list());
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }
    }
   //分页查看水果More 列表页
    public function page_fruit_list(){
        $Goods=D('Goods');
        echo  $this->assign('list', $Goods->page_fruit_list(I('get.page')));
        $this->display('goods_fruit_list');
    }

    //查看生鲜More 列表页
    public function goods_fresh_list(){
        if(session('admin')){
            $Goods=D('Goods');
            echo  $this->assign('list', $Goods->goods_fresh_list());
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }
    }

    //分页查看生鲜More 列表页
    public function page_fresh_list(){
        $Goods=D('Goods');
        echo  $this->assign('list', $Goods->page_fresh_list(I('get.page')));
        $this->display('goods_fresh_list');
    }
}