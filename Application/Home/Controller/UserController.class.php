<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 0:10
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{

    public function base_info(){
        if(session('admin')){
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }
    }

    public function password(){
        if(session('admin')){
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }
    }

    public function shipping_address(){
        if(session('admin')){
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }
    }

    public function index(){
        $this->display();
    }

    //添加账号
    public function register(){
        if(IS_AJAX){
            $User= D('User');
            echo $User->register(I('post.accounts'),I('post.password'));
        }else{
            $this->error('非法操作');
        }
    }


    public function user(){
        if(session('admin')){
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }

    }

    //修改密码
    public function editPassword(){
        if(IS_AJAX){
            $User=D('User');
            echo $User->editPassword(I('post.id'),I('post.oldPassword'),I('post.password'));
        }else{
            $this->error('非法操作');
        }
    }

   //获取一条用户基本资料
   public function getOne(){
       if(IS_AJAX){
           $BaseInfo=D('BaseInfo');
           $result=$BaseInfo->getOne(I('post.id'));
           if($result){
               $this->ajaxReturn($result);
           }else{
               $this->error('操作失败');
           }

       }else{
           $this->error('非法操作');
       }
   }

    //修改用户信息
    public function update(){
        if(IS_AJAX){
            $BaseInfo=D('BaseInfo');
            echo $BaseInfo->update(I('post.id'),I('post.sex'),I('post.birthday'),I('post.phone'),I('post.email'));
        }else{
            $this->error('非法操作');
        }
    }


}