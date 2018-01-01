/**
 * Created by Administrator on 2017/9/21.
 */
var oldPassword=$('#oldPassWord'),
    newPassword=$('#newPassWord'),
    newPassword2=$('#newPassWord2');

$('#submit').click(function(){
    $.ajax({
        url:ThinkPhP['MODULE'] + '/User/editPassword',
        type:'POST',
        data:{
            id:$('#User_id').val(),
            oldPassword:oldPassword.val(),
            password:newPassword.val()
        },
        beforeSend:function(){
            $.messager.progress({
                text:'正在尝试保存....'
            });
        },
        success:function(data){
            $.messager.progress('close');
            if(data >0){

                alert("修改密码成功");
                //editPassword.form('reset');
                //$.messager.alert('操作提醒', '密码修改成功，请重新登录！', 'info', function(){
                //    location.href = ThinkPhP['MODULE'] + '/Login/logout';
                //});
            }else if(data==-3){
                //$.messager.alert('操作提醒','与原密码相同，修改失败','warning',function(){
                //    editPassword.textbox('textbox').select();
                //});
                alert('原始密码不正确');
            }else{
                alert('修改失败');
            }
        }
    });
});



//原始密码字段
oldPassword.textbox({
    width:220,
    height:32,
    iconCls:'icon-lock2',
    required:true,
    missingMessage:'请输入原始密码'
});

//新密码字段
newPassword.textbox({
    width:220,
    height:32,
    iconCls:'icon-lock2',
    validType:'length[6,30]',
    required:true,
    missingMessage:'请输入登录密码',
    invalidMessage:'登录密码不能少于6位'
});

//新确认密码字段
newPassword2.textbox({
    width:220,
    height:32,
    iconCls:'icon-lock2',
    required:true,
    validType:'equals["#newPassWord"]',
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