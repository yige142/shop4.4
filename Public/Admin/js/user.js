/**
 * Created by Administrator on 2016/12/9.
 */
var user                =$('#user'),
    userAdd             =$('#user-add'),
    userAddAccounts    =$('#user-add-accounts'),
    userAddPassword    =$('#user-add-password'),
    userEdit            =$('#user-edit'),
    userEditAccounts   =$('#user-edit-accounts'),
    userEditPassword   =$('#user-edit-password'),
    userEditId          =$('#user-edit-id'),
    userEditState       =$('#user-edit-state'),
    userEditStaffName   =$('#user-edit-staff-name'),
    userEditStateButton =$('#user-edit-state-button'),
    userSearchKeywords =$('#user-search-keywords'),
    userSearchState    =$('#user-search-state'),
    userSearchDateType =$('#user-search-date-type'),
    userSearchDateFrom =$('#user-search-date-from'),
    userSearchDateTo   =$('#user-search-date-to'),
    userTool            =$('#user-tool'),
    userOpt,
    userDate;






    //表格数据列表
 user.datagrid({
    url:ThinkPhP['MODULE'] + '/User/getList',
     fit:true,
     fitColumns:true,
     rownumbers:true,
     border:false,
     sortName:'create_time',
     sortOrder:'DESC',
     toolbar:'#user-tool',
     pagination : true,
     pageSize:20,
     pageList:[10,20,30,50,100],
     pageNumber:1,
     columns:[[
         {
             field:'id',
             title:'自动编号',
             width:'100',
             checkbox:true,
         },
         {
             field:'accounts',
             title:'登录账号',
             width:'100'
         },
         {
             field:'last_login_time',
             title:'登录时间',
             width:'140',
             sortable:true
         },
         {
             field:'last_login_ip',
             title:'登录IP',
             width:'100'
         },
         {
             field:'login_count',
             title:'登录次数',
             width:'80'
         },
         {
             field:'create_time',
             title:'创建时间',
             width:'60',
             sortable:true
         },
         {
             field:'state',
             title:'状态',
             width:'60',
             sortable:true,
             fixed:true,
             //formatter单元格格式函数，state返回单元格中的value'正常'，‘冻结’值
             formatter:function(value,row){
                 var state='';
                  switch (value){
                      case '正常':
                          state='<a href="javascript:void(0)"user-id="'+ row.id+'" user-state="正常" class="user-state user-state-1" style="height:18px;margin-left:11px;"></a>'
                          break
                      case '冻结':
                          state='<a herf="javascript:void(0)" user-id="'+row.id+'" user-state="冻结" class="user-state user-state-2" style="height:18px;margin-left:11px;"></a>'
                          break
                  }
                 return state;
             }
         }
     ]],
     //表单加载完后给状态栏替换勾X图片
     onLoadSuccess:function() {
         $('.user-state-1').linkbutton({
             iconCls: 'icon-ok',
             plain: true
         });
         $('.user-state-2').linkbutton({
             iconCls: 'icon-lock',
             plain: true
         });
         //$('.user-state')可以获取到所点击出的隐藏要素，如自己自定义的  user-id  user-state  ‘attr’属性
         $('.user-state').click(function () {
             var id    =$(this).attr('user-id'),
                 state =$(this).attr('user-state');
             switch (state){
                 case '正常':
                     $.messager.confirm('确认','确定冻结账号？',function(flag){
                         if(flag){
                             $.ajax({
                                 url:ThinkPhP['MODULE'] + '/User/state',
                                 type:'POST',
                                 data:{
                                     id:id,
                                     state:'冻结'
                                 },
                                 beforeSend:function(){
                                     user.datagrid('loading');
                                 },
                                 success:function(data){
                                     user.datagrid('loaded');
                                     if(data>0){
                                         user.datagrid('reload');
                                         $.messager.show({
                                             title:'操作提醒',
                                             msg:'账号冻结成功！'
                                         });
                                     }else{
                                         $.messager.alert('冻结失败','未知原因导致冻结失败','warning');
                                     }
                                 }
                             });
                         }
                     });
                     break;
                 case'冻结':
                     $.messager.confirm('确认','确定解除账号？',function(flag){
                         if(flag){
                             $.ajax({
                                 url:ThinkPhP['MODULE'] + '/User/state',
                                 type:'POST',
                                 data:{
                                     id:id,
                                     state:'正常'
                                 },
                                 beforeSend:function(){
                                   user.datagrid('loading');
                                 },
                                 success:function(data){
                                     user.datagrid('loaded');
                                     if(data>0){
                                         user.datagrid('reload');
                                         $.messager.show({
                                             title:'操作提醒',
                                             msg:'解除冻结账号成功！'
                                         });

                                     }else{
                                         $.messager.alert('操作提醒','未知错误导致解除冻结账号失败','warning')
                                     }
                                 }
                             });
                         }
                     });
                     break
             }
         });

     }

});

//新增面板
userAdd.dialog({
    title:'新增用户',
    width:'400',
    height:'220',
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
                  if(userAdd.form('validate')){
                      $.ajax({
                          url:ThinkPhP['MODULE'] + '/User/register',
                          type:'Post',
                          data:{
                              accounts: $.trim(userAddAccounts.val()),
                              password:userAddPassword.val()
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
                                  userAdd.dialog('close');
                                  user.datagrid('load');
                              }else if(data ==-1){
                                  $.messager.alert('添加失败','账号被占用','warning',function(){
                                      userAddAccounts.textbox('textbox').select();
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
                userAdd.dialog('close');
            }
        }
    ],
    onClose:function(){
        userAdd.form('reset');
        userAdd.dialog('center');
    }

});
//新增面板相关字段
//新增账号字段
userAddAccounts.textbox({
    width:220,
    height:32,
    required:true,
    validType:'length[2,20]',
    missingMessage:'请输入账号',
    invalidMessage:'账号名称2-20位之间'
});
//新增密码字段
userAddPassword.textbox({
    width:220,
    height:32,
    validType:'length[6,30]',
    missingMessage:'请输入密码',
    invalidMessage:'密码长度需6-30位之间'
});

//修改面板
userEdit.dialog({
    title:'修改账号',
    width:400,
    height:250,
    iconCls:'icon-edit',
    closed:true,
    modal:true,
    maximizable:true,
    buttons:
      [
          {
              text:'保存',
              size:'large',
              iconCls:'icon-accept',
              handler:function(){
                  if(userEdit.form('validate')){
                      $.ajax({
                          url:ThinkPhP['MODULE'] + '/User/update',
                          type:'POST',
                          data:{
                              id:userEditId.val(),
                              password:userEditPassword.val(),
                              state:userEditState.val()

                          },
                          beforeSend:function(){
                              $.messager.progress({
                                  text:'正在处理中....'
                              });
                          },
                          success: function (data) {
                              $.messager.progress('close');
                              if(data > 0){
                                  $.messager.show({
                                      title:'操作成功',
                                      msg:'修改成功'
                                  });
                                  userEdit.dialog('close');
                                  user.datagrid('reload');
                              }else if(data=="密码长度不合法"){
                                  $.messager.alert('操作提示','密码长度不合法');
                              }
                              else if(data==0){
                                  $.messager.alert('修改失败','没有任何数据被修改','warning',function(){
                                      userEditAccounts.textbox('textbox').select();
                                  })
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
              handler: function () {
                 userEdit.dialog('close');
              }
          }
      ],
    onClose:function(){
        userEdit.form('reset');
        userEdit.dialog('center');
    }

});
//修改面板账号字段
userEditAccounts.textbox({
    width:220,
    height:32,
    disable:true
});
//修改面板密码字段
userEditPassword.textbox({
    width:220,
    height:32,
    validType:'length[6,30]',
    missingMessage:'请修改账号密码',
    invalidMessage:'账号密码6-30位之间'
});
//修改状态滑动按钮
userEditStateButton.switchbutton({
    width:65,
    onText:'正常',
    offText:'冻结',
    onChange:function(checked){
        if(checked){
            userEditState.val('正常');
        }else{
            userEditState.val('冻结');
        }
    }
});

/*---------------------------------------------------------------------------*/
//工具条操作
userOpt=
{
    add:function()
    {
      userAdd.dialog('open');
    },
    edit:function(){
        var rows=user.datagrid('getSelections');
        if(rows.length ==1){
             userEdit.dialog('open');
            $.ajax({
                url:ThinkPhP['MODULE'] + '/User/getOne',
                type:'POST',
                data:{
                    id:rows[0].id
                },
                beforeSend:function(){
                    $.messager.progress({
                        text:'正在处理中....'
                    });
                },
                success:function(data){
                    $.messager.progress('close');
                    if(data){
                        userEdit.form('load',{
                            id:data.id,
                            accounts:data.accounts,

                        });
                        if(data.state=='正常'){
                            userEditStateButton.switchbutton("check");
                            userEditState.val('正常');
                        }else{
                            userEditStateButton.switchbutton('uncheck');
                            userEditState.val('冻结');
                        }
                    }else{
                        $.messager.alert('操作警告','没有获取到任何数据','warning');
                    }
                }
            });
        }else{
            $.messager.alert('操作警告','请先选择一条数据','warning');
        }
    },
    remove:function()
    {
        var rows=user.datagrid('getSelections');
        if(rows.length > 0) {
            $.messager.confirm('确认操作','您真的要删除所选的<strong'+rows.length +'</strong>条记录吗？',function(flag){
                if(flag){
                    var ids=[];
                    for(var i=0; i<rows.length; i++){
                        ids.push(rows[i].id);
                    }

                    $.ajax({
                        url:ThinkPhP['MODULE'] + '/User/remove',
                        type:'Post',
                        data:{
                            ids:ids.join(',')
                        },
                        beforeSend:function(){
                            user.datagrid('loading');
                        },
                        success:function(data){
                            user.datagrid('loaded');
                            if(data){
                                user.datagrid('reload');
                                $.messager.show({
                                    title:'操作提醒',
                                    msg:data +'条数据被删除成功！'
                                });
                            }else{
                                $.messager('操作提醒','没有删除任何数据','warning');
                            }
                        }
                    });
                }
            });
        }else{
            $.messager.alert('操作警告','删除记录必须一条或以上的数据','warning');
        }

    },
    reload:function(){
      user.datagrid('reload');
    },
    redo:function(){
        user.datagrid('unselectAll');
    },
    search:function(){
        if(userTool.form('validate')){
            user.datagrid('load',{
               keywords:userSearchKeywords.textbox('getValue'),
                dateType:userSearchDateType.combobox('getValue'),
                dateFrom:userSearchDateFrom.datebox('getValue'),
                dateTo:userSearchDateTo.datebox('getValue'),
                state:userSearchState.combobox('getValue')
            });
        }
    },
    reset:function(){
       userSearchKeywords.textbox('clear');
        userSearchDateType.combobox('clear').combobox('disableValidation');
        userSearchDateFrom.datebox('clear');
        userSearchDateTo.datebox('clear');
        userSearchState.combobox('clear');
        this.search();
        user.datagrid('sort',{
            sortName:'create_time',
            sortOrder:'DESC'
        });
    }
}

;


/*--------------------------查询字段区域-------------------------------------*/
//关键字
userSearchKeywords.textbox({
    width:150,
    prompt:'账号'
});

//状态
userSearchState.combobox({
    width:70,
    editable:false,
    prompt:'状态',
    data:[
        {
        id:'正常',
        text:'正常'
        },
        {id:'冻结',
         text:'冻结'
    }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto'
});

//时间类型
userSearchDateType.combobox({
    width:100,
    editable:false,
    prompt:'时间类型',
    data:[
        {
            id:'create_time',
            text:'创建时间'
        }
    ],
    valueField:'id',
    textField:'text',
    required:true,
    novalidate:true,
    panelHeight:'auto',
    tipPosition:'left',
    missingMessage:'请选择时间类型'
});

//查询时间对象
userDate={
 width:100,
    editable:false,
    onSelect:function(){
       if(userSearchDateType.combobox('enableValidation').combobox('isValid') == 'false'){
           userSearchDateType.combobox('showPanel');
       }
    }
}

//起始时间
userDate.prompt='起始时间';
userSearchDateFrom.datebox(userDate);

//结束时间
userDate.prompt='结束时间';
userSearchDateTo.datebox(userDate);


