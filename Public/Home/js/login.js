/**
 * Created by Administrator on 2016/12/12.
 */
//var rand   =Math.floor(Math.random()*5)+1,
   var body    =$('body'),
    login   =$('#login'),
    loginAccounts=$('#login-accounts'),
    loginPassword=$('#login-password'),
    registerAccounts=$('#register-accounts'),
    registerPassword=$('#register-password'),
    registerPassword2=$('#register-rpassword'),
    registerLinkOpt,
    register=$('#register');


//随机背景
body.css('background','url(' + ThinkPHP['IMG'] +'/bg' + 3 + '.jpg) no-repeat center fixed')
    .css('background-size','cover');

$(window).resize(function(){
    login.dialog('center');
});

//登录面板

    login.dialog({
        title:'用户登录',
        width:370,
        height:260,
        iconCls:'icon-lock',
        closed:false,
        maximizable:false,
        closable:false,
        draggable:false,
        buttons:[
            {
                text:'登录',
                id:'login-btn',
                size:'large',
                iconCls:'icon-go',
                handler: function () {
                    if(true){
                        $.ajax({
                            url:ThinkPHP['MODULE'] + '/Login/checkUser',
                            type:'POST',
                            data:{
                                accounts: $.trim(loginAccounts.val()),
                                password:loginPassword.val()
                            },
                            beforeSend:function(){
                                $.messager.progress({
                                    text:'正在尝试登录.....'
                                });
                            },
                            success:function(data){
                                $.messager.progress('close');
                                if(data>0){
                                    location.href=ThinkPHP['INDEX'];

                                }else if(data == -1){
                                    $.messager.alert('登录失败','账号冻结失败','warning',function(){
                                        loginPassword.textbox('textbox').select();
                                    });
                                }else if(data == 0){
                                    $.messager.alert('登录失败','账号或密码不正确','warning',function(){
                                        loginPassword.textbox('textbox').select();
                                    });
                                }
                            }
                        });
                    }
                }
            }
        ],
        onOpen:function(){
            $(function(){
                $('#login-btn').parent().css('text-align','center');
            });
        }
    });




//注册
registerLinkOpt={
    add:function(){
        register.dialog('open');
    }
}
//注册面板
register.dialog({
    title:'用户注册',
    width:370,
    height:280,
    iconCls:'icon-add',
    model:true,
    closed:true,
    maximizable:false,
    closable:false,
    draggable:false,
    buttons:[
        {
            text:'注册',
            size:'large',
            iconCls:'icon-accept',
            handler:function(){
                if(register.form('validate')){
                    $.ajax({
                        url:ThinkPHP['MODULE'] + '/User/register',
                        type:'Post',
                        data:{
                            accounts: $.trim(registerAccounts.val()),
                            password:registerPassword.val()
                        },
                        beforeSend:function(){
                            $.messager.progress({
                                text:'正在处理中....'
                            });
                        },
                        success:function(data)
                        {
                            $.messager.progress('close');
                            if (data > 0){
                                $.messager.show({
                                    title:'操作提示',
                                    msg:'操作成功'
                                });
                                register.dialog('close');
                            }else if(data ==-1){
                                $.messager.alert('添加失败','账号被占用','warning',function(){
                                    registerAccounts.textbox('textbox').select();
                                })
                            }
                        }
                    });
                }
            }
        },{
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                register.dialog('close');
            }
        }
    ],
    onClose:function(){
        register.form('reset');
    }
});
/*-----------表单字段区域------------------*/
//登录账号字段
loginAccounts.textbox({
    width:220,
    height:32,
    iconCls:'icon-man',
    validType:'length[2,20]',
    required:true,
    missingMessage:'请输入登录账号',
    invalidMessage:'登录账号[2,20]位'
});
//登录密码字段
loginPassword.textbox({
    width:220,
    height:32,
    iconCls:'icon-lock2',
    validType:'length[6,30]',
    missingMessage:'请输入登录密码',
    invalidMessage:'登录密码不能少于6位'
});

//注册账号字段
registerAccounts.textbox({
    width:220,
    height:32,
    iconCls:'icon-man',
    validType:'length[2,20]',
    required:true,
    missingMessage:'请输入注册账号',
    invalidMessage:'登录账号[2,20]位'
});

//注册密码字段
registerPassword.textbox({
    width:220,
    height:32,
    iconCls:'icon-lock2',
    required:true,
    validType:'length[6,30]',
    missingMessage:'请输入登录密码',
    invalidMessage:'登录密码不能少于6位'
});

//注册确认密码字段
registerPassword2.textbox({
    width:220,
    height:32,
    iconCls:'icon-lock2',
    required:true,
    validType:'equals["#register-password"]',
    missingMessage:'请确认账号密码',
    invalidMessage:'确认密码和密码不一致'
});

//检查密码和确认密码是否相同。
$.extend($.fn.validatebox.defaults.rules, {
    equals: {
        validator: function(value,param){
            return value == $(param[0]).val();
        },
        message: 'Field do not match.'
    }
});
