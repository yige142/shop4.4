<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>商城首页</title>
        <link href="/shop3.2/Public/Home/css/index.css" rel="stylesheet" type="text/css">
        <link href="/shop3.2/Public/Home/css/goods/fresh_list.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/shop3.2/Public/easyui/themes/bootstrap/easyui.css">
        <link rel="stylesheet" href="/shop3.2/Public/easyui/themes/icon.css">
        <!--加载Bootstrap的CSS   /shop3.2/Public在Home->Config中配置-->
        <link href="/shop3.2/Public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="/shop3.2/Public/Home/js/jquery-3.2.1.min.js"></script>
        <script src="/shop3.2/Public/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">
            var ThinkPhP={
                'MODULE':'/shop3.2/Home',
                'IMG':'/shop3.2/Public/Home/img',
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
                        <a class="navbar-brand" href="#"><img src="/shop3.2/Public/Home/img/logo3.png"></a>
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
<!--var_dump($list);-->
<!--print_r($Goods);-->
<!--?>-->
<!--显示商品生鲜部分 -->
<div class="good_fresh">
    <hr/>
    <div class="good_fresh_label">
        <div class="good_fresh_png"><img src="/shop3.2/Public/Home/img/fresh.png"></div>
    </div>
    <!--显示生鲜图片区域-->
    <div class="good_fruit_list">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["goods_classify"] == '生鲜' and $vo["goods_status"] == '上架'): ?><div class="good_fruit_Active_Area">
                    <div class="good_fruit_img_scale">
                        <a href="<?php echo U('Goods/getGoodsDetails');?>?id=<?php echo ($vo["goodsId"]); ?>" target="_blank"><img class="good_fruit_img" src="/shop3.2/Uploads/<?php echo ($vo["img_path"]); ?>"></a>
                    </div>
                    <div class="good_fruit_text">
                        <div class="good_fruit_name"><?php echo ($vo["goods_name"]); ?></div>
                        <div class="good_fruit_price">￥<?php echo ($vo["shop_price"]); ?>/<?php echo ($vo["goods_unit"]); ?></div>
                    </div>
                    <div class="good_fruit_png">
                        <a href="<?php echo U('Goods/getGoodsDetails');?>?id=<?php echo ($vo["goodsId"]); ?>" target="_blank"><img  src="/shop3.2/Public/Home/img/shopping_cart.png"></a>
                    </div>
                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <div class="paging">
        <ul class="pagination">
            <li value="-1"><a href="javascript:void(0)">&laquo;</a></li>
            <li value="1"><a href="javascript:void(0)">1</a></li>
            <li value="2"><a href="javascript:void(0)">2</a></li>
            <li value="3"><a href="javascript:void(0)">3</a></li>
            <li value="4"><a href="javascript:void(0)">4</a></li>
            <li value="5"><a href="javascript:void(0)">5</a></li>
            <li value="6"><a href="javascript:void(0)">&raquo;</a></li>
        </ul>
    </div>
</div>

<!--尾部-->
<div class="end">
    <hr/>
    <div class="end_text">小毛果园-只为新鲜</div>
    <hr/>
</div>
</body>
<script type="text/javascript" src="/shop3.2/Public/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop3.2/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/shop3.2/Public/Home/js/index.js"></script>
<script type="text/javascript" src="/shop3.2/Public/Home/js/public.js"></script>
<script>
    $(".pagination li").click(function() {
        $(this).siblings('li').removeClass('active');  // 删除其他兄弟元素的样式
        $(this).addClass('active');                            // 添加当前元素的样式

        location.href=ThinkPhP['MODULE']+'/Goods/page_fresh_list?page='+$(this).val();
    });
</script>
</html>