<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--------------------------------------------前台商品详情页--------------------------------------------------->
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>商城首页</title>
        <link href="/shop4.2/Public/Home/css/index.css" rel="stylesheet" type="text/css">
        <link href="/shop4.2/Public/Home/css/user.css" rel="stylesheet" type="text/css">
        <link href="/shop4.2/Public/Home/css/goods/detail.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/shop4.2/Public/easyui/themes/bootstrap/easyui.css">
        <link rel="stylesheet" href="/shop4.2/Public/easyui/themes/icon.css">
        <!--加载Bootstrap的CSS   /shop4.2/Public在Home->Config中配置-->
        <link href="/shop4.2/Public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="/shop4.2/Public/Home/js/jquery-3.2.1.min.js"></script>
        <script src="/shop4.2/Public/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">
            var ThinkPhP={
                'MODULE':'/shop4.2/Home',
                'IMG':'/shop4.2/Public/Home/img',
                'INDEX':'<?php echo U("Index/index");?>'
            };
        </script>
    </head>

<body>

    <!--头部 显示标题-->
    <div class="top">
        <div class="top_header">
            <div class="top_header_left glyphicon glyphicon-plane">深圳-满百包邮(环郊内)-星夜达
                <input type="hidden" value="<?php echo session('admin')['id'];?>" id="session_id">
            </div>

            <?php if(session('admin')): ?><div class="top_header_right">
                    <ul class="list_inline">
                        <li><a href="<?php echo U('Index/logout');?>">[退出]</a></li>
                        <li>您好:<a href="<?php echo U('Order/order');?>"><?php echo session('admin')['accounts'];?></a></li>
                    </ul>
                </div>
                <?php else: ?>
                <div class="top_header_right">
                    <ul class="list_inline">
                        <li><a href="<?php echo U('Index/login');?>">[登录]</a></li>
                    </ul>
                </div><?php endif; ?>



        </div>
        <!--导航分类-->
        <div class="top_content">
            <nav class="navbar " role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"><img src="/shop4.2/Public/Home/img/logo3.png"></a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                            <li ><a href="<?php echo U('Index/index');?>" ><h4 class="glyphicon glyphicon-home">首页</h4></a></li>
                            <li><a href="<?php echo U('Goods/goods_fruit_list');?>"><h4 class="glyphicon glyphicon-tree-deciduous">鲜果</h4></a></li>
                            <li ><a href="<?php echo U('Goods/goods_fresh_list');?>"><h4 class="glyphicon glyphicon-cutlery">生鲜</h4></a></li>
                            <li><a href="javascript:void(0)" id="gift"><h4 class="glyphicon glyphicon-heart-empty">礼品</h4></a></li>
                            <li><a href="javascript:void(0)" id="vip"><h4 class="vip">VIP会员中心</h4></a></li>
                        </ul>
                    </div>
                    <div class="navbar-right">
                        <div class="input-group">
                            <input type="text" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-info " type="button">
                            <span class="glyphicon glyphicon-search"></span> 搜索
                        </button>
					</span>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

<!--<?php-->
<!--var_dump($Goods);-->
<!--?>-->
<!--&lt;!&ndash;显示商品区域&ndash;&gt;-->
<!--<form>-->

<div class="shop-contain">
    <div class="shop-goods-detail">
        <div class="detail-left">
            <img src="/shop4.2/Uploads/<?php echo ($Goods["img_path"]); ?>" id="show_img">
        </div>
        <div class="detail-right">

            <table class="goods-des-tab">
                <tbody>
                <tr>
                    <td colspan="2">
                        <div class="des-title" ><h3><?php echo ($Goods["goods_name"]); ?></h3></div>
                        <div class="goods-info"><?php echo ($Goods["goods_info"]); ?></div>
                        <input type="hidden" value="<?php echo ($Goods["goodsId"]); ?>" id="goods_detail_goods_id">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="des-chux">
                            <div class="jiage">
                                价格 ：<span id="shopGoodsPrice_255" dataid="" class="shop-price">￥<?php echo ($Goods["shop_price"]); ?></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr >
                    <td colspan="2">
                        <div class="des-title-span">
                            配送至：xx市xx区……
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="transportation_expenses">
                            运费：<?php echo ($Goods["carriage"]); ?>元
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="serve">
                            服务：由<a href="">小毛果园</a>配送，并提供售后服务
                        </div>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">

                        <div class="quantity">
                            购买数量：<input type="text" id="quantity"> 库存<?php echo ($Goods["goods_stock"]); echo ($Goods["goods_unit"]); ?>
                        </div>

                    </td>
                </tr>
                <tr >
                    <td colspan="2">
                        <div class="car_button">
                          <!--<a href="<?php echo U('Order/check_order_info',array('id'=>$Goods['goodsId']));?>" id="buy_button" target="_blank"><img src="/shop4.2/Public/Home/img/buy.png" class="car_button_img"></a>-->
                            <a href="javascript:void(0)" id="buy_button"><img src="/shop4.2/Public/Home/img/buy.png" class="car_button_img"></a>
                          <!--<button type="button" id="buy_button">购买</button>-->
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="see-again">
        <img src="/shop4.2/Public/Home/img/shopinfo.png">
    </div>
</div>
<!--</form>-->


<!--显示评论区域-->
<div class="shop-goods-comment">
    <div class="goods-comment-area">
        <ul class="nav nav-tabs" id="goods_comment">
            <li class="active" value="0"><a href="#">商品详情</a></li>
            <li value="1"><a href="#" >商品评论</a></li>
        </ul>

    </div>
    <div class="goods-info-area">
        <?php echo ($Goods["goods_describe"]); ?>
    </div>
    <div class="goods-Review-area">
        建设中........
    </div>
</div>


<!--尾部-->
<div class="end">
    <hr/>
    <div class="end_text">小毛果园-只为新鲜</div>
    <hr/>
</div>
</body>

<script type="text/javascript" src="/shop4.2/Public/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop4.2/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/shop4.2/Public/Home/js/goods/goods_detail.js"></script>
<script type="text/javascript" src="/shop4.2/Public/Home/js/index.js"></script>
<script type="text/javascript" src="/shop4.2/Public/Home/js/public.js"></script>
</html>