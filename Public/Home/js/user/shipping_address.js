/**
 * Created by Administrator on 2017/10/31.
 */
var Address=$('#address'),
    addressOpt;

//加载地址信息表格显示
Address.datagrid({
    url:ThinkPhP['MODULE'] + '/Address/getList',
    fit:true,
    height:1200,
    fitColumns:true,
    rownumbers:true,
    border:false,
    queryParams:{
        id:$('#User_id').val()
    },
    sortName:'create_time',
    sortOrder:'DESC',
    toolbar:'#staff-tool',
    pagination:true,
    pageSize:20,
    pageList:[10,20,30,40,50],
    pageNumber:1,
    columns:[[
        {
            field:'id',
            title:'自动编号',
            width:100,
            hidden:true
        },
        {
            field:'name',
            title:'姓名',
            width:70,
            sortable:true
        },
        {
            field:'phone',
            title:'电话',
            width:70,
        },
        {
            field:'address',
            title:'地址',
            width:180,
        },
        {
            field:'tab',
            title:'是否默认地址',
            width:80,
            hidden:true,
            fixed:true,
            formatter:function(value,row){
                var tab='';
                switch (value){
                    case '默认':
                        tab='<a href="javascript:void(0)"user-id="'+ row.id+'" tab="默认" class="user-state user-state-1" style="height:18px;margin-left:11px;"></a>'
                        break
                    case '非默认':
                        tab='<a herf="javascript:void(0)" user-id="'+row.id+'" tab="非默认" class="user-state user-state-2" style="height:18px;margin-left:11px;"></a>'
                        break
                }
                return tab;
            }
        },
        {
            field:'opt',
            title:'',
            width:60,
            fixed:true,
            formatter:function(value,row){
                return '<a href="javascript:void(0)" class="edit" style="height: 18px;margin-left:0px;text-decoration:none;color:#000" onclick="addressOpt.edit(' + row.id + ');">编辑</a>';
            }
        },
        {
            field:'opt2',
            title:'',
            width:60,
            fixed:true,
            formatter:function(value,row){
                return '<a href="javascript:void(0)" class="delete" style="height: 18px;margin-left:0px;text-decoration:none;color:#000" onclick="addressOpt.remove(' + row.id + ');">删除</a>';
            }
        },
    ]],
    onLoadSuccess: function (data) {
        $('.edit').linkbutton({
            iconCls: 'icon-edit',
            plain: true
        });
        $('.delete').linkbutton({
            iconCls: 'icon-remove',
            plain: true
        });

        //默认地址图标
        $('.user-state-1').linkbutton({
            iconCls: 'icon-ok',
            plain: true
        });
        $('.user-state-2').linkbutton({
            iconCls: 'icon-lock',
            plain: true
        });
    }
});



//新增操作
$('#address-add').dialog({
    title:'新增地址信息',
    width:'400',
    height:'450',
    iconCls:'icon-add',
    closed:true,
    modal:true,
    maximizable:true,
    buttons:[
        {
            text:'保存',
            size:'large',
            iconCls:'icon-accept',
            handler:function(){
                   if($('#address-add').form('validate')){
                       $.ajax({
                           url:ThinkPhP['MODULE'] + '/Address/register',
                           type:'Post',
                           data:{
                               uid:$('#User_id').val(),
                               name:$('#address-add-accounts').val(),
                               phone:$('#address-add-phone').val(),
                               address:$('#address-add-address').val(),
                               tab:$('#address-add-tab').combobox('getValue')
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
                                   $('#address-add').dialog('close');
                                   Address.datagrid('load');
                               }else {
                                   $.messager.alert('添加失败','账号被占用','warning',function(){
                                   })
                               }
                           }
                       });
                   }else{
                       alert('验证未通过');
                   }
            }
        },
        {
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                    $('#address-add').dialog('close');
            }
        }
    ],
    onClose:function(){
       $('#address-add').form('reset');
        $('#address-add').dialog('center');
    }
});

//修改操作
$('#address-edit').dialog({
    title:'修改地址信息',
    width:'400',
    height:'450',
    iconCls:'icon-eidt',
    closed:true,
    modal:true,
    maximizable:true,
    buttons:[
        {
            text:'保存',
            size:'large',
            iconCls:'icon-accept',
            handler:function(){
                if($('#address-edit').form('validate')){
                    $.ajax({
                        url:ThinkPhP['MODULE'] + '/Address/update',
                        type:'Post',
                        data:{
                            id:$('#address_id').val(),
                            name:$('#address-edit-accounts').val(),
                            phone:$('#address-edit-phone').val(),
                            address:$('#address-edit-address').val(),
                            tab:$('#address-edit-tab').combobox('getValue')
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
                                $('#address-edit').dialog('close');
                                Address.datagrid('load');
                            }else {
                                $.messager.alert('修改失败','修改失败','warning',function(){
                                })
                            }
                        }
                    });
                }else{
                    alert('验证未通过');
                }
            }
        },
        {
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                $('#address-edit').dialog('close');
            }
        }
    ],
    onClose:function(){
        $('#address-edit').form('reset');
        $('#address-edit').dialog('center');
    }
});
//工具栏操作
addressOpt={
    //增加
    add:function(){
        $('#address-add').dialog('open');
    },
    //编辑
    edit:function($id){
        var address_id=$id;
        $('#address-edit').dialog('open');
        $.ajax({
            url:ThinkPhP['MODULE'] + '/Address/getOne',
            type:'POST',
            data:{
                id:address_id
            },
            beforeSend:function(){
                $.messager.progress({
                    text:'正在处理中...'
                });
            },
            success:function(data){
                $.messager.progress('close');
                if(data){
                    $('#address-edit').form('load',{
                        id:data.id,
                        name:data.name,
                        phone:data.phone,
                        address:data.address,
                        tab:data.tab
                    });
                }else{
                    $.messager.alert('操作警告','没有获取到任何数据','warning');
                }
            }
        });
    },
    //删除
    remove:function($id){
        var id=$id;
        $.messager.confirm('确认操作','您真的要删除这条记录吗？',function(flag){
            if(flag){
                $.ajax({
                    url:ThinkPhP['MODULE'] + '/Address/remove',
                    type:'POST',
                    data:{
                        id:id,
                    },
                    beforeSend:function(){
                        $.messager.progress({
                            text:'正在处理中...'
                        });
                    },
                    success:function(data){
                        $.messager.progress('close');
                        if(data){
                            Address.datagrid('reload');
                            $.messager.show({
                                title:'操作提示',
                                msg:'删除成功'
                            });
                        }else{
                            $.messager.alert('删除失败','没有删除任何数据','warning');
                        }
                    }
                });
            }
        });
    }
}

/*--新增表单字段下方--*/
//姓名
$('#address-add-accounts').textbox({
    width:240,
    height:32,
    required:true
});
//电话
$('#address-add-phone').numberbox({
    width:240,
    height:32,
    required:true,
    validType:'length[11,15]',
});

//是否默认地址
$('#address-add-tab').combobox({
    width:100,
    editable:false,
    prompt:'非默认',
    value:"非默认",
    hidden:true,
    data:[
        {
            id:'默认',
            text:'默认'
        },
        {id:'非默认',
            text:'非默认'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto'
});
/*--新增表单字段上方--*/


/*--修改表单字段下方--*/
//姓名
$('#address-edit-accounts').textbox({
    width:240,
    height:32,
    required:true
});
//电话
$('#address-edit-phone').numberbox({
    width:240,
    height:32,
    required:true,
    validType:'length[11,15]',
});

//是否默认地址
$('#address-edit-tab').combobox({
    width:100,
    editable:false,
    //prompt:'非默认',
    //value:"非默认",
    hidden:true,
    data:[
        {
            id:'默认',
            text:'默认'
        },
        {id:'非默认',
            text:'非默认'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto'
});
/*--修改表单字段上方--*/