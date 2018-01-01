<?php
/**
 * Created by PhpStorm.
 * User: xiexiaomao
 * Date: 2017/12/8
 * Time: 20:51
 */
namespace Admin\Controller;
use Think\Controller;


use Think\AlipayTradeService;
use Think\AlipayTradeRefundContentBuilder;
class ReturnController extends Controller{
    public function return_goods(){
         if(IS_AJAX){
             $Return=D('Return');
             $result=$Return->getOne(I('post.order_id'));
//             $this->assign('result',$result);
//             $this->display('index');


             //商户订单号，商户网站订单系统中唯一订单号
             $out_trade_no = trim($result['return_order_sn']);

             //支付宝交易号
             $trade_no = trim($_POST['WIDTRtrade_no']);
             //请二选一设置

             //需要退款的金额，该金额不能大于订单金额，必填
             $refund_amount = trim($result['return_money']);

             //退款的原因说明
             $refund_reason = trim($result['return_reason']);

             //标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传
             $out_request_no = trim($_POST['WIDTRout_request_no']);

             //构造参数
             // new AlipayTradeRefundContentBuilder 的类  在Think目录下，会出现找不到类的情况，要加上.class
             //AlipayTradeRefundContentBuilder.class.php 这样就能找到了，同理应该在其他目录引入也
             //要加上.class,之前引入不了应该就是这个原因
             $RequestBuilder=new AlipayTradeRefundContentBuilder();
             $RequestBuilder->setOutTradeNo($out_trade_no);
             $RequestBuilder->setTradeNo($trade_no);
             $RequestBuilder->setRefundAmount($refund_amount);
             $RequestBuilder->setOutRequestNo($out_request_no);
             $RequestBuilder->setRefundReason($refund_reason);
             $config = array (
                 //应用ID,您的APPID。
                 'app_id' => "2016073100136265",

                 //商户私钥
                 'merchant_private_key' => "MIIEpAIBAAKCAQEApJVTHDjMxt40Ea12UPdzRITXDXldmH372kzDpZt83d7RFsZWefI/gW7mdCF61q8/MlxIWdgUkaWZ+gQDG055Ly/8/Sjh7QprgiiEyI2OBRbeUKFCGUj/i+QmNxE4wPA29yPs2z8eyrpIqLbLp2+W9VWwXRx5X2FMOUE8pThJoYauA/gGA1falG3mM5+W+em9L0c90WBKp7lNd1eXnfNoGdGxGqlA5kpumZPESk2AXzm6+BqMKirB0FMAOxk6Iwqyze6heTuPd2s/NwvS6c4aYpRodO6iVUten1TWwo/S2ya78W4gqIqGDmU87AMhdh4eDPqPni+r5OzgXxYM/wGVkQIDAQABAoIBAQCELrXINcopci7Jf9JFpud5wWLinHXSUmSi6AI+EIoRu7GcJAEyAaCFeKc33+fDYo5UCQ/GsKecbi8jQHOqS7VCc70xKdOByFud9qLmW+ITLlGw2kK3AgzTspIKqhc1xfevN7g0Qhad5U0Ty3P27sWEFqUFsye7te49Ear+Wx2vzqwNf8a79+bqv+S8LUBdbB6hZLrik2IAf9bmX1Yx2sUuizxPRLuA9RloIlJu2u8c8eyEgsckKdDZAuOZW0Uxi3hg+CiLiec1P2XqmQcv198uMAx/S+4W4IsftyuXxGa1eR7YJtAxyHNrq63wnt0dhm0ow+TbKNOsNqh/1LeP0Kj9AoGBANZ80x0L3fo/xHBUGt6LEBi5MKrjly60cpv6VyCgJmwUqWZCz9jHJehqVguu3U4aSM1nsK/wle3Pv63mSQuu+TbqK/e9ksxiF5P8zmLD71uduMT4DePqsaEtx5KkCtJsF+tIGdqk7HUBTjkREwnLrVRx551nIaPYlONkEVzzmou7AoGBAMRv5sZ8A2NFwrNax2Ji5JNjIzQdXZ50B0JbYMXQ8rADimX/4I12L2IL1bVfOV0ETXZRricmd6BjwcqH/BLS3jTc+RNOPl2GJFMwom28dY2mfO3878aMpyntQNnrxZqLjNdgek0LS0fl90gK6MnZjW0qaBE8QXD/IKGTL/U80kEjAoGALRhzfpDnK91KXN+iApY0XS5aiCNvvtcbnaXFuctSKLkzYJe9gXNlifcJfk1WpDwsgFtDr8oii6x5PYPEadtw9FXJxr2p5qTdFjU541QUuCtyFJ+etAO9MwkgA7nPuKwXX1V6chjoyjTrEF6BpTaYi7+jFdoAHaXEsAZzDBr/rE8CgYEAhJ1XGyCV2Os7qoHaoV1KGwaOuZwpm9ORIwc1qdaKQLHjOUEpg9cJ3hNHT47d1yIUeZBjFiMuF6XBKs3rK3oYcW/M52+nQtRQqajnv1W/tsVzCef8p/pE0FVPts8pNFCJ4M1NQ74gMIXcD1LuHXc1t0EtyJT5SSO0D+CiO9m3yCkCgYA/Qjr2RQm7pmIeMKoMAgrKaiN252SvsGVswfEb3mMEWpTq9IFaSg4m1AiLU6S5z61IGDiFnDyUp1OdnNdRb5pZNXPjfFATjFSWv8ifkPsHq3PGwgdEQD+lzUul6Ktr5PvIn1/fO+71zRAKFmSILxCnXiZRtB46QyEArBAqa5jv4w==",

                 //异步通知地址
                 'notify_url' => "http://139.199.166.244/shop/Alipay/notify_url",

                 //同步跳转
                 'return_url' => "http://139.199.166.244/shop/Alipay/return_url",

                 //编码格式
                 'charset' => "UTF-8",

                 //签名方式
                 'sign_type'=>"RSA2",

                 //支付宝网关
                 'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

                 //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
                 'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAp5NmVEHz9wirLDGc4bSOJp7rt/Ve7iiTJri5T4z/JVlh46MdjWj6GSdECaxkk27iA1y+igEtnMOVWu+ZSOUAlTA8+bWXj3FEU71GqwL+5O55R+FUea4GbV2q0gpNaxi1WknhKkxAaLbMSdd3ltyh8FnK8mfQ8HpTPFg+kx0jhBC836Cm6dVkpKauw3/DIeYXc1vG5NuImY58N7RLtjyr+AaYhbp/sj7fCk6puuhtwdU8rceCwSa8uLS0E5r40tRyiXjcjhwAUqM2Lsdshe+i+u/Fj/H+kkl/DyYUex+Rnp7cI+2qAJNvLgBU3yA1w/w51Fo8UCXSbt5KX2F/mOfnGQIDAQAB",
             );
             $aop = new AlipayTradeService($config);

             /**
              * alipay.trade.refund (统一收单交易退款接口)
              * @param $builder 业务参数，使用buildmodel中的对象生成。
              * @return $response 支付宝返回的信息
              */
             $response = $aop->Refund($RequestBuilder);
            //  var_dump($response) ;
              //echo gettype($response);
             $msg=$response->msg;
             //判断从支付宝返回的msg信息是不是成功，是成功的话更新订单的商品状态
             if($msg==='Success'){
                 $map['orderId']=$result['order_id'];
                 $update_order_status=array('order_status'=>'已退款');
                 M('Order')->where($map)->save($update_order_status);
                 return 1;
             }else{
                 return 0;
             }
//             echo $response;
//             return $response;
         }else{
             $this->error('非法操作！');
         }
    }
}

