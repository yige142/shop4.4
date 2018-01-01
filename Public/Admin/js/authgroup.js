/**
 * Created by Administrator on 2017/3/2.
 */
$(function(){

    //获取角色数据列表
    $('#authgroup').datagrid({
        url : ThinkPhP['MODULE'] + '/AuthGroup/getList',
        fit : true,
        fitColumns : true,
        striped : true,
        rownumbers : true,
        border : false,
        pagination : true,
        pageSize : 20,
        pageList : [10, 20, 30, 40, 50],
        pageNumber : 1,
        toolbar : '#authgroup_tool',
        columns : [[
            {
                field : 'id',
                title : '编号',
                width : 100,
                checkbox : true,
            },
            {
                field : 'title',
                title : '角色名称',
                width : 100,
            },
            {
                field : 'auth',
                title : '拥有的权限',
                width : 100,
            },
        ]],
    });

    //新增操作
    $('#authgroup_add').dialog({
        title:'新增操作',
        width:420,
        height:220,
        iconCls:'icon-add',
        modal:true,
        closed:true,
        maximizable:true,
        buttons:[
            {
                text:'提交',
                iconCls:'icon-accept',
                handler:function(){

                }
            },
            {
                text:'取消',
                iconCls:'icon-cross',
                handler:function(){
                      $('#authgroup_add').dialog('close');
                      $('#authgroup_add').form('clear');
                      $('#add-auth_nav').combotree('clear');
                }
            }
        ]
    });
    //操作工具
    authgroup_tool={
        add:function(){
            $('#authgroup_add').dialog('open');
        }
    }
//表单字段区域
    //查询字段
    $('#role').textbox({
        prompt:'关键字查询'
    });
    //开始时间
    $('#dateTo').datebox({
        prompt:'开始时间'
    });
    //结束时间
    $('#dateFrom').datebox({
        prompt:'结束时间'
    });

    //角色名称
     $('#add-role').textbox({
         width:220,
         height:32,
         required:true
     });
    //选择权限
    $('#add-auth_nav').combotree({
        width:220,
        height:32,

        required : true,
        lines : true,
        multiple : true,
        checkbox : true,
        onlyLeafCheck : true,
        data:[
            {
                id:'系统管理',
                text:'系统管理',
                children: [{
                    id:2,
                    text: '权限控制'
                },{
                    id:3,
                    text: '管理员管理'
                }]
            },

        ]

    })
});