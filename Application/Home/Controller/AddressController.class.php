<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31
 * Time: 13:46
 */
namespace Home\Controller;
use Think\Controller;

class AddressController extends Controller{
    //获取该用户的地址信息
    public function getList(){
        $Address=D('Address');
        $this->ajaxReturn($Address->getList(I('post.id'),I('post.page'),I('post.rows'),I('post.sort'),I('post.order')));
    }

    //天加用户地址信息
    public function register(){
        if(session('admin')){
            if(IS_AJAX){
                $Address=D('Address');
                echo $Address->register(I('post.uid'),I('post.name'),I('post.phone'),I('post.address'),I('post.tab'));
            }else{
                $this->error('非法操作');
            }
        }else{
            $this->redirect('/Index/login');
        }

    }

    //返回一条要修改的地址信息
    public function getOne(){
        if(IS_AJAX){
            $Address=D('Address');
            $this->ajaxReturn($Address->getOne(I('post.id')));
        }else{
            $this->error('非法操作');
        }
    }

    //根据ID修改一条记录
    public function update(){
        if(IS_AJAX){
            $Address=D('Address');
            echo $Address->update(I('post.id'),I('post.name'),I('post.phone'),I('post.address'),I('post.tab'));
        }else{
            $this->error('非法操作');
        }
    }

    //根据ID删除账号
    public function remove(){
        if(IS_AJAX){
            $Address=D('Address');
            echo $Address->remove(I('post.id'));
        }else{
            $this->error('非法操作');
        }
    }
}