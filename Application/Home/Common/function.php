<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/13
 * Time: 13:07
 */

function get_date(){
    date_default_timezone_set("Asia/Shanghai");
    return date('Y-m-d');
}
//创建Order订单SN编号
function create_guid($parameter = '')
{
    $guid = '';
    $uid = uniqid("", true);
    $data = strlen(trim($parameter)) > 0 ? $parameter : time();
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['LOCAL_ADDR'];
    $data .= $_SERVER['LOCAL_PORT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = substr($hash, 0, 1)  . substr($hash, 8, 4)   . substr($hash, 12, 4)  . substr($hash, 16, 2);
    return $guid;
}
//echo create_guid();

//付款后改变paystatus支付状态
function pay_status_change($out_trade_no){
    if($out_trade_no){
        $map['orderSn']=$out_trade_no;
        $updata=array('pay_status'=>'已付款');
        $object['updateOrder']=M('Order')->where($map)->save($updata);
        return $object;
    }else{
        echo "修改付款状态失败";
    }
}

