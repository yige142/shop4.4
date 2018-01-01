/**
 * Created by Administrator on 2017/11/5.
 */
/*---------------------------------定义增加商品名称字段下方-----------------------------*/
var goodsAdd=$('#goods_add'),
    goodsAddSN=$('#goods_add_sn'),
    goodsAddName=$('#goods_add_name'),
    goodsCarriage=$('#goods_carriage'),
    goodsShopPrice=$('#goods_shop_price'),
    goodsStock=$('#goods_stork'),
    goodsUnit=$('#unit'),
    goodsInfo=$('#goods_info'),
    goodsClassify=$('#goods_classify'),
    goodsStatus=$('#goods_status'),
    goodsRecommend=$('#goods_recommend'),
    goodsCompetitive=$('#goods_competitive'),
    goodsNewProduct=$('#goods_new_product'),
    goodsHotCakes=$('#goods_hot_cakes'),
    goodsDescribe=$('#goods_describe'),
    goods=$('#goods'),

/*---------------------------------定义增加商品名称字段上方-----------------------------*/

/*---------------------------------定义修改商品名称字段下方-----------------------------*/
    goodsEdit=$('#goods_edit'),
    goodsEditSn=$('#goods_edit_sn'),
    goodsEditName=$('#goods_edit_name'),
    editCarriage=$('#edit_carriage'),
    editShopPrice=$('#edit_shop_price'),
    editStock=$('#goods_edit_stork'),
    editUnit=$('#edit_unit'),
    editInfo=$('#goods_edit_info'),
    goodsEditClassify=$('#goods_edit_classify'),
    goodsEditStatus=$('#goods_edit_status'),
    goodsEditRecommend=$('#goods_edit_recommend'),
    goodsEditCompetitive=$('#goods_edit_competitive'),
    editNewProduct=$('#edit_new_product'),
    editHotCakes=$('#edit_hot_cakes'),
    editDescribe=$('#goods_edit_describe'),
    goodsOpt;
/*---------------------------------定义修改商品名称字段上方-----------------------------*/


/*---------------------------------增加商品功能区域下方---------------------------------*/
//商品表格数据列表显示
goods.datagrid({
    url:ThinkPhP['MODULE'] + '/Goods/getList',
    fit : true,
    fitColumns : true,
    rownumbers : true,
    border : false,
    sortName : 'create_time',
    sortOrder : 'DESC',
    toolbar : '#goods-tool',
    pagination : true,
    pageSize : 20,
    pageList : [10, 20, 30, 40, 50],
    pageNumber : 1,
    columns:[[
        {
            field:'goodsId',
            title:'自动编号',
            width:100,
            hidden:true
            //checkbox:true
        },
        {
            field:'checkbox',
            title:'checkbox',
            width:120,
            checkbox:true
        },
        {
            field:'goods_name',
            title:'商品名称',
            width:120,
            //checkbox:true
        },
        {
            field:'goods_info',
            title:'商品介绍',
            width:100,
            hidden:true
        },
        {
            field:'goods_sn',
            title:'商品编号',
            width:100,
        },
        {
            field:'shop_price',
            title:'价格',
            width:100,
        },
        {
            field:'goods_status',
            title:'商品状态',
            width:100,
            //formatter单元格格式函数，state返回单元格中的value'是'，‘否’值
            formatter:function(value,row){
                var state='';
                switch (value){
                    case '上架':
                        state='<a href="javascript:void(0)"goods-id="'+ row.goodsId+'" goods_status="上架" class="goods-status goods-status-1" style="height:18px;"></a>'
                        break
                    case '下架':
                        state='<a herf="javascript:void(0)" goods-id="'+row.goodsId+'" goods_status="下架" class="goods-status goods-status-2" style="height:18px;"></a>'
                        break
                }
                return state;
            }
        },
        {
            field:'goods_recommend',
            title:'推荐',
            width:100,
            //formatter单元格格式函数，state返回单元格中的value'是'，‘否’值
            formatter:function(value,row){
                var state='';
                switch (value){
                    case '是':
                        state='<a href="javascript:void(0)"goods-id="'+ row.goodsId+'" goods_state="是" class="goods-recommend goods-recommend-1" style="height:18px;"></a>'
                        break
                    case '否':
                        state='<a herf="javascript:void(0)" goods-id="'+row.goodsId+'" goods_state="否" class="goods-recommend goods-recommend-2" style="height:18px;"></a>'
                        break
                }
                return state;
            }
        },
        {
            field:'goods_competitive',
            title:'精品',
            width:100,
            //formatter单元格格式函数，state返回单元格中的value'是'，‘否’值
            formatter:function(value,row){
                var state='';
                switch (value){
                    case '是':
                        state='<a href="javascript:void(0)"goods-id="'+ row.goodsId+'" goods_competitive="是" class="goods_competitive goods_competitive-1" style="height:18px;"></a>'
                        break
                    case '否':
                        state='<a herf="javascript:void(0)" goods-id="'+row.goodsId+'" goods_competitive="否" class="goods_competitive goods_competitive-2" style="height:18px;"></a>'
                        break
                }
                return state;
            }
        },
        {
            field:'new_product',
            title:'新品',
            width:100,
            //formatter单元格格式函数，state返回单元格中的value'是'，‘否’值
            formatter:function(value,row){
                var state='';
                switch (value){
                    case '是':
                        state='<a href="javascript:void(0)"goods-id="'+ row.goodsId+'" new_product="是" class="new_product new_product-1" style="height:18px;"></a>'
                        break
                    case '否':
                        state='<a herf="javascript:void(0)" goods-id="'+row.goodsId+'" new_product="否" class="new_product new_product-2" style="height:18px;"></a>'
                        break
                }
                return state;
            }
        },
        {
            field:'hot_cakes',
            title:'热销',
            width:100,
            //formatter单元格格式函数，state返回单元格中的value'是'，‘否’值
            formatter:function(value,row){
                var state='';
                switch (value){
                    case '是':
                        state='<a href="javascript:void(0)"goods-id="'+ row.goodsId+'" hot_cakes="是" class="hot_cakes hot_cakes-1" style="height:18px;"></a>'
                        break
                    case '否':
                        state='<a herf="javascript:void(0)" goods-id="'+row.goodsId+'" hot_cakes="否" class="hot_cakes hot_cakes-2" style="height:18px;"></a>'
                        break
                }
                return state;
            }
        },
        {
            field:'opt',
            title:'销量',
            width:100,
            hidden:true
        },
        {
            field:'goods_stock',
            title:'库存',
            width:100,
        },
        {
            field:'thumb_path',
            title:'缩略图地址',
            width:100,
            hidden:true
        },
        {
            field:'opt2',
            title:'详情',
            width:100,
            formatter:function(value,row)
            {
            return '<a href="'+ThinkPhP['MODULE']+'/Goods/goods_detail?id='+row.goodsId+'" class="goods-describe" style="height: 18px;margin-left: 2px;" onclick="" target="_blank"></a>';
               // return '<a href="javascript:viod(0)" class="goods-describe" style="height: 18px;margin-left: 2px;" onclick="goodsOpt.detail('+row.goodsId+')" target="_blank"></a>';
              //  return "'<a href="{:U('Goods/goods_detail')}" class="goods-describe" style="height: 18px;margin-left: 2px;" onclick="" target="_blank"></a>'";
            }
        },
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

    onLoadSuccess:function() {
        //图标默认展开一行带图片
        goods.datagrid("expandRow",0);
        /*--上架下方--*/
        $('.goods-status-1').linkbutton({
            iconCls: 'icon-ok',
            plain: true
        });
        $('.goods-status-2').linkbutton({
            iconCls: 'icon-cancel',
            plain: true
        });
        $('.goods-status').click(function () {
            var id    =$(this).attr('goods-id'),
                state =$(this).attr('goods_status');
            switch (state){
                case '上架':
                    $.messager.confirm('确认','确定商品下架？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/down',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'下架'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'商品下架成功！'
                                        });
                                    }else{
                                        $.messager.alert('操作失败','未知原因','warning');
                                    }
                                }
                            });
                        }
                    });
                    break;
                case'下架':
                    $.messager.confirm('确认','确定商品上架？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/down',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'上架'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'设置商品上架成功！'
                                        });
                                    }else{
                                        $.messager.alert('操作失败','未知原因','warning');
                                    }
                                }
                            });
                        }
                    });
                    break
            }
        });
        /*--上架上方--*/
        /*--推荐图标下方---*/
        $('.goods-recommend-1').linkbutton({
            iconCls: 'icon-ok',
            plain: true
        });
        $('.goods-recommend-2').linkbutton({
            iconCls: 'icon-cancel',
            plain: true
        });
        $('.goods-recommend').click(function () {
            var id    =$(this).attr('goods-id'),
                state =$(this).attr('goods_state');
            switch (state){
                case '是':
                    $.messager.confirm('确认','确定取消商品推荐？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/recommend',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'否'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'取消商品推荐成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break;
                case'否':
                    $.messager.confirm('确认','确定设置为商品推荐？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/recommend',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'是'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'设置商品推荐成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break
            }
        });
        /*--精品图标上方---*/

        /*--精品图标下方---*/
        $('.goods_competitive-1').linkbutton({
            iconCls: 'icon-ok',
            plain: true
        });
        $('.goods_competitive-2').linkbutton({
            iconCls: 'icon-cancel',
            plain: true
        });
        $('.goods_competitive').click(function () {
            var id    =$(this).attr('goods-id'),
                state =$(this).attr('goods_competitive');
            switch (state){
                case '是':
                    $.messager.confirm('确认','确定取消精品设置？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/competitive',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'否'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'取消精品设置成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break;
                case'否':
                    $.messager.confirm('确认','确定设置为精品？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/competitive',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'是'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'设置精品成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break
            }
        });
        /*--推荐图标上方---*/
        /*--新品图标下方---*/
        $('.new_product-1').linkbutton({
            iconCls: 'icon-ok',
            plain: true
        });
        $('.new_product-2').linkbutton({
            iconCls: 'icon-cancel',
            plain: true
        });
        $('.new_product').click(function () {
            var id    =$(this).attr('goods-id'),
                state =$(this).attr('new_product');
            switch (state){
                case '是':
                    $.messager.confirm('确认','确定取消新品设置？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/new_product',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'否'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'取消新品设置成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break;
                case'否':
                    $.messager.confirm('确认','确定设置为新？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/new_product',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'是'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'设置新品成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break
            }
        });
        /*--新品图标上方---*/
        /*--热销图标下方---*/
        $('.hot_cakes-1').linkbutton({
            iconCls: 'icon-ok',
            plain: true
        });
        $('.hot_cakes-2').linkbutton({
            iconCls: 'icon-cancel',
            plain: true
        });
        $('.hot_cakes').click(function () {
            var id    =$(this).attr('goods-id'),
                state =$(this).attr('hot_cakes');
            switch (state){
                case '是':
                    $.messager.confirm('确认','确定取消热销设置？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/hot_cakes',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'否'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'取消热销设置成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break;
                case'否':
                    $.messager.confirm('确认','确定设置为热销？',function(flag){
                        if(flag){
                            $.ajax({
                                url:ThinkPhP['MODULE'] + '/Goods/hot_cakes',
                                type:'POST',
                                data:{
                                    id:id,
                                    state:'是'
                                },
                                beforeSend:function(){
                                    goods.datagrid('loading');
                                },
                                success:function(data){
                                    goods.datagrid('loaded');
                                    if(data>0){
                                        goods.datagrid('reload');
                                        $.messager.show({
                                            title:'操作提醒',
                                            msg:'设置热销成功！'
                                        });
                                    }else{
                                        $.messager.alert('取消失败','未知原因导致冻结失败','warning');
                                    }
                                }
                            });
                        }
                    });
                    break
            }
        });
        /*--热销图标上方---*/
        //详情图标
        $('.goods-describe').linkbutton({
            iconCls : 'icon-details',
            plain : true
        });
    }
});

//新增商品面板
goodsAdd.dialog({
    title:'新增商品',
    width:'750',
    height:'780',
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
                if(goodsAdd.form('validate')){
                  GOODS_ADD.sync();//同步Kid编辑器
                    $.ajax({
                        url:ThinkPhP['MODULE'] + '/Goods/register',
                        type:'POST',
                        data:{
                            goods_name:goodsAddName.textbox('getValue'),
                            goods_sn:goodsAddSN.textbox('getValue'),
                            carriage:goodsCarriage.numberbox('getValue'),
                            shop_price:goodsShopPrice.numberbox('getValue'),
                            goods_stock:goodsStock.numberbox('getValue'),
                            goods_unit:goodsUnit.textbox('getValue'),
                            goods_info: $.trim(goodsInfo.val()),
                            goods_classify:goodsClassify.combobox('getValue'),
                            goods_status:goodsStatus.combobox('getValue'),
                            goods_recommend:goodsRecommend.combobox('getValue'),
                            goods_competitive:goodsCompetitive.combobox('getValue'),
                            new_product:goodsNewProduct.combobox('getValue'),
                            hot_cakes:goodsHotCakes.combobox('getValue'),
                            img_path:$('#image_path').val(),
                            thumb_path:$('#thumb_path').val(),
                            goods_describe:$('#goods_describe').val()
                        },
                        beforeSend:function(){
                            $.messager.progress({
                                text:'正在处理中....'
                            });
                        },
                        success:function(data){
                            $.messager.progress('close');
                            if(data>0){
                                $.messager.show({
                                    title:'操作提示',
                                    msg:'添加成功'
                                });
                                $('#img').attr('src',ThinkPhP['IMG']+'/default.png');
                                goodsAdd.dialog('close');
                                goods.datagrid('load');
                            }
                        }
                    });

                }else{
                    $.messager.alert('操作提示','表单数据未填写完整验证未通过','warning');
                }
            }
        },{
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                goodsAdd.dialog('close');
            }
        }
    ],
    onOpen:function(){
        GOODS_ADD.html('');
    },
    onClose:function(){
        goodsAdd.form('reset');
        goodsAdd.dialog('center');
        GOODS_ADD.html('');
    }
});

//工具栏操作
goodsOpt={
    add:function(){
        goodsAdd.dialog('open');
        //uploadify上传
        $('#file').uploadify({
            swf:ThinkPhP['UPLOADIFY'] + '/uploadify.swf',
            uploader : ThinkPhP['MODULE'] + '/Goods/uploadify' ,
            //buttonClass : 'some-class',
            buttonText:'上传图片',
            width:100,
            height:25,
            //multi: false上传图片只允许单选，true允许多选
            multi: false,
            fileTypeDesc:'图片类型',
            fileTypeExts:'*.jpeg;*.jpg;*.png;*.gif',
            onUploadSuccess:function(fiel,data,response){
                //jQuery.parseJSON(data) 解析PHP那边传过来的Json数据
                var parsedData = jQuery.parseJSON(data);
                $('#img').attr('src',ThinkPhP['ROOT']+'/Uploads/'+ parsedData.imgPath);
                $('#image_path').val(parsedData.imgPath);
                $('#thumb_path').val(parsedData.thumbPath);
                //alert(ThinkPhP['ROOT']+'/Uploads/'+parsedData.thumbPath);

            },
        });
    },
    //编辑修改
    edit:function(){
        var rows=goods.datagrid('getSelections');
        if(rows.length ==1){
            goodsEdit.dialog('open');
            $('#edit_file').uploadify({
                swf:ThinkPhP['UPLOADIFY'] + '/uploadify.swf',
                uploader : ThinkPhP['MODULE'] + '/Goods/uploadify' ,
                //buttonClass : 'some-class',
                buttonText:'上传图片',
                width:100,
                height:25,
                //multi: false上传图片只允许单选，true允许多选
                multi: false,
                fileTypeDesc:'图片类型',
                fileTypeExts:'*.jpeg;*.jpg;*.png;*.gif',
                onUploadSuccess:function(fiel,data,response){
                    //jQuery.parseJSON(data) 解析PHP那边传过来的Json数据
                    var parsedData = jQuery.parseJSON(data);
                    $('#edit_img').attr('src',ThinkPhP['ROOT']+'/Uploads/'+ parsedData.imgPath);
                    $('#image_edit_path').val(parsedData.imgPath);
                    $('#thumb_edit_path').val(parsedData.thumbPath);
                    alert(ThinkPhP['ROOT']+'/Uploads/'+parsedData.thumbPath);

                },
            });
            $.ajax({
                url:ThinkPhP['MODULE'] +'/Goods/getOne',
                type:'POST',
                data:{
                    id:rows[0].goodsId
                },
                beforeSend: function () {
                    $.messager.progress({
                        text:'正在处理中...'
                    });
                },
                success:function(data){
                    $.messager.progress('close');
                    if(data){
                        goodsEdit.form('load',{
                            goodsId:data.goodsId,
                            goods_name:data.goods_name,
                            goods_sn:data.goods_sn,
                            carriage:data.carriage,
                            shop_price:data.shop_price,
                            goods_stock:data.goods_stock,
                            goods_unit:data.goods_unit,
                            goods_info:data.goods_info,
                            goods_classify:data.goods_classify,
                            goods_status:data.goods_status,
                            goods_recommend:data.goods_recommend,
                            goods_competitive:data.goods_competitive,
                            new_product:data.new_product,
                            hot_cakes:data.hot_cakes,
                            img_path:data.img_path,
                            thumb_path:data.thumb_path
                        });
                        GOODS_EDIT.html(data.goods_describe);  //kindidtor编辑器加载获取到数据内容
                        $('#edit_img').attr('src',ThinkPhP['ROOT']+'/Uploads/'+ data.img_path)
                    }else{
                        $.messager.alert('操作警告','没有获得相应数据','warning');
                    }
                }
            });
        }else{
            $.messager.alert('操作警告','请先选择一条数据','warning');
        }
    },
    //删除数据
    remove:function(){
        var rows=goods.datagrid('getSelections');
        if(rows.length >0){
            $.messager.confirm('确认操作','您真的要删除所选的<strong>'+ rows.length+'</strong>条记录吗',function(flag){
                if(flag){
                    var ids=[];
                    for(var i=0;i<rows.length;i++){
                        ids.push(rows[i].goodsId);
                    }
                    $.ajax({
                        url:ThinkPhP['MODULE'] + '/Goods/remove',
                        type:'POST',
                        data:{
                            ids:ids.join(',') //join 返回一个字符串。该字符串是通过把 arrayObject 的每个元素转换为字符串，然后把这些字符串连接起来
                        },
                        beforeSend:function(){
                            $.messager.progress({
                                text:'正在处理中....'
                            });
                        },
                        success:function(data){
                            $.messager.progress('close');
                            if(data){
                                goods.datagrid('reload');
                                $.messager.show({
                                    title:'操作提醒',
                                    msg:data+'条数据被删除成功'
                                });
                            }else{
                                $.messager.alert('删除失败','没有删除任何数据','warning');
                            }
                        }
                    });
                }else{
                    $.messager.alert('操作警告','删除记录需选择一条或一条以上的数据','warning');
                }
            });
        }
    },
    //取消操作
    redo:function(){
        goods.datagrid('unselectAll');
    },
    //刷新

    reload:function(){
        goods.datagrid('reload');
    },
    search:function(){
        goods.datagrid('load',{
            keywords: $.trim($('#goods-search-keywords').textbox('getValue')),
            goods_type:$('#goods-search-type').combobox('getValue')
        });
    },
    reset:function(){
        $('#goods-search-keywords').textbox('clear');
        $('#goods-search-type').combobox('clear');
        this.search();
        goods.datagrid('sort', {
            sortName : 'create_time',
            sortOrder : 'DESC'
        });
    }
}




//搜索关键字
$('#goods-search-keywords').textbox({
    width:180,
    height:25,
    prompt:'商品名称|商品编号|商品信息'
});
//商品状态
$('#goods-search-type').combobox({
    width:85,
    height:25,
    prompt:'商品状态',
    url:ThinkPhP['MODULE']+'/Goods/getList',
    queryParams : {
        goods_search_type : true
    },
    editable:false,
    valueField:'goods_status',
    textField:'goods_status',
    panelHeight:'auto'
});

/*--新增表单字段区域下方--*/
//商品SN字段
    goodsAddSN.textbox({
        width:220,
        height:32,
        required:true
});
//商品名称字段
    goodsAddName.textbox({
        width:220,
        height:32,
        required:true
    });
//商品价格字段
    goodsShopPrice.numberbox({
        width:220,
        height:32,
        precision:2,
        min:0,
        required:true
    });
//商品市场价格
goodsCarriage.numberbox({
        width:220,
        height:32,
        precision:2,
        min:0,
        required:true
    });

//商品库存
    goodsStock.numberbox({
        width:220,
        height:32,
        min:0,
        required:true
    });
//商品单位
    goodsUnit.textbox({
        width:220,
        height:32,
        required:true
    });
//商品分类
    goodsClassify.combobox({
        width:105,
        height:32,
        editable:false,
        //value:'水果',
        data:[
            {
                id:'水果',
                text:'水果'
            },
            {id:'生鲜',
                text:'生鲜'
            }],
        valueField:'id',
        textField:'text',
        panelHeight:'auto',
        required:true
    });
//商品状态
    goodsStatus.combobox({
        width:105,
        height:32,
        editable:false,
        //value:'水果',
        data:[
            {
                id:'上架',
                text:'上架'
            },
            {id:'下架',
                text:'下架'
            }],
        valueField:'id',
        textField:'text',
        panelHeight:'auto',
        required:true
    });
//推荐商品
    goodsRecommend.combobox({
        width:105,
        height:32,
        editable:false,
        //value:'水果',
        data:[
            {
                id:'是',
                text:'是'
            },
            {id:'否',
                text:'否'
            }],
        valueField:'id',
        textField:'text',
        panelHeight:'auto',
        required:true
    });
//设置精品
    goodsCompetitive.combobox({
        width:105,
        height:32,
        editable:false,
        //value:'水果',
        data:[
            {
                id:'是',
                text:'是'
            },
            {id:'否',
                text:'否'
            }],
        valueField:'id',
        textField:'text',
        panelHeight:'auto',
        required:true
    });
//设置新品
    goodsNewProduct.combobox({
        width:105,
        height:32,
        editable:false,
        //value:'水果',
        data:[
            {
                id:'是',
                text:'是'
            },
            {id:'否',
                text:'否'
            }],
        valueField:'id',
        textField:'text',
        panelHeight:'auto',
        required:true
    });
//设置热销
goodsHotCakes.combobox({
    width:105,
    height:32,
    editable:false,
    //value:'水果',
    data:[
        {
            id:'是',
            text:'是'
        },
        {id:'否',
            text:'否'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto',
    required:true
});
//加载新增编辑器
GOODS_ADD = KindEditor.create('#goods_describe', {
    width : '94%',
    height : '250px',
    resizeType : 0,
    items : editor_tool
});

/*--新增表单字段区域上方--*/

/*---------------------------------增加商品功能区域上方---------------------------------*/

/*----------------------------------修改商品功能区域下方--------------------------------*/
//修改表单操作
goodsEdit.dialog({
    title:'修改商品',
    width:'750',
    height:'780',
    iconCls:'icon-edit',
    closed:true,
    modal:true,
    maximizable:true,
    buttons:[
        {
            text:'保存',
            size:'large',
            iconCls:'icon-accept',
            handler:function(){
                if(goodsEdit.form('validate')){
                    GOODS_EDIT.sync();//同步Kid编辑器
                    $.ajax({
                        url:ThinkPhP['MODULE'] + '/Goods/update',
                        type:'POST',
                        data:{
                            id:$('#goodsId').val(),
                            goods_name:goodsEditName.textbox('getValue'),
                            goods_sn:goodsEditSn.textbox('getValue'),
                            carriage:editCarriage.numberbox('getValue'),
                            shop_price:editShopPrice.numberbox('getValue'),
                            goods_stock:editStock.numberbox('getValue'),
                            goods_unit:editUnit.textbox('getValue'),
                            goods_info: $.trim(editInfo.val()),
                            goods_classify:goodsEditClassify.combobox('getValue'),
                            goods_status:goodsEditStatus.combobox('getValue'),
                            goods_recommend:goodsEditRecommend.combobox('getValue'),
                            goods_competitive:goodsEditCompetitive.combobox('getValue'),
                            new_product:editNewProduct.combobox('getValue'),
                            hot_cakes:editHotCakes.combobox('getValue'),
                            img_path:$('#image_edit_path').val(),
                            thumb_path:$('#thumb_edit_path').val(),
                            goods_describe:$('#goods_edit_describe').val()
                        },
                        beforeSend:function(){
                            $.messager.progress({
                                text:'正在处理中....'
                            });
                        },
                        success: function (data) {
                            $.messager.progress('close');
                            if(data>0){
                                $.messager.show({
                                    title:'操作提示',
                                    msg:'修改成功'
                                });
                                goodsEdit.dialog('close');
                                goods.datagrid('load');
                            }else{
                                $.messager.alert('修改失败','没有任何数据被修改','warning')
                            }
                        }
                    });

                }else{
                    $.messager.alert('操作提示','表单数据未填写完整验证未通过','warning');
                }
            }
        },{
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                goodsEdit.dialog('close');
            }
        }
    ],
    onOpen:function(){
        GOODS_EDIT.html('');
    },
    onClose:function(){
        goodsEdit.form('reset');
        goodsEdit.dialog('center');
        GOODS_EDIT.html('');
    }
});



/*--修改表单字段区域下方--*/
//修改商品SN字段
goodsEditSn.textbox({
    width:220,
    height:32,
    required:true
});
//修改商品名称字段
goodsEditName.textbox({
    width:220,
    height:32,
    required:true
});
//修改商品价格字段
editShopPrice.numberbox({
    width:220,
    height:32,
    precision:2,
    min:0,
    required:true
});
//修改商品市场价格
editCarriage.numberbox({
    width:220,
    height:32,
    precision:2,
    min:0,
    required:true
});
//修改商品库存
editStock.numberbox({
    width:220,
    height:32,
    min:0,
    required:true
});
//修改商品单位
editUnit.textbox({
    width:220,
    height:32,
    required:true
});
//修改商品分类
goodsEditClassify.combobox({
    width:105,
    height:32,
    editable:false,
    //value:'水果',
    data:[
        {
            id:'水果',
            text:'水果'
        },
        {id:'生鲜',
            text:'生鲜'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto',
    required:true
});
//修改商品状态
goodsEditStatus.combobox({
    width:105,
    height:32,
    editable:false,
    //value:'水果',
    data:[
        {
            id:'上架',
            text:'上架'
        },
        {id:'下架',
            text:'下架'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto',
    required:true
});
//修改推荐商品
goodsEditRecommend.combobox({
    width:105,
    height:32,
    editable:false,
    //value:'水果',
    data:[
        {
            id:'是',
            text:'是'
        },
        {id:'否',
            text:'否'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto',
    required:true
});
//修改设置精品
goodsEditCompetitive.combobox({
    width:105,
    height:32,
    editable:false,
    //value:'水果',
    data:[
        {
            id:'是',
            text:'是'
        },
        {id:'否',
            text:'否'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto',
    required:true
});
//设置新品
editNewProduct.combobox({
    width:105,
    height:32,
    editable:false,
    //value:'水果',
    data:[
        {
            id:'是',
            text:'是'
        },
        {id:'否',
            text:'否'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto',
    required:true
});
//设置热销
editHotCakes.combobox({
    width:105,
    height:32,
    editable:false,
    //value:'水果',
    data:[
        {
            id:'是',
            text:'是'
        },
        {id:'否',
            text:'否'
        }],
    valueField:'id',
    textField:'text',
    panelHeight:'auto',
    required:true
});
//加载新增编辑器
GOODS_EDIT = KindEditor.create('#goods_edit_describe', {
    width : '94%',
    height : '250px',
    resizeType : 0,
    items : editor_tool
});

/*--修改表单字段区域上方--*/

/*----------------------------------修改商品功能区域上方--------------------------------*/