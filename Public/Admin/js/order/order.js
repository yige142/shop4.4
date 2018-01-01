/**
 * Created by Administrator on 2017/11/14.
 */


var order=$('#order'),
    orderOpt;



//加载订单详情
order.datagrid({
    url:ThinkPhP['MODULE'] + '/Order/getList',
    fit:true,
    height:400,
    fitColumns:true,
    rownumbers:true,
    border:false,
    sortName:'create_time',
    sortOrder:'DESC',
    toolbar:'#order-tool',
    pagination:true,
    pageSize:20,
    pageList:[10,20,30,40,50],
    pageNumber:1,
    columns:[[
        {
            field:'orderId',
            title:'订单ID',
            width:'100',
            hidden:true
        },
        {
            field:'order_name',
            title:'订单名称',
            width:'250',
        },
        {
            field:'orderSn',
            title:'订单编号',
            width:'250',
        },
        {
            field:'goods_name',
            title:'物品名称',
            width:'150',
        },
        {
            field:'unit_price',
            title:'单价',
            width:'100',
        },
        {
            field:'number',
            title:'数量',
            width:'100',
        },
        {
            field:'total_price',
            title:'实付款',
            width:'100',
            styler: function(value){
                if (value){
                    return 'color:red;';
                }
            }
        },
        {
            field:'create_time',
            title:'创建时间',
            width:'125',
            formatter:function(value,row,index){
                return  value.substr(0,11)
            }
        },
        {
            field:'order_status',
            title:'商品状态',
            width:'100',
        },
        {
            field:'order_cancel',
            title:'是否是取消的订单',
            width:'100',
            hidden:true
        },
        {
            field:'opt',
            title:'交易操作',
            width:'100',
            height:24,
            formatter:function(value,row,index){
                if(row.order_status=='未受理'){
                    return '<a href="javascript:void(0)"  order_id="'+row.orderId+'" operation_type="受理" class="operation receive_icon " data-options="iconCls:\'icon-search\'">受理订单并发货</a>'
                }
                else if(row.order_status=='取消中'){
                    return '<a href="javascript:void(0)" order_id="'+row.orderId+'" operation_type="同意取消"  class="operation cancel_icon">同意取消订单</a>'
                }else if(row.order_status=='退款中'){
                    return '<a href="javascript:void(0)" order_id="'+row.orderId+'" order_id="'+row.orderId+'" operation_type="同意退款"  class="operation cancel_icon">同意退款</a>'
                }
            }
        },

        {
            field:'goodsId',
            title:'物品ID',
            width:'100',
            hidden:true
        },
        {
            field:'goods_info',
            title:'商品info',
            width:'100',
            hidden:true
        },
        {
            field:'thumb_path',
            title:'缩略图地址',
            width:'100',
            hidden:true
        }
    ]],
    view: detailview,
    //数据表格点加号+可以查看缩略图，实现该效果只要引用easyui  datagrid-datailview.js  加上下面的格式
    detailFormatter: function(rowIndex, rowData){

        return '<table><tr>' +
                //'<td rowspan=2 style="border:0"><img src="images/' + rowData.thumb_path + '.png" style="height:50px;"></td>' +
            '<td rowspan=2 style="border:0"><img id="tupian" src="'+ThinkPhP['ROOT']+'/'+rowData.thumb_path+'" style="height:50px;"></td>' +
            '<td style="border:0">' +
            '<p>商品名称: ' + rowData.goods_name + '</p>' +
            '<p>商品介绍: ' + rowData.goods_info + '</p>' +
            '</td>' +
            '</tr></table>';

    },
    onLoadSuccess: function (data) {
        //图标默认展开一行带图片
        order.datagrid("expandRow",0);

        $('.cancel_icon').linkbutton({
            iconCls: 'icon-undo',
            plain: true
        });
        $('.v').linkbutton({
            iconCls: 'icon-ok',
            plain: true,
           iconAlign:'right'
        });
        $('.returned_icon').linkbutton({
            iconCls: 'icon-return_purchase',
            plain: true
        });
        $('.receive_icon').linkbutton({
            iconCls:'icon-ok',
            plain:true
        });

        $('.operation').click(function(){
            var id=$(this).attr('order_id');
            var operation_type=$(this).attr('operation_type');
            switch (operation_type){
                case '受理':
                    $.messager.confirm('确认','确认受理订单？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Order/receive',
                                type:'POST',
                                data:{
                                    id:id,
                                    order_status:'已受理'
                                },
                                beforeSend:function(){
                                    order.datagrid('loading');
                                },
                                success:function(data){
                                    order.datagrid('loaded');
                                    if(data>0){
                                        order.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'订单已受理，请准备发货...'
                                        });
                                    }else{
                                        $.messager.alert('操作失败','未知原因导致失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break;
                case '同意取消':
                    $.messager.confirm('确认','确认同意取消订单？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Order/undo',
                                type:'POST',
                                data:{
                                    id:id,
                                    order_status:'已取消',
                                    order_cancel:'是'
                                },
                                beforeSend:function(){
                                    order.datagrid('loading');
                                },
                                success:function(data){
                                    order.datagrid('loaded');
                                    if(data>0){
                                        order.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'已同意取消订单....'
                                        });
                                    }else{
                                        $.messager.alert('操作失败','未知原因导致失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break
                case '同意退款':
                    $.messager.confirm('确认','确认同意退款？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Return/return_goods',
                                type:'POST',
                                data:{
                                    order_id:id
                                },
                                beforeSend:function(){
                                    order.datagrid('loading');
                                },
                                success:function(data){
                                    order.datagrid('loaded');
                                    if(data=1){
                                        order.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'退款成功....'
                                        });
                                    }else{
                                        $.messager.alert('操作失败','未知原因导致退款失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break;
            }

        });

    },

});

//工具栏操作
orderOpt={
    reload:function(){
        order.datagrid('reload');
    },
    search:function(){
        order.datagrid('load',{
            keywords : $('#order-search-keywords').textbox('getValue'),
            goodsType : $('#order-search-type').combobox('getValue'),
            cancel : $('#order-search-cancel').textbox('getValue')
        });
    },
    reset:function(){
            $('#order-search-keywords').textbox('clear'),
            $('#order-search-type').combobox('clear'),
            $('#order-search-cancel').textbox('clear'),
                this.search();
                order.datagrid('sort', {
                    sortName : 'create_time',
                    sortOrder : 'DESC'
                });
    }
}



//搜索订单名称字段
$('#order-search-keywords').textbox({
    width:200,
    height:25,
    prompt:'订单名称|订单编号',
});
//搜索订单状态字段
$('#order-search-type').combobox({
    width:85,
    height:25,
    prompt:'商品状态',
    url:ThinkPhP['MODULE']+'/Order/getList',
    queryParams : {
        order_status : true
    },
    editable:false,
    valueField:'order_status',
    textField:'order_status',
    panelHeight:'auto'
});
//搜素取消的订单
$('#order-search-cancel').combobox({
    width:135,
    height:25,
    prompt:'是否是取消的订单',
    url:ThinkPhP['MODULE']+'/Order/getList',
    queryParams : {
        order_cancel : true
    },
    editable:false,
    valueField:'order_cancel',
    textField:'order_cancel',
    panelHeight:'auto'
});