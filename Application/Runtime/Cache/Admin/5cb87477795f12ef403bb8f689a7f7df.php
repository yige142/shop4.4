<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品详情</title>
    <link href="/shop4.2/Public/Admin/css/detail/index.css" rel="stylesheet" type="text/css">
    <link href="/shop4.2/Public/Admin/css/detail/user.css" rel="stylesheet" type="text/css">
    <link href="/shop4.2/Public/Admin/css/detail/detail.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/shop4.2/Public/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="/shop4.2/Public/easyui/themes/icon.css">
    <!--滚动图片CSS-->
    <!--<link href="/shop4.2/Public/Admin/css/lunbo.css" rel="stylesheet" type="text/css" />-->
    <!--加载Bootstrap的CSS   /shop4.2/Public在Home->Config中配置-->
    <link href="/shop4.2/Public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="/shop4.2/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script src="/shop4.2/Public/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        var ThinkPhP={
            'MODULE':'/shop4.2/Admin',
            'IMG':'/shop4.2/Public/Admin/img',
            'INDEX':'<?php echo U("Index/index");?>'
        };
    </script>
</head>
<body>
<!--<?php-->
<!--var_dump($Goods);-->
<!--?>-->

<!--头部 显示标题-->
<div class="top">
    <div class="top_header">
        <div class="top_header_left glyphicon glyphicon-plane">深圳-满百包邮(环郊内)-星夜达
        </div>

        <?php if(session('admin')): ?><div class="top_header_right">
                <ul class="list_inline">
                    <li><a href="<?php echo U('Login/logout');?>">[退出]</a></li>
                    <li>您好:<?php echo session('admin')['accounts'];?></li>
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
                    <a class="navbar-brand" href="#"><img src="/shop4.2/Public/Admin/img/logo3.png"></a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li ><a href="<?php echo U('Index/index');?>" ><h4 class="glyphicon glyphicon-home">首页</h4></a></li>
                        <li><a href="#"><h4 class="glyphicon glyphicon-tree-deciduous">鲜果</h4></a></li>
                        <li ><a href="#"><h4 class="glyphicon glyphicon-cutlery">生鲜</h4></a></li>
                        <li><a href="#"><h4 class="glyphicon glyphicon-heart-empty">礼品</h4></a></li>
                        <li><a href="#"><h4 class="vip">VIP会员中心</h4></a></li>
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

<!--显示商品区域-->
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
                           <img src="/shop4.2/Public/Admin/img/hcat.jpg" class="car_button_img">
                       </div>
                   </td>
               </tr>
               </tbody>
           </table>
       </div>
   </div>
    <div class="see-again">
        <img src="/shop4.2/Public/Admin/img/shopinfo.png">
    </div>
</div>

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


<div class="end">
    <hr/>
    <div class="end_text">小毛果园-只为新鲜</div>
    <hr/>
</div>
</body>
<script type="text/javascript" src="/shop4.2/Public/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/shop4.2/Public/Admin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop4.2/Public/Admin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script>
    $('.goods-Review-area').hide();
    $("#goods_comment li").click(function() {

        $(this).siblings('li').removeClass('active');  // 删除其他兄弟元素的样式

        $(this).addClass('active');                            // 添加当前元素的样式
        if($(this).val()==1){
            $('.goods-info-area').hide();
            $('.goods-Review-area').show();
        }else if($(this).val()==0){
            $('.goods-info-area').show();
            $('.goods-Review-area').hide();
        }
    });

    $('#quantity').numberspinner({
        value:1,
        height:32,
        width:125,
        min: 1,
        max: 100,
        editable: false
    });
</script>
</html>