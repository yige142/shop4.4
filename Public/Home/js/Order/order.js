/**
 * Created by xiexiaomao on 2017/11/14.
 */
var order=$('#order'),
    return_money=$('#return_money'),
    orderOpt;
//订单数据展示
order.datagrid({
    url:ThinkPhP['MODULE'] + '/Order/getList',
    fit:false,
    height:400,
    fitColumns:true,
    rownumbers:true,
    border:false,
    queryParams:{
        id:$('#User_id').val()
    },
    sortName:'create_time',
    sortOrder:'DESC',
    toolbar:'#order-tool',
    pagination:true,
    pageSize:10,
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
            width:'110',
        },
        {
            field:'goodsId',
            title:'商品Id',
            hidden:true
        },
        {
            field:'orderSn',
            title:'订单编号',
            width:'80',
        },
        {
            field:'goods_name',
            title:'物品名称',
            width:'80',
        },
        {
            field:'unit_price',
            title:'单价',
            width:'50',
        },
        {
            field:'number',
            title:'数量',
            width:'30',
        },
        {
            field:'total_price',
            title:'实付款',
            width:'50',
            styler: function(value){
                if (value){
                    return 'color:red;';
                }
            }
        },
        {
            field:'create_time',
            title:'创建时间',
            width:'75',
            formatter:function(value,row,index){
                return  value.substr(0,11)
            }
        },
        {
            field:'pay_status',
            title:'支付状态',
            width:'75',

        },
        {
            field:'order_status',
            title:'商品状态',
            width:'55',
        },
        {
            field:'goods_info',
            title:'商品信息',
            width:'100',
            hidden:true
        },
        {
            field:'user_id',
            title:'user_id',
            width:'20',
            hidden:true
        },
        {
            field:'opt',
            title:'交易操作',
            width:'50',
            formatter:function(value,row,index){
               if(row.order_status=='未受理'){
                  return '<a href="javascript:void(0)"  order_id="'+row.orderId+'" pay_status="'+row.pay_status+'" operation_type="取消" class="operation cancel_icon">取消订单</a>';
               }else if(row.order_status=='已受理'){
                   return '<a href="javascript:void(0)" order_id="'+row.orderId+'" goods_id="'+row.goodsId+'" number="'+row.number+'"  operation_type="收货"  class="operation receive_icon">收货</a><a href="javascript:void(0)" order_id="'+row.orderId+'" order_sn="'+row.orderSn+'" order_name="'+row.order_name+'" thumb_path="'+row.thumb_path+'" total_price="'+row.total_price+'" user_id="'+row.user_id+'" return_goods_id="'+row.goodsId+'" operation_type="退货"  class="operation returned_icon">退货</a>';
               }
            }
        },
        {
            field:'order_cancel',
            title:'是否取消',
            width:'100',
            hidden:true
        },
        {
            field:'goodsId',
            title:'物品ID',
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
    onLoadSuccess: function () {
        //加载linkbutton 图片
        $('.cancel_icon').linkbutton({
            iconCls: 'icon-undo',
            plain: true
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
            var pay_status=$(this).attr('pay_status');
            var number=$(this).attr('number');
            var goods_id=$(this).attr('goods_id');
            var operation_type=$(this).attr('operation_type');

            //退货用到字段
            var order_sn=$(this).attr('order_sn');
            var order_name=$(this).attr('order_name');
            var thumb_path=$(this).attr('thumb_path');
            var total_price=$(this).attr('total_price');
            var return_goods_id=$(this).attr('return_goods_id');
            var user_id=$(this).attr('user_id');
            //alert(order_sn);
            //alert(thumb_path);
            switch (operation_type){
                case '取消':
                         if(pay_status=='未付款'){
                             $.messager.confirm('确认','确认要取消订单？',function(flag){
                                 if(flag){
                                     $.ajax({
                                         url:ThinkPhP['MODULE'] + '/Order/cancel',
                                         type:'POST',
                                         data:{
                                             id:id,
                                             order_status:'已取消'
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
                                                     msg:'订单已取消。'
                                                 });
                                             }else{
                                                 $.messager.alert('操作失败','未知原因导致失败','warning');
                                             }
                                         }
                                     });
                                 }
                             });
                         }else if(pay_status=='已付款'){
                             $.messager.confirm('确认','确认要取消订单？',function(flag){
                                 if(flag){
                                     $.ajax({
                                         url:ThinkPhP['MODULE'] + '/Order/cancel',
                                         type:'POST',
                                         data:{
                                             id:id,
                                             order_status:'取消中'
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
                                                     msg:'商品取消中，待店主确认....'
                                                 });
                                             }else{
                                                 $.messager.alert('操作失败','未知原因导致失败','warning');
                                             }
                                         }
                                     });
                                 }
                             });
                         }

                    break
                case '退货':
                    $.messager.confirm('确认','确认要退货？',function(flag){
                        if(flag){
                            //弹出dialog
                            $('#return_money_table').dialog('open');
                            //退货物品显示
                            $('#return_img').attr('src',ThinkPhP['ROOT']+'/'+thumb_path);
                            //退货字段 html字体显示
                            $('.orders_name').html(order_name);
                            $('#return_orders_name').val(order_name);
                            $('#return_order_sn').val(order_sn);
                           //在js开头先定义了var return_money ，要不然用$('#return_money')调用还设置不了值
                            return_money.numberbox('setValue',total_price);
                            $('#orders_id').val(id);
                            //alert(return_goods_id);
                            $('#goods_id').val(return_goods_id);
                        }
                    });
                    break
                case '收货':
                    $.messager.confirm('确认','确认已收货？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Order/receive_goods',
                                type:'POST',
                                data:{
                                    id:id,
                                    order_status:'交易成功',
                                    number:number,
                                    goods_id:goods_id
                                },
                                beforeSend:function(){
                                    order.datagrid('loading');
                                },
                                success:function(data){
                                    order.datagrid('loaded');
                                    if(data){
                                        order.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'交易成功....'
                                        });
                                    }else{
                                        $.messager.alert('操作失败','未知原因导致失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break
            }

        });
       //数据加载完成，自动展开一行
        order.datagrid("expandRow",0);
    },

});


//退货操作
$('#return_money_table').dialog({
    title:'申请退款',
    width:'45%',
    height:'auto',
    iconCls:'icon-add',
    closed:true,
    modal:true,
    maximizable:true,
    buttons:[
        {
            text:'提交',
            size:'large',
            iconCls:'icon-accept',
            handler:function(){
             if($('#return_money_table').form('validate')){
                 $.ajax({
                     url:ThinkPhP['MODULE'] + '/Order/return_goods',
                     type:'POST',
                     data:{
                         user_id:$('#User_id').val(),
                         goods_id:$('#goods_id').val(),
                         order_id:$('#orders_id').val(),
                         return_goods_name:$('#return_orders_name').val(),
                         return_order_sn:$('#return_order_sn').val(),
                         return_money:$('#return_money').val(),
                         return_reason:$('#return_reason').val()
                     },
                     beforeSend:function(){
                         $.messager.progress({
                             text:'正在处理中...'
                         });
                     },
                     success:function(data){
                         order.datagrid('loaded');
                         if(data!=0){
                             $.messager.progress('close');
                             $('#return_money_table').form('clear');
                             $('#return_reason').val('');
                             $('#return_money_table').dialog('close');
                             order.datagrid('reload');
                             $.messager.show({
                                 title:'操作提醒',
                                 msg:'商品退货中，待店主确认后即可退款....'
                             });
                         }else{
                             $.messager.alert('操作失败','未知原因导致失败','warning');
                         }
                     }
                 });
                }else{
                 $.messager.alert('操作提示','金额有误','warning');
             }

            }
        },
        {
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                $('#return_money_table').form('clear');
                //退货物品显示
                //退货字段 html字体显示
                $('.orders_name').html('');
                $('#return_money_table').dialog('close');
            }
        }
    ]
});



//工具栏操作
orderOpt={
    reload:function(){
        order.datagrid('reload');
    }
}


/*--------------------------------------------------退货操作表单字段下方----------------------------------*/

//退款金额
return_money.numberbox({
    weight:240,
    height:32,
    precision:2,
    required:true
});
/*--------------------------------------------------退货操作表单字段上方----------------------------------*/
