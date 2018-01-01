<?php
namespace Home\Controller;

use Think\Controller;
class IndexController extends Controller {
    public function index(){
   //先显示商品列表
        $Goods = D('Goods');
        echo  $this->assign('list',$Goods->getList());
        echo  $this->assign('fresh',$Goods->get_fresh_List());
        $this->display();
//        $this->display('Index');
    }
    public function logout(){
        session('admin',null);
        $this->redirect('Index');
    }


}