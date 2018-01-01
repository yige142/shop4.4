<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 17:22
 */
use Think\Auth;

//得到当前的时间
function getTime(){
    date_default_timezone_set("Asia/Shanghai");
    return date('Y-m-d H:i:s');
}



//设置权限，有权限则显示，没权限就隐藏
function checkbutton($a){
    $auth=new Auth();
    if($auth->check($a,session('admin')['id'])){

        return 1;
    }else{
        return 2;
    }
}