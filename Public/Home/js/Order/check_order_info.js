/**
 * Created by Administrator on 2017/11/12.
 */
var check_orderOpt,
    order_address_add=$('#order_address_add');




$('#address_info_area').datagrid({
    url:ThinkPhP['MODULE'] + '/Address/getList',
    fit:true,
    height:1200,

    fitColumns:true,
    rownumbers:true,
    border:false,
    queryParams:{
        id:$('#session_id').val()
    },
    sortName:'create_time',
    sortOrder:'DESC',
    toolbar:'.tool-opt',
    pagination:true,
    pageSize:05,
    pageList:[5],
    pageNumber:1,
    columns:[[
        {
            field:'id',
            title:'id',
            width:100,
            hidden:true
        },
        {
            field:'opt',
            title:'',
            width:100,
            checkbox:true,

        },
        {
            field:'name',
            title:'姓名',
            width:70,
           // sortable:true
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
    ]],
    onLoadSuccess:function(){
        var rows=$('#address_info_area').datagrid('getSelections');
        if(rows.length ==1){
        }else{
            $.messager.alert('操作提示','请先选择一条收货地址','warning');
        }
    },
    onClickRow : function(index, row){
        var rows=$('#address_info_area').datagrid('getSelections');
        //如果地址信息选择一行，确认提交上的信息会被填充
        if(rows.length ==1){
                $.messager.confirm('确认','确认选择这条记录为收货地址吗？',function(flag){
                    if(flag){
                        $('#address_id').val(rows[0].id);
                        $('.area').html(rows[0].address);
                        $('.tel').html(rows[0].phone)
                        $.messager.alert('操作提示','选择地址成功');
                    }
                });
        }else{
            $.messager.alert('操作提示','先去掉勾选的上一条记录，再重新选择一条收货地址','warning');
            //取消选中的一行
            $(this).datagrid('unselectRow', index);
        }
    },
});


////选择地址
check_orderOpt={
    choice:function(){
        var rows=$('#address_info_area').datagrid('getSelections');
        if(rows.length ==1){
            $.messager.confirm('确认','确认选择这条记录为收货地址吗？',function(flag){
                if(flag){
                    $('#address_id').val(rows[0].id);
                    $('.area').html(rows[0].address);
                    $('.tel').html(rows[0].phone)
                    $.messager.alert('操作提示','选择地址成功');
                }
            });
        }else{
            $.messager.alert('操作警告','先去掉勾选的上一条记录，再重新选择一条收货地址','warning');
        }
    },
    add:function(){
        $('#order_address_add').dialog('open');
    }
}

//新增地址操作
order_address_add.dialog({
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
                if(order_address_add.form('validate')){
                    $.ajax({
                        url:ThinkPhP['MODULE'] + '/Address/register',
                        type:'Post',
                        data:{
                            uid:$('#session_id').val(),
                            name:$('#address_accounts').val(),
                            phone:$('#address_phone').val(),
                            address:$('#address_address').val(),
                            tab:'非默认'
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
                                order_address_add.dialog('close');
                                $('#address_info_area').datagrid('load');
                            }else {
                                $.messager.alert('添加失败','……','warning',function(){
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
                order_address_add.dialog('close');
            }
        }
    ],
    onClose:function(){
        order_address_add.form('reset');
        order_address_add.dialog('center');
    }
});



/*订单提交*/
$('#order_submit').click(function(){
    if($('#address_id').val()==''){
        $.messager.alert('操作提示','您没有选择收货地址，请先选择好收货地址或添加一条收货地址再提交');
    }else{
        $.ajax({
            url:ThinkPhP['MODULE'] + '/Order/register',
            type:'POST',
            data:{
                goods_id:$('#order_goods_id').val(),
                address_id:$('#address_id').val(),
                user_id:$('#session_id').val(),
                order_name:$('#order_name').val(),
                payment_type:$('#payment_type').combobox('getValue'),
                unit_price:$('#unit_price').val(),
                number:$('#goods_quantity').val(),
                total_price:$('#total_price').val(),
                remark:$('#remark').val()
            },
            beforeSend:function(){
                $.messager.progress({
                    text:'正在处理中....'
                });
            },
            success:function(data){
                //这样写，订单生成后，可以自动跳转到Alipay支付页面
             $('#showAlipay').html(((data).substr(2)));


                $.messager.progress('close');
                  if(data){
                      $.messager.show({
                          title:'操作提示',
                          msg:'操作成功......'
                      });
                    // location.href="https://openapi.alipaydev.com/gateway.do"
                  }else{
                      alert('添加失败');
                  }
            }
        });
    }
});


/*支付方式字段*/
$('#payment_type').combobox({
    width:120,
    height:28,
    editable:false,
    prompt:'支付宝沙箱支付',
    value:"支付宝沙箱支付",
    data:[
        {
            id:'支付宝沙箱支付',
            text:'支付宝沙箱支付'
        }
    ],
    valueField:'id',
    textField:'text',
    panelHeight:'auto'
});

/*数量字段*/
$('#goods_quantity').numberspinner({
    height:32,
    width:85,
    min: 1,
    max: 100,
    editable: false
});
/*给卖家留言字段*/
$('#remark').textbox({
    width:400,
    prompt:'选填:对本次交易的说明(建议填写已和卖家协商一致的内容)'
});

//点击数量加 计算
$('.spinner-arrow-up').click(function(){
     var unit_price=Number($('#unit_price').val());
     var initial_num=Number($('#unit_price').val()*$('#goods_quantity').val())
     var total=unit_price+initial_num;
    //alert(total);
    //小计字段保留2位小数
     $('.subtotal').html(total.toFixed(2));
    //合计字段
     $('.shop_total_num').html(total.toFixed(2));
    //实付款字段
     $('.payment_number').html(total.toFixed(2));
    //隐藏合计传参字段
     $('#total_price').val(total.toFixed(2));

});
//点击数量 减计算
$('.spinner-arrow-down').click(function(){
    var unit_price=Number($('#unit_price').val());
    var initial_num=Number($('#unit_price').val()*$('#goods_quantity').val())
    if($('#goods_quantity').val()<=1){
        $.messager.alert('操作提示','已经是最低数量了')
    }else{
        var total=initial_num-unit_price;
        //alert(total);
        //小计字段保留2位小数
        $('.subtotal').html(total.toFixed(2));
        //合计字段
        $('.shop_total_num').html(total.toFixed(2));
        //实付款字段
        $('.payment_number').html(total.toFixed(2));
        //隐藏合计传参字段
        $('#total_price').val(total.toFixed(2));
    }

});

/*-------------------------------------------------添加地址字段下方----------------------------*/
//姓名
$('#address_accounts').textbox({
    width:240,
    height:32,
    required:true
});
//电话
$('#address_phone').numberbox({
    width:240,
    height:32,
    required:true,
    validType:'length[11,15]',
});
/*-------------------------------------------------添加地址字段上方----------------------------*/