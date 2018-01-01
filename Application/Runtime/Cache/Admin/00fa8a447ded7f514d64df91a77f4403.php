<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>Demo</title>
    <link rel="stylesheet" href="/shop4.3/Public/Admin/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="/shop4.3/Public/Admin/easyui/themes/icon.css">
    <link rel="stylesheet" href="/shop4.3/Public/Admin/css/login.css">
    <script type="text/javascript">
        var ThinkPHP={
          'MODULE':'/shop4.3/Admin',
            'IMG':'/shop4.3/Public/Admin/img',
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
    <img alt="" src="/shop4.3/Public/Admin/img/loading.gif"><br>
    <p style="line-height: 24px;">loading...</p>
</div>

<!--登录面板-->
<form id="login" class="easyui-dialog">
    <table class="form-table" style="max-width: 420px;">
        <tbody>
          <tr>
             <td class="label" style="width: 83px;">
                 <label for="login-accounts" class="form-label">账号：</label>
             </td>
              <td class="input">
                  <input type="text" id="login-accounts" class="easyui-textbox">
              </td>
          </tr>
          <tr>
              <td class="label" style="width:83px;">
                  <label for="login-password" class="form-label">密码：</label>
              </td>
              <td class="input">
                  <input type="password" id="login-password" class="easyui-textbox">
              </td>
          </tr>
          <tr>
              <td colspan="2" class="register">
                  没有业务账号？ <a href="javascript:void(0)" class="btn-register" onclick="loginOpt.register()">[快速申请]</a>
              </td>
          </tr>
        </tbody>
    </table>
</form>

<!--注册面板-->
<form id="register" class="easyui-dialog">
    <table class="form-table" style="max-width: 420px;">
        <tbody>
        <tr>
            <td class="label" style="width: 83px;">
                <label for="login-register-accounts" class="form-label">账号：</label>
            </td>
            <td class="input">
                <input type="text" id="login-register-accounts" class="easyui-textbox">
            </td>
        </tr>
        <tr>
            <td class="label" style="width:83px;">
                <label for="login-register-password" class="form-label">密码：</label>
            </td>
            <td class="input">
                <input type="password" id="login-register-password" class="easyui-textbox">
            </td>
        </tr>
        <tr>
            <td class="label" style="width:83px;">
                <label for="login-register-password" class="form-label">确认密码：</label>
            </td>
            <td class="input">
                <input type="password" id="login-register-password2" class="easyui-textbox">
            </td>
        </tr>
        <tr>
            <td class="label" style="width:83px;">
                <label for="login-register-tel" class="form-label">联系电话：</label>
            </td>
            <td class="input">
                <input type="text" id="login-register-tel" class="easyui-textbox">
            </td>
        </tr>
        </tbody>
    </table>
</form>


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
<script type="text/javascript" src="/shop4.3/Public/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Admin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Admin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="/shop4.3/Public/Admin/js/login.js"></script>
</body>
</html>