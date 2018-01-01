<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/12
 * Time: 12:18
 */
namespace Home\Controller;
use Think\Controller;
use Think\Alipay_bizcont;
use Think\AlipayTradeService;
class OrderController extends Controller{
    public function order(){
        if(session('admin')){
            $this->display();
        }else{
            $this->redirect('/Index/login');
        }
    }


    //订单核准
    public function check_order_info(){
        if(session('admin')){
            $Goods=D('Goods');
            echo $this->assign('Goods', $Goods->check_order_info(I('get.id'),I('get.number')));
            $this->display('check_order_info');
        }else{
            $this->redirect('/Index/login');
        }
    }


    //添加订单详情
    public function register(){
        $order_sn=create_guid();
        if(IS_AJAX){
            $Order=D('Order');
            echo $Order->register(I('post.goods_id'),I('post.address_id'),I('post.user_id'),I('post.order_name'),I('post.payment_type'),
                I('post.unit_price'),I('post.number'),I('post.total_price'),I('post.remark'),$order_sn);

            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no =$order_sn;

            //订单名称，必填
            $subject = I('post.order_name');

            //付款金额，必填
            $total_amount = I('post.total_price');

            //商品描述，可空
            $body = I('post.remark');

            //构造参数
            $payRequestBuilder = new Alipay_bizcont();


            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
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
             * pagePay 电脑网站支付请求
             * @param $builder 业务参数，使用buildmodel中的对象生成。
             * @param $return_url 同步跳转地址，公网可以访问
             * @param $notify_url 异步通知地址，公网可以访问
             * @return $response 支付宝返回的信息
             */
            $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
             return $response;
            //输出表单
          // var_dump($response);

        }else{
            $this->error('非法操作！');
        }
    }

    //展示Order List 列表
    public function getList(){
         if(IS_AJAX){
             $Order=D('Order');
             $this->ajaxReturn($Order->getList(I('post.id'),I('post.order'),I('post.page'),I('post.rows'),I('post.sort')));
         }else{
             $this->error('非法操作！');
         }
    }

    //用户取消订单
    public function cancel(){
        if(IS_AJAX){
            $Order=D('Order');
            echo $Order->cancel(I('post.id'),I('post.order_status'));
        }else{
            $this->error('非法操作');
        }
    }

    //用户退货
    public function return_goods(){
        if(IS_AJAX){
            $Order=D('Order');
            echo $Order->return_goods(I('post.goods_id'),I('post.order_id'),I('post.return_goods_name'),
                                        I('post.return_order_sn'),I('post.return_money'),I('post.return_reason'),I('post.user_id'));
        }else{
            $this->error('非法操作');
        }
    }

    //用户收货
    public function receive_goods(){
        if(IS_AJAX){
            $Order=D('Order');
            echo $Order->receive_goods(I('post.id'),I('post.order_status'),I('post.number'),I('post.goods_id'));
        }else{
            $this->error('非法操作');
        }
    }
}