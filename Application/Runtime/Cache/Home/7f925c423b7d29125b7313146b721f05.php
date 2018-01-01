<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>商城首页</title>
        <link href="/shop3.6/Public/Home/css/index.css" rel="stylesheet" type="text/css">
        <link href="/shop3.6/Public/Home/css/user.css" rel="stylesheet" type="text/css">
        <link href="/shop3.6/Public/Home/css/user/base_info.css" rel="stylesheet" type="text/css">
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
<!--<?php-->
<!--var_dump($object);-->
<!--?>-->
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
        <div class="main_title">基本资料:</div>
        <hr/>
        <div class="baseInfo_area">

                <table id="base_info">
                  <input type="hidden" id="User_id" value="<?php echo session('admin')['id'];?>" >
                    <input type="hidden" id="base_info_id" name="id" >
                    <!--<tr>-->
                        <!--<td>当前头像：</td>-->
                        <!--<td><input type="file"></td>-->
                    <!--</tr>-->
                    <tr class="table_raw">
                        <td>昵称:</td>
                        <td><input type="text" id="nickname" value="<?php echo session('admin')['accounts'];?>" ></td>
                    </tr>
                    <tr class="table_raw">
                        <td>
                            性别:
                        </td>
                        <td name="input">
                            <a href="javascript:void(0)" id="staff-add-gender-1" name="staff-add-gender" class="easyui-linkbutton">男</a>
                            <a href="javascript:void(0)" id="staff-add-gender-2" name="staff-add-gender" >女</a>
                            <input type="hidden" id="staff-add-gender" value="男" name="sex">
                        </td>
                    </tr>
                    <tr class="table_raw">
                        <td>
                            生日:
                        </td>
                        <td>
                            <input type="text" id="birthday" name="birthday">
                        </td>
                    </tr>
                    <tr class="table_raw">
                        <td>手机 <?php echo ($object["phone"]); ?></td>
                        <td><input type="text" class="phone" id="phone" name="phone"></td>
                    </tr>
                    <tr class="table_raw">
                        <td>邮箱</td>
                        <td><input type="text" class="email" id="email" name="email"></td>
                    </tr>
                    <tr class="table_raw">
                        <td >
                        </td>
                        <td >
                            <input class="btn btn-info" type="submit" value="确认提交" id="base_info_submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--<?php-->
<!--var_dump($object);-->
<!--?>-->
<!--尾部-->
<div class="end">
    <hr/>
    <div class="end_text">小毛果园-只为新鲜</div>
    <hr/>
</div>
</body>
<script type="text/javascript" src="/shop3.6/Public/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop3.6/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="/shop3.6/Public/Home/js/user/base_info.js"></script>
<script type="text/javascript" src="/shop3.6/Public/Home/js/public.js"></script>
</html>