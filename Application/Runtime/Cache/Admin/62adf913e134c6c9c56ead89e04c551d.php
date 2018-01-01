<?php if (!defined('THINK_PATH')) exit();?><!--Firefox火狐浏览器渲染遮罩专用-->
<div class="tabs-loading">Loading...</div>
<link rel="stylesheet" type="text/css" href="/shop4.4/Public/Admin/css/goods/goods.css" />



<table id="order"></table>

<!--工具条-->
<form id="order-tool" style="padding: 5px;">
    <div class="tool-search">
        <label for="order-search-keywords">关键字：</label>
        <input type="text" id="order-search-keywords">
        <input type="text" id="order-search-type">
        <input type="text" id="order-search-cancel">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="orderOpt.search()">查询</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-undo" onclick="orderOpt.reset()">重置查询</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" plain="false" iconCls="icon-reload" onclick="orderOpt.reload()">刷新表</a>
    </div>
</form>

<script type="text/javascript" src="/shop4.4/Public/Admin/js/goods/datagrid-detailview.js"></script>
<script type="text/javascript" src="/shop4.4/Public/Admin/js/order/order.js"></script>