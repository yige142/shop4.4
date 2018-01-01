/**
 * Created by Administrator on 2016/12/4.
 */
var btnLogout = $('#btn-logout'),
    btnEdit    =$('#btn-edit'),
    edit        =$('#edit'),
    editId      =$('#edit-id'),
    details     =$('#details'),
    customerDetails=$('#customer_details'),
    editAccounts =$('#edit-accounts'),
    editPassword =$('#edit-password'),
    editNotPassword=$('#edit-notPassword');
    editor_tool         =        [
        'source', '|',
        'formatblock', 'fontname', 'fontsize','|',
        'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'link',
        'removeformat', '|',
        'justifyleft', 'justifycenter', 'justifyright', '|',
        'insertorderedlist', 'insertunorderedlist','|',
        'emoticons', 'image','baidumap','|',
        'fullscreen'
    ];

//内容切换选项卡
$('#tabs').tabs({
   fit:true,
    border:false,
    onLoad : function ()
    {
        //非火狐浏览器屏蔽tab-loading
        if (navigator.userAgent.indexOf('Firefox') < 0)
        {
            $('.tabs-loading').remove();
        }
    },

//右键关闭按钮功能
    onContextMenu:function(e,title,index){
        e.preventDefault();    //禁用右键默认菜单功能
        var menu = $('#menu'),
            _this = this;
        //右击弹出菜单
        $('#menu').menu('show',{  //自定义彩带开启在鼠标悬停位
            top: e.pageY,
            left: e.pageX,
        });

        //将起始页禁用关闭
        if (index == 0)
        {
            $('#menu').menu('disableItem', $('.closecur')[0]);
        } else {
            $('#menu').menu('enableItem', $('.closecur')[0]);
        }
        //三个关闭方法
        $('#menu').menu({
            onClick:function(item){
                 var tablist=$(_this).tabs('tabs');
                switch(item.text){
                    case '关闭':
                        $(_this).tabs('close',index);
                        break;
                    case '关闭所有':
                        for(var i=tablist.length;i>0;i--){
                        $(_this).tabs('close',i);
                    }
                        break;
                    case '关闭其他所有':
                        for(var i=tablist.length;i>0;i--){
                            if(i!=index){
                                $(_this).tabs('close',i);
                            }
                        }
                        $(_this).tabs('select',1);
                        break;
                }
            }
        });
    }
});


btnEdit.click(function(){
    edit.dialog('open');
});

//修改密码面板
$(function(){
   edit.dialog({
       title:'修改密码',
       width:400,
       height:280,
       iconCls:'icon-edit',
       closed:true,
       model:true,
       maximizable:true,
       buttons:[
           {
               text:'保存',
               size:'large',
               iconCls:'icon-accept',
               handler:function(){
                   if(edit.form('validate')){
                       $.ajax({
                           url:ThinkPhP['MODULE'] + '/User/editPassword',
                           type:'POST',
                           data:{
                               id:editId.val(),
                               password:editPassword.val(),
                               notPassword:editNotPassword.val()
                           },
                           beforeSend: function () {
                               $.messager.progress({
                                   text:'正在尝试保存....'
                               });
                           },
                           success:function(data){
                               $.messager.progress('close');
                               if(data >0){
                                   $.messager.show({
                                       title : '操作提示',
                                       msg : '修改密码成功'
                                   });
                                   edit.form('reset');
                                   edit.dialog('close');
                                   $.messager.alert('操作提醒', '密码修改成功，请重新登录！', 'info', function(){
                                       location.href = ThinkPhP['MODULE'] + '/Login/logout';
                                   });
                               }else{
                                   $.messager.alert('操作提醒','与原密码相同，修改失败','warning',function(){
                                      editNotPassword.textbox('textbox').select();
                                   });
                               }
                           }
                       });
                   }
               }
           },
           {
               text:'取消',
               size:'large',
               iconCls:'icon-cross',
               handler:function(){
                   edit.dialog('close')
               }
           }
       ],
       onClose:function (){
               edit.form('reset');
               edit.form('center');
       }
   });
    //详情弹窗
    details.dialog({
        width: 780,
        height: 500,
        iconCls : 'icon-tip',
        closed: true,
        modal : true,
        maximizable : true,
        buttons:[
            {
                text : '关闭',
                size : 'large',
                iconCls : 'icon-cross',
                handler : function ()
                {
                    details.dialog('close');
                }
            }]
    });

});
//修改账号
editAccounts.textbox({
    width:220,
    height:28,
    disabled:true
});
//修改密码
editPassword.textbox({
    width:220,
    height:28,
    required:true,
    validType:'length[6,30]',
    missingMessage:'请修改账号密码',
    invalidMessage:'账号密码6-30位'
});
editNotPassword.textbox({
    width:220,
    height:28,
    required:true,
    validType:'equals["#edit-password"]',
    missingMessage:'请确认账号密码',
    invalidMessage:'确认密码和密码不一致'
});

//判断针对火狐浏览器，并判断easyui 渲染完毕后再隐藏遮罩
if (navigator.userAgent.indexOf('Firefox') > 0)
{
    $.parser.onComplete = function ()
    {
        $('.tabs-loading').hide();
    }
}

//退出系统按钮
btnLogout.click(function () {
    $.messager.confirm('操作提醒','是否退出系统',function(flag){
        if(flag){
            $.messager.progress({
                text:'退出系统中.....'
            });
            location.href=ThinkPhP['MODULE'] + '/Login/logout'
        }
    })
});

//tabs 添加
function tabsOpt(title,url){
   var tabs=$('#tabs');
    if(tabs.tabs('exists',title)){
        tabs.tabs('select',title);
    }else{
        //如果tabs等于报价单 和销售订单，关闭的时候销毁相应的dialog.为的是避免tabs关闭后再打开表单，多行表加载不出
        switch (title){
            case'产品信息':
                $('#product-add').dialog('destroy');
                $('#customer-edit').dialog('destroy');
                break
        }

                tabs.tabs('add', {
            title: title,
            closable: true,
            href: ThinkPhP['MODULE'] + url
        });
    }
}

