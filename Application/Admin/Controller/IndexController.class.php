<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

     if(session('admin')['accounts']=='admin'){
          $this->display();
     }else{
         $this->redirect('/Admin/Login/index');
     }
    }
}