<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>商城首页</title>
        <link href="/shop3.6/Public/Home/css/index.css" rel="stylesheet" type="text/css">
        <link href="/shop3.6/Public/Home/css/user.css" rel="stylesheet" type="text/css">
        <link href="/shop3.6/Public/Home/css/user/password.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/shop3.6/Public/easyui/themes/bootstrap/easyui.css">
        <link rel="stylesheet" href="/shop3.6/Public/easyui/themes/icon.css">
        <!--滚动图片CSS-->
        <link href="/shop3.6/Public/Home/css/lunbo.css" rel="stylesheet" type="text/css" />
        <!--加载Bootstrap的CSS   /shop3.6/Public在Home->Config中配置-->
        <link href="/shop3.6/Public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="/shop3.6/Public/Home/js/jquery-3.2.1.min.js"></script>
        <script src="/shop3.6/Public/bootstrap/js/bootstrap.js"></script>

        <script type="text/javascript">
            var ThinkPhP={
                'MODULE':'/shop3.6/Home',
                'IMG':'/shop3.6/Public/Home/img',
                'INDEX':'<?php echo U("Index/index");?>'
            };
        </script>
    </head>

<body>

    <!--头部 显示标题-->
    <div class="top">
        <div class="top_header">
            <div class="top_header_left glyphicon glyphicon-plane">深圳-满百包邮(环郊内)-星夜达
            </div>
            <?php if(session('admin')): ?><div class="top_header_right">
                    <ul class="list_inline">
                        <li><a href="<?php echo U('Index/logout');?>">[退出]</a></li>
                        <li>您好:<a href="<?php echo U('Order/order');?>"><?php echo session('admin')['accounts'];?></a></li>
                        <li><a href="#">[果园公告]</a></li>
                        <li><a href="#">[卷卡兑换]</a></li>
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
                        <a class="navbar-brand" href="#"><img src="/shop3.6/Public/Home/img/logo3.png"></a>
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
    <div class="main_title">修改密码:</div>
    <hr/>
    <div class="edit_password_area">
        <form id="editPassword" method="post" action="">
        <table  >
            <input type="text" id="User_id" value="<?php echo session('admin')['id'];?>" hidden="true"><br>
            <tr class="table_raw">
                <td >
                    原密码:
                </td>
                <td>
                    <input type="password" id="oldPassWord"><br>
                </td>
            </tr>
            <tr class="table_raw">
                <td>
                    新密码:
                </td>
                <td>
                    <input type="password" id="newPassWord">
                </td>
            </tr>
            <tr class="table_raw">
                <td>
                    确认密码:
                </td>
                <td>
                    <input type="password" id="newPassWord2">
                </td>
            </tr>
            <tr class="table_raw">
                <td >
                </td>
                <td >
                    <input class="btn btn-info" type="submit" value="确认提交" id="submit">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>
</div>

<!--尾部-->
<div class="end">
    <hr/>
    <div class="end_text">小毛果园-只为新鲜</div>
    <hr/>
</div>
</body>
<script type="text/javascript" src="/shop3.6/Public/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop3.6/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="/shop3.6/Public/Home/js/user/password.js"></script>
<script type="text/javascript" src="/shop3.6/Public/Home/js/public.js"></script>
</html>