<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--------------------------------------------商品订单核对页--------------------------------------------------->
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>订单核对确认</title>
        <link href="/shop4.2/Public/Home/css/index.css" rel="stylesheet" type="text/css">
        <link href="/shop4.2/Public/Home/css/user.css" rel="stylesheet" type="text/css">
        <link href="/shop4.2/Public/Home/css/Order/check_order_info.css" rel="stylesheet" type="text/css">
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

        <style type="text/css">
            /*opacity是设置遮罩透明度的，可以自己调节*/
            #loading{position:fixed;top:0;left:0;width:100%;height:100%;background:#f9f9f9;opacity:1;z-index:15000;}
            #loading img{position:absolute;top:50%;left:50%;width:30px;height:30px;margin-top:-15px;margin-left:-15px;}
            #loading p{position:absolute;top:55%;left:48%;width:30px;height:30px;margin-top:-15px;margin-left:-15px;}
        </style>
    </head>

<body>
<!--遮罩loading -->
<div id="loading" class="list-item">
    <img alt="" src="/shop4.2/Public/Home/img/loading.gif"><br>
    <p style="line-height: 24px;">loading...</p>
</div>

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
        <div class="top_content tr">
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
<!--显示商品订单核对区域-->

    <input type="hidden" value="<?php echo session('admin')['accounts'];?>的<?php echo ($Goods["goods_name"]); ?>订单" id="order_name">
    <input type="hidden" value="<?php echo ($Goods["goodsId"]); ?>" id="order_goods_id">
<div class="check_order_info_area">
    <div class="title_area ">
          <h3>填写并核对订单信息</h3>
    </div>
    <div class="info_area ">
        <div class="info_area_title ">
          <h4>收货人信息:</h4>
        </div>
        <div class="tool-opt">
            <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-ok" onclick="check_orderOpt.choice()">选择地址</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-add" onclick="check_orderOpt.add()">新增收货地址</a>
        </div>
         <table id="address_info_area"></table>
    </div>
    <div class="payment_type_area ">
         <div class="payment_type_title">
             <h4>支付方式:</h4>
         </div>
         <div class="payment_type_text">
             <input type="text" id="payment_type"  >
         </div>
    </div>
     <div class="goods_area">
          <div class="order_info_title tr">
              <h4>确认订单信息:</h4>
          </div>
          <div>
              <table class="goods_table">
                  <tr class="tr">
                      <td class="td">商品名称</td>
                      <td class="td">商品属性</td>
                      <td class="td">单价</td>
                      <td class="td">数量</td>
                      <td class="td">小计</td>
                  </tr>
                  <tr class="tr">
                      <td width="40%">
                          <div class="goods_img">
                              <img src="/shop4.2/<?php echo ($Goods["thumb_path"]); ?>">
                          </div>
                          <div class="goods_text">
                            <?php echo ($Goods["goods_name"]); ?> <?php echo ($Goods["goods_info"]); ?>
                              <input type="hidden" id="goods_name" value="<?php echo ($Goods["goods_name"]); ?>">
                          </div>
                      </td>

                      <td class="td" width="15%"><?php echo ($Goods["goods_classify"]); ?></td>
                      <td class="td" width="15%"><?php echo ($Goods["shop_price"]); ?><input type="hidden" id="unit_price" value="<?php echo ($Goods["shop_price"]); ?>"></td>
                      <td class="td" width="15%"><input type="text" id="goods_quantity" value="<?php echo ($Goods["number"]); ?>"></td>
                      <td class="td" width="15%"><div class="subtotal"><?php echo ($Goods['shop_price']*$Goods['number']); ?></div></td>
                  </tr>
                  <tr class="tr">
                      <td width="40%" colspan="2">
                         给卖家留言: <input type="text" id="remark"/>
                      </td>
                      <td width="40%" colspan="2">
                          <div class="freight">
                              运费:￥<?php echo ($Goods["carriage"]); ?>元
                          </div>
                      </td>
                      <td>
                          <div class="freight_price">
                              <?php echo ($Goods["carriage"]); ?>
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="4">
                            <div class="shop_total">
                                   合计:
                            </div>
                      </td>
                      <td>
                               <div class="shop_total_num">￥<?php echo ($Goods['shop_price']*$Goods['number']+$Goods['carriage']); ?></div>
                          <input type="hidden" id="total_price" value="<?php echo ($Goods['shop_price']*$Goods['number']+$Goods['carriage']); ?>">
                      </td>
                  </tr>
                  </hr>
                  <tr>
                      <td colspan="3">

                      </td>
                      <td colspan="2">
                          <div class="area_show_info">
                                <div class="payment_area">
                                    <div class="payment_text">
                                        <span class="payment_text_text">实付款</span>:<span class="payment_number">￥<?php echo ($Goods['shop_price']*$Goods['number']+$Goods['carriage']); ?></span>
                                    </div>
                                </div>
                                <div class="send_area">
                                    <div class="send_area_text">
                                        <span class="send_area_text_text">寄送至:</span><span class="area"></span>
                                    </div>
                                </div>
                              <div class="send_area">
                                  <div class="send_area_text">
                                      <span class="addressee_text">收件人:</span><span class="tel"></span>
                                     <input type="hidden" value="0" id="address_id">
                                  </div>
                              </div>
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="4">

                      </td>
                      <td>
                          <div class="submit_button_area">
                              <button type="submit" id="order_submit">确认提交</button>
                          </div>
                      </td>
                  </tr>
              </table>
          </div>
     </div>
     </div>
</div>

<div id="showAlipay"></div>


<!--地址新增面板-->
<form id="order_address_add">
    <table class="form-table" style="max-width: 520px;">
        <tbody>
        <tr>
            <td class="label">
                <label for="address_accounts" class="form-label">姓名：</label>
            </td>
            <td class="input">
                <input type="text" id="address_accounts">
            </td>
        </tr>
        <tr>
            <td class="label">
                <label for="address_phone" class="form-label">电话：</label>
            </td>
            <td class="input">
                <input type="text" id="address_phone">
            </td>
        </tr>
        <tr>
            <td class="label">
                <label for="address_address" class="form-label">地址：</label>
            </td>
            <td class="input" >
                <textarea type="text" id="address_address" class="textarea"></textarea>
            </td>
        </tr>
        <tr style="display:none">
            <td class="label">
                <label for="address-add-tab" class="form-label">是否默认地址：</label>
            </td>
            <td class="input">
                <input type="hidden" id="address-add-tab">
            </td>
        </tr>
        </tbody>
    </table>
</form>
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





//    $('.subtotal').html($('#total_price').val($('#unit_price').val()*$('#goods_quantity').val()));
</script>
</body>
<script type="text/javascript" src="/shop4.2/Public/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop4.2/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/shop4.2/Public/Home/js/Order/check_order_info.js"></script>
<script type="text/javascript" src="/shop4.2/Public/Home/js/public.js"></script>
</html>