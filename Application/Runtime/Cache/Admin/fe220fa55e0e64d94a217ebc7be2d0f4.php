<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html lang="zh-cn">
<head>


    <link rel="stylesheet" href="/shop4.4/Public/Admin/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="/shop4.4/Public/Admin/easyui/themes/icon.css">
    <link rel="stylesheet" href="/shop4.4/Public/Admin/css/index.css">
    <link rel="shortcut icon" href="/shop4.4/Public/Admin/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/shop4.4/Public/uploadify/uploadify.css" />

    <script type="text/javascript">
        var ThinkPhP={
            'MODULE':'/shop4.4/Admin',
            'UPLOADIFY':'/shop4.4/Public/uploadify',
            'UPLOADER':'<?php echo U("File/upload");?>',
            'ROOT':'/shop4.4',
            'IMG':'/shop4.4/Public/Admin/img'
        };
    </script>

    <style type="text/css">
        /*opacity是设置遮罩透明度的，可以自己调节*/
        #loading{position:fixed;top:0;left:0;width:100%;height:100%;background:#f9f9f9;opacity:1;z-index:15000;}
        #loading img{position:absolute;top:50%;left:50%;width:30px;height:30px;margin-top:-15px;margin-left:-15px;}
        #loading p{position:absolute;top:55%;left:48%;width:30px;height:30px;margin-top:-15px;margin-left:-15px;}
    </style>
</head>
<body class="easyui-layout">
<!--遮罩loading -->
<div id="loading" class="list-item">
    <img alt="" src="/shop4.4/Public/Admin/img/loading.gif"><br>
    <p style="line-height: 24px;">loading...</p>
</div>


<!-- 软件头部-->
<div data-options="region:'north'" class="layout-north">
    <div class="logo">
        <img src="/shop4.4/Public/Admin/img/logo.png" art="小毛果园"/>
    </div>
    <div class="info">
        您好，<?php echo session('admin')['accounts'];?>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="btn-edit" iconCls="icon-edit">修改密码</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" id="btn-logout" iconCls="icon-remove">退出系统</a>

    </div>
    <!-- 修改密码-->
    <form id="edit" class="easyui-dialog">
        <input type="hidden" id="edit-id" value="<?php echo session('admin')['id'];?>">
        <table class="form-table" style="max-width: 420px;">
            <tr>
                <td class="label">
                    <label for="edit-accounts" class="form-label">账号：</label>
                </td>
                <td class="input">
                    <input type="text" id="edit-accounts" class="easyui-textbox" value="<?php echo session('admin')['accounts'];?>">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="edit-password" class="form-label">密码：</label>
                </td>
                <td class="input">
                    <input type="password" id="edit-password" class="easyui-textbox">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="edit-notPassword" class="form-label">确认密码：</label>
                </td>
                <td class="input">
                    <input type="password" id="edit-notPassword" class="easyui-textbox">
                </td>
            </tr>
        </table>
    </form>
</div>

<!-- 软件左侧导航 手风琴效果-->
<div data-options="region:'west',split:true,title:'导航',iconCls:'icon-world' " class="layout-west">
    <div id="aa" class="easyui-accordion" style="width:175px;height:auto;">
        <div title="商品管理" data-options="iconCls:'icon-sales'" style="overflow:auto;padding:0 0 0 40px;">
            <a href="#"  class="easyui-linkbutton" iconCls="icon-shopping" plain="true" onclick="tabsOpt('出售中的商品','/Goods/index')">出售中的商品</a><br>
        </div>
        <div title="订单管理" data-options="iconCls:'icon-customer'" style="overflow:auto;padding:0 0 0 40px;">
            <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-archives" plain="true" onclick="tabsOpt('文件管理','/Customer/index')">文件管理</a><br>-->
            <a href="#"  class="easyui-linkbutton" iconCls="icon-order" plain="true" onclick="tabsOpt('订单信息','/Order/index')">订单信息</a><br>
            <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-quotation" plain="true" onclick="tabsOpt('报价单','/Quotation/index')">报价单</a><br>-->
            <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-order" plain="true" onclick="tabsOpt('销售订单','/Order/index')">销售订单</a><br>-->
            <!--<a href=""  class="easyui-linkbutton" iconCls="icon-male" plain="false" onclick="tabsOpt('new tab','')">客户关怀</a><br>-->
        </div>
        <div title="财务管理" data-options="iconCls:'icon-customer'" style="overflow:auto;padding:0 0 0 40px;">
            <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-archives" plain="true" onclick="tabsOpt('文件管理','/Customer/index')">文件管理</a><br>-->
            <a href="#"  class="easyui-linkbutton" iconCls="icon-order" plain="true" onclick="tabsOpt('财务统计','/Finance/index')">财务统计</a><br>
            <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-quotation" plain="true" onclick="tabsOpt('报价单','/Quotation/index')">报价单</a><br>-->
            <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-order" plain="true" onclick="tabsOpt('销售订单','/Order/index')">销售订单</a><br>-->
            <!--<a href=""  class="easyui-linkbutton" iconCls="icon-male" plain="false" onclick="tabsOpt('new tab','')">客户关怀</a><br>-->
        </div>
        <!--<div title="文件管理" data-options="iconCls:'icon-customer'" style="overflow:auto;padding:0 0 0 40px;">-->
            <!--&lt;!&ndash;<a href="#"  class="easyui-linkbutton" iconCls="icon-archives" plain="true" onclick="tabsOpt('文件管理','/Customer/index')">文件管理</a><br>&ndash;&gt;-->
            <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-info" plain="true" onclick="tabsOpt('产品信息','/Product/index')">产品信息</a><br>-->
            <!--&lt;!&ndash;<a href="#"  class="easyui-linkbutton" iconCls="icon-quotation" plain="true" onclick="tabsOpt('报价单','/Quotation/index')">报价单</a><br>&ndash;&gt;-->
            <!--&lt;!&ndash;<a href="#"  class="easyui-linkbutton" iconCls="icon-order" plain="true" onclick="tabsOpt('销售订单','/Order/index')">销售订单</a><br>&ndash;&gt;-->
            <!--&lt;!&ndash;<a href=""  class="easyui-linkbutton" iconCls="icon-male" plain="false" onclick="tabsOpt('new tab','')">客户关怀</a><br>&ndash;&gt;-->
        <!--</div>-->

        <div title="人员管理" data-options="iconCls:'icon-customer_info'" style="overflow:auto;padding:0 0 0 40px;">
            <a href="#"  class="easyui-linkbutton" iconCls="icon-login_name" plain="true" onclick="tabsOpt('员工账号','/User/index')">员工账号</a><br>
            <a href="#"  class="easyui-linkbutton" iconCls="icon-archives" plain="true" onclick="tabsOpt('员工部门','/Staff/index')">员工部门</a><br>
            <a href="#"  class="easyui-linkbutton" iconCls="icon-department" plain="true" onclick="tabsOpt('员工管理','/Post/index')">员工管理</a><br>
        </div>
         <!--&lt;!&ndash;权限过滤，有权限则显示，没权限就隐藏&ndash;&gt;-->
        <!--<?php if(checkbutton('Admin/System/') == 1 ): ?>-->
            <!--<div title="系统管理" data-options="iconCls:'icon-system'" style="overflow:auto;padding:0 0 0 40px;">-->
                <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-login_name" plain="true" onclick="tabsOpt('权限控制','/AuthGroup/index')">权限控制</a><br>-->
                <!--<a href="#"  class="easyui-linkbutton" iconCls="icon-archives" plain="true" onclick="tabsOpt('管理员管理','/Staff/index')">管理员管理</a><br>-->
            <!--</div>-->
            <!--<?php else: ?>-->
        <!--<?php endif; ?>-->

        </div>
    </div>
</div>

<!-- 主题部分-->
<div data-options="region:'center'" class="layout-center">
    <div id="tabs">
        <div title="起始页" iconCls="icon-house">
            <p> 欢迎登陆</p>
        </div>
    </div>
</div>

<!-- 尾部-->
<div data-options="region:'south'" class="layout-center">
    foot
</div>

<!--details容器-->
<div id="details"></div>

<!--右击菜单-->
<div id="menu" class="easyui-menu">
    <div class="closecur">关闭</div>
    <div class="closeall">关闭所有</div>
    <div class="closeother">关闭其他所有</div>
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
<script type="text/javascript" src="/shop4.4/Public/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/shop4.4/Public/Admin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop4.4/Public/Admin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/shop4.4/Public/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/shop4.4/Public/Admin/js/index.js"></script>
<script type="text/javascript" src="/shop4.4/Public/Admin/js/echarts.js"></script>
</html>