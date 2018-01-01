<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2
 * Time: 14:56
 */
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller{
    public function index(){
        if(session('admin')){
            $this->display();
        }else{
            $this->redirect('/Admin/Login/index');
        }
    }
}