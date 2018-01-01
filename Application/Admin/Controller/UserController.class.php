<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/9
 * Time: 16:05
 */
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{
       public function index(){
           $this->display();
       }
       public function getList(){
           if(IS_AJAX ){
               $User=D('User');
               $this->ajaxReturn($User->getList(I('post.page'),I('post.rows'),I('post.sort'),I('post.order'),I('post.keywords'),
                                                   I('post.dateType'),I('post.dateFrom'),I('post.dateTo'),I('post.state')));
           }else{
               $this->error('非法操作');
           }
       }
      //根据ID获取一条记录
       public function getOne(){
           if(IS_AJAX){
                $User=D('User');
                $this->ajaxReturn($User->getOne(I('post.id')));
           }else{
               $this->error('非法操作');
           }
       }

       //根据ID修改一条记录
       public function update(){
           if(IS_AJAX){
               $User=D('User');
               echo $User->update(I('post.id'),I('post.password'),I('post.state'));
           }else{
               $this->error('非法操作');
           }
       }
    //根据ID修改密码
       public function editPassword(){
           if(IS_AJAX){
                $User=D('User');
                echo $User->editPassword(I('post.id'),I('post.password'),I('post.notPassword'));
           }else{
               $this->error('非法操作');
           }
       }

      //审核状态
       public function state(){
           if(IS_AJAX){
               $User=D('User');
               echo $User->state(I('post.id'),I('post.state'));
           }else{
               $this->error('非法操作');
           }
       }
       //添加账号
       public  function register(){
           if(IS_AJAX){
               $User= D('User');
                echo $User->register(I('post.accounts'),I('post.password'),I('post.outRegister'));
           }else{
               $this->error('非法操作');
           }
       }
    //根据ID删除账号
    public function remove(){
        if(IS_AJAX){
            $User=D('User');
            echo $User->remove(I('post.ids'));
        }else{
            $this->error('非法操作');
        }
    }
}