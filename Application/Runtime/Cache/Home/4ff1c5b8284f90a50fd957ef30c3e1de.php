<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>商城首页</title>
	<link   rel="stylesheet" type="text/css" media="screen and (min-width:768px)" href="/shop4.3/Public/Home/css/index.css" >
	<link  media="screen and (max-width:767px)"  href="/shop4.3/Public/Home/css/phone.css" rel="stylesheet" type="text/css">
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
			'INDEX':'<?php echo U("Index/index");?>'
		};
	</script>
</head>

<body>
<div id="phone_contain">

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
					<a class="navbar-brand" href="#"><img class="phone_img" src="/shop4.3/Public/Home/img/logo3.png"></a>
				</div>
				<div class="daohang">
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


<!--头部下方 显示滚动图片-->
<div id="myCarousel" class="carousel slide">
	<!-- 轮播（Carousel）指标 -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
		<li data-target="#myCarousel" data-slide-to="3"></li>
	</ol>
	<!-- 轮播（Carousel）项目 -->
	<div class="carousel-inner">
		<div class="item active">
			<img src="/shop4.3/Public/Home/img/01.jpg" alt="First slide">
		</div>
		<div class="item">
			<img src="/shop4.3/Public/Home/img/02.jpg" alt="Second slide">
		</div>
		<div class="item">
			<img src="/shop4.3/Public/Home/img/03.jpg" alt="Third slide">
		</div>
		<div class="item">
			<img src="/shop4.3/Public/Home/img/04.jpg" alt="f slide">
		</div>
	</div>
	<!-- 轮播（Carousel）导航 -->
	<a class="carousel-control left" href="#myCarousel"
	   data-slide="prev">
	</a>
	<a class="carousel-control right" href="#myCarousel"
	   data-slide="next">
	</a>
</div>




<!--显示商品鲜果部分 -->
<!--<?php-->
	<!--var_dump($list);-->
	<!--//print_r($Goods);-->
	<!--?>-->
<div class="good_fruit">
<hr/>
	<div class="good_fruit_label">
        <div class="good_fruit_png"><img src="/shop4.3/Public/Home/img/fruit.png"></div>
		<div class="good_fruit_more"><a href="<?php echo U('Goods/goods_fruit_list');?>">更多>></a></div>
	</div>
	<!--显示水果图片区域-->
	<!--<?php if(is_array($Goods)): $i = 0; $__LIST__ = $Goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Goods): $mod = ($i % 2 );++$i;?>-->
	<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
	<div class="good_fruit_list">

		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["goods_classify"] == '水果' and $vo["goods_status"] == '上架'): ?><div class="good_fruit_Active_Area">
					<div class="good_fruit_img_scale">
						<a href="<?php echo U('Goods/getGoodsDetails');?>?id=<?php echo ($vo["goodsId"]); ?>" target="_blank"><img  class="good_fruit_img" src="/shop4.3/Uploads/<?php echo ($vo["img_path"]); ?>"></a>

					</div>
					<div class="good_fruit_text">
						<div class="good_fruit_name"><?php echo ($vo["goods_name"]); ?></div>
						<div class="good_fruit_price">￥<?php echo ($vo["shop_price"]); ?>/<?php echo ($vo["goods_unit"]); ?></div>
						<input type="hidden" class="gid" value="<?php echo ($vo["goodsId"]); ?>">
					</div>

					<div class="good_fruit_cart_png">
						<a href="<?php echo U('Goods/getGoodsDetails');?>?id=<?php echo ($vo["goodsId"]); ?>" target="_blank"><img  src="/shop4.3/Public/Home/img/shopping_cart.png"></a>
					</div>
				</div>

				<?php else: endif; endforeach; endif; else: echo "" ;endif; ?>

	</div>
</div>


<!--<?php-->
<!--var_dump($list);-->
<!--print_r($Goods);-->
<!--?>-->
<!--显示商品生鲜部分 -->
<div class="good_fresh">
	<hr/>
	<div class="good_fresh_label">
		<div class="good_fresh_png"><img src="/shop4.3/Public/Home/img/fresh.png"></div>
		<div class="good_fresh_more"><a href="<?php echo U('Goods/goods_fresh_list');?>">更多>></a></div>
	</div>
	<!--显示生鲜图片区域-->
	<div class="good_fruit_list">
		<?php if(is_array($fresh)): $i = 0; $__LIST__ = $fresh;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fo): $mod = ($i % 2 );++$i; if($fo["goods_classify"] == '生鲜' and $fo["goods_status"] == '上架'): ?><div class="good_fruit_Active_Area">
			<div class="good_fruit_img_scale">
				<a href="<?php echo U('Goods/getGoodsDetails');?>?id=<?php echo ($fo["goodsId"]); ?>" target="_blank"><img class="good_fruit_img" src="/shop4.3/Uploads/<?php echo ($fo["img_path"]); ?>"></a>
			</div>
			<div class="good_fruit_text">
				<div class="good_fruit_name"><?php echo ($fo["goods_name"]); ?></div>
				<div class="good_fruit_price">￥<?php echo ($fo["shop_price"]); ?>/<?php echo ($vo["goods_unit"]); ?></div>
			</div>
			<div class="good_fresh_cart_png">
				<a href="<?php echo U('Goods/getGoodsDetails');?>?id=<?php echo ($fo["goodsId"]); ?>" target="_blank"><img  src="/shop4.3/Public/Home/img/shopping_cart.png"></a>
			</div>
		</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>


	<!--手机底部显示-->
	<div id="phone_order">
		<ul class="nav navbar-nav ">
			<li ><a href="<?php echo U('Index/index');?>" ><h4 class="glyphicon glyphicon-home">首页</h4></a></li>
			<li><a href="<?php echo U('Goods/goods_fruit_list');?>"><h4 class="glyphicon glyphicon-tree-deciduous">鲜果</h4></a></li>
			<li ><a href="<?php echo U('Goods/goods_fresh_list');?>"><h4 class="glyphicon glyphicon-cutlery">生鲜</h4></a></li>
			<?php if(session('admin')): ?><li ><a href="<?php echo U('Order/order');?>"><h4 class="glyphicon glyphicon-cutlery">我的订单</h4></a></li>
				<?php else: ?>
				<li ><a href="<?php echo U('Index/login');?>"><h4 class="glyphicon glyphicon-shopping-cart">我的订单</h4></a></li><?php endif; ?>
		</ul>

	</div>
<!--尾部-->
<div class="end">
	<hr/>
<div class="end_text">小毛果园-只为新鲜</div>
    <hr/>
</div>
<div class="chen">

</div>


</div>
</body>
<script type="text/javascript" src="/shop4.3/Public/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop4.3/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Home/js/index.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Home/js/public.js"></script>
</html>