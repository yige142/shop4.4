/**
 * Created by Administrator on 2017/10/26.
 */
var staffAddGender=$('#staff-add-gender'),
    nickname=$('#nickname'),
    birthday=$('#birthday'),
    phone=$('#phone'),
    email=$('#email'),
    baseInfo=$('#base_info');



/*--加载用户基本信息下方--*/
//加载用户基本信息
//$(document).ready(function(){
//
//});
$.ajax({
    url:ThinkPhP['MODULE'] + '/User/getOne',
    type:'POST',
    data:{
        id:$('#User_id').val()
    },
    beforeSend:function(){
        $.messager.progress({
            text:'数据加载中....'
        });
    },
    success:function(data){
        $.messager.progress('close');
        if(data){
            //window.location.href = ThinkPhP['MODULE'] + '/User/base_info';
            baseInfo.form('load',{
                birthday:data.birthday,
                phone:data.phone,
                email:data.email,
                id:data.id
            });
            if(data.sex=='男'){//如果性别的值等于男， 调整性别linkbutton选中的效果
                $('#staff-add-gender-1').linkbutton('select');
            }else{
                $('#staff-add-gender-2').linkbutton('select');
            }

        }
    }
});




/*--修改用户信息下方--*/
    $('#base_info_submit').click(function(){
        if(baseInfo.form('validate')){
            $.ajax({
                url:ThinkPhP['MODULE'] + '/User/update',
                type:'POST',
                async:false,
                data:{
                    id: $('#base_info_id').val(),
                    sex: $.trim($('#staff-add-gender').val()),
                    birthday: $.trim($('#birthday').datebox('getValue')),
                    phone: $.trim($('#phone').val()),
                    email: $.trim($('#email').val())
                },
                beforeSend:function(){
                    $.messager.progress({
                        text:'正在添加中...'
                    });
                },
                /*--ajax 的success 部分被覆盖？什么鬼--*/
                success: function (data) {
                    $.messager.progress('close');
                    if(data>0){
                        $.messager.show({
                            title:'操作提示',
                            msg:'修改成功'
                        });
                    }else{
                        $.messager.alert('修改失败','没有任何数据被修改','warning');
                    }
                }
            });
        }else{
            alert('未验证通过');
        }

    });



/*--修改用户信息上方--*/


/*--添加表单字段区域下方--*/
//昵称
nickname.textbox({
    width:220,
    height:32,
    editable:false
});

//性别
$('#staff-add-gender-1').linkbutton({
    plain : true,
    toggle : true,
    selected : true,
    group : 'staff_add_gender',
    iconCls :'icon-male',
    onClick : function ()
    {
        staffAddGender.val('男');
    }
});
$('#staff-add-gender-2').linkbutton({
    plain : true,
    toggle : true,
    group : 'staff_add_gender',
    iconCls : 'icon-female',
    onClick : function ()
    {
        staffAddGender.val('女');
    }
});
//生日
birthday.datebox({
    width:220,
    height:32,
    required:true,
    editable:false
});
//手机
phone.numberbox({
    width:220,
    height:32,
    required:true,
    validType:'length[11,15]',
});
//邮箱
email.textbox({
    width:220,
    height:32,
    required:true,
});
/*--添加表单字段区域上方--*/


