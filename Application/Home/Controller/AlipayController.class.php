<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/19
 * Time: 10:39
 */
namespace Home\Controller;
use Think\Controller;
use Think\AlipayTradeService;
class AlipayController extends Controller{

    public function notify_url(){
        $arr=$_POST;
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
        $alipaySevice = new AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
//                echo $this->assign('order', $trade_no);
//                $this->display();
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";	//请不要修改或删除
        }else {
            //验证失败
            echo "fail";

        }
    }


    //从alipy例子中获取的return_rul.php的代码，封装到这里面的，支付宝付款成功，跳转有页面
    public function return_url(){
        $arr=$_GET;
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
        $alipaySevice = new AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);

     //     echo "验证成功<br />jiaoyihao：".$trade_no;
     //       echo "验证成功<br />dingdanhao：".$out_trade_no;
            //pay_status_change 写在common function中
            pay_status_change($out_trade_no);
            $this->redirect('/Order/order');
            //$this->display();
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }
}