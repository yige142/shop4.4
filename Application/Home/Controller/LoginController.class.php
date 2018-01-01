<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
       $this->display();
    }

    public function checkUser(){
        if(IS_AJAX){
            $User=D('User');
            echo $User->checkUser(I('post.accounts'),I('post.password'));
        }else{
            return $this->error('非法操作');
        }
    }



}