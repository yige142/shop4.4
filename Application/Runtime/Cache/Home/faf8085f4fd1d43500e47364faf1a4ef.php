<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>商城首页</title>
        <link href="/shop4.3/Public/Home/css/index.css" rel="stylesheet" type="text/css">
        <link href="/shop4.3/Public/Home/css/user.css" rel="stylesheet" type="text/css">
        <link href="/shop4.3/Public/Home/css/order/order.css" rel="stylesheet" type="text/css">
        <link href="/shop4.3/Public/Home/css/order/return_order.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/shop4.3/Public/easyui/themes/bootstrap/easyui.css">
        <link rel="stylesheet" href="/shop4.3/Public/easyui/themes/icon.css">
        <!--加载Bootstrap的CSS   /shop4.3/Public在Home->Config中配置-->
        <link href="/shop4.3/Public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="/shop4.3/Public/Home/js/jquery-3.2.1.min.js"></script>
        <script src="/shop4.3/Public/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">
            var ThinkPhP={
                'MODULE':'/shop4.3/Home',
                'IMG':'/shop4.3/Public/Home/img',
                'INDEX':'<?php echo U("Index/index");?>',
                'ROOT':'/shop4.3'
            };
        </script>

        <style type="text/css">
            /*opacity是设置遮罩透明度的，可以自己调节*/
            #loading{position:fixed;top:0;left:0;width:100%;height:100%;background:#f9f9f9;opacity:1;z-index:15000;}
            #loading img{position:absolute;top:50%;left:50%;width:30px;height:30px;margin-top:-15px;margin-left:-15px;}
            #loading p{position:absolute;top:55%;left:48%;width:30px;height:30px;margin-top:-15px;margin-left:-15px;}
        </style>
    </head>

<body>
<!--遮罩loading-->
<div id="loading" class="list-item">
    <img alt="" src="/shop4.3/Public/Home/img/loading.gif"><br>
    <p style="line-height: 24px;">loading...</p>
</div>


    <!--头部 显示标题-->
    <div class="top">
        <div class="top_header">
            <div class="top_header_left glyphicon glyphicon-plane">深圳-满百包邮(环郊内)-星夜达
            </div>

            <?php if(session('admin')): ?><div class="top_header_right">
                    <ul class="list_inline">
                        <li><a href="<?php echo U('Index/logout');?>">[退出]</a></li>
                        <li>您好:<a href="<?php echo U('User/user');?>"><?php echo session('admin')['accounts'];?></a></li>
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
                        <a class="navbar-brand" href="#"><img src="/shop4.3/Public/Home/img/logo3.png"></a>
                    </div>
                    <input type="hidden" id="User_id" value="<?php echo session('admin')['id'];?>">
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


<!--用户菜单-->

<div class="user_menu">
    <hr/>
    <div class="sidebar">
        <ul class="list-group">
            <!--<a href="<?php echo U('User/user');?>" ><li class="list-group-item">我的账户</li></a>-->
            <a href="<?php echo U('Order/order');?>"><li class="list-group-item">我的订单</li></a>
            <!--<a href="#"><li class="list-group-item">账户余额</li></a>-->
            <a href="<?php echo U('User/base_info');?>"><li class="list-group-item">基本资料</li></a>
            <a href="<?php echo U('User/password');?>"><li class="list-group-item">密码修改</li></a>
            <a href="<?php echo U('User/shipping_address');?>"><li class="list-group-item">收货地址</li></a>

        </ul>
    </div>
    <div class="main">
        <div class="main_title">订单信息:</div>

        <div class="baseInfo_area">
            <table id="order"></table>
        </div>

    </div>
</div>
<!--工具条-->
<form id="order-tool" style="padding: 5px;">
    <div class="tool-search">
        <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-reload" onclick="orderOpt.reload()">刷新表</a>
    </div>
</form>


<!--退款面板-->

    <table id="return_money_table" >
        <tbody >
        <tr>
            <td>
                <div class="return_goods_name">
                    <label class="goods_name">退款商品：</label>
                    <img id="return_img" src="/shop4.3/Public/Home/img/loading.gif" width="100" height="100" border="0" />
                    <span class="orders_name"></span>
                    <input type="hidden" id="return_orders_name">
                    <input type="hidden" id="return_order_sn">
                    <input type="hidden" id="orders_id">
                  <input type="hidden" id="goods_id">
                </div>

            </td>
            <!--<td rowspan="6" valign="top" >-->
                <!--<div style="margin-left:85px">-->
                    <!--<p><input type="file" name="file" id="file"></p>-->
                    <!--<img id="img" src="/shop4.3/Public/Home/img/default.png" width="170" height="150" border="0" />-->
                    <!--<input type="hidden" id="image_path"><input type="hidden" id="thumb_path">-->
                <!--</div>-->
            <!--</td>-->
        </tr>
        <tr>
            <td >
                <div class="return_order_sn">
                    <label for="return_money">退款金额：</label><input type="text" id="return_money">
                </div>
            </td>
        </tr>
        <tr>
            <td >
                <div class="return_order_sn">
                    <label for="return_reason" class="reason">退款原因 :</label>
                    <textarea  id="return_reason"  ></textarea>
                </div>

            </td>

        </tr>
        </tbody>
    </table>
<!--<?php-->
<!--echo get_date();-->
<!--?>-->
<!--尾部-->
<div class="end">
    <hr/>
    <div class="end_text">小毛果园-只为新鲜</div>
    <hr/>
</div>

<!--遮罩JS-->
<script type="text/javascript">
    //监听加载状态改变
    document.onreadystatechange = completeLoading;
    //加载状态为complete时移除loading效果
    function completeLoading() {
        if (document.readyState == "complete") {
            $("#loading").hide();
        }
    }
</script>
</body>
<script type="text/javascript" src="/shop4.3/Public/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop4.3/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Home/js/Order/datagrid-detailview.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Home/js/Order/order.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Home/js/public.js"></script>
</html>