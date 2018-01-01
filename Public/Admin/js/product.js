/**
 * Created by Administrator on 2017/3/3.
 */
var product=$('#product'),
    productOpt;

//加载数据列表
product.datagrid({
    url:ThinkPhP['MODULE'] + '/Product/getList',
    fit:true,
    fitColumns:true,
    rownumbers:true,
    border:false,
    sortName:'create_time',
    sortOrder:'DESC',
    toolbar:'#product-tool',
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
            field:'product_name',
            title:'产品名称',
            width:'100',

        },
        {
            field:'product_info',
            title:'产品信息',
            width:'100',
        },
        {
            field:'uid',
            title:'用户ID',
            width:'100',
        },
        {
            field:'create_time',
            title:'创建时间',
            width:'150',
        },
        {
            field:'savename',
            title:'保存名称',
            width:'200',
        },
        {
            field:'savepath',
            title:'保存路径',
            width:'200',
        }
    ]]
});

//新增操作
$('#product-add').dialog({
    title:'新增产品信息',
    width:'750',
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

            }
        },
        {
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                $('#product-add').dialog('close');
                $('#product-add').form('clear');
                closeUploader();
            }
        }
    ]
});

//新增Uploadify
$('#product-addUpload').dialog({
    title:'新增Upload',
    width:'750',
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

            }
        },
        {
            text:'取消',
            size:'large',
            iconCls:'icon-cross',
            handler:function(){
                $('#product-addUpload').dialog('close');
                $('#product-addUpload').form('clear');

            }
        }
    ]
});

//工具条操作
productOpt={
    add:function(){
        $('#product-add').dialog('open');
        //加上下面那句是为了解决点击“选择图片”但页面不弹出选择图片功能,把页面那边的初始化webuploader放到base加载,这里调用,product页面那端禁止也可以
            loadWebUploader();

    },
    addupl:function(){
        $('#product-addUpload').dialog('open');
        //$('#file').uploadify({
        //    swf:ThinkPhP['UPLOADIFY'] + '/uploadify.swf',
        //    uploader:ThinkPhP['UPLOADER'] ,
        //    buttonClass : 'some-class',
        //    width:100,
        //    height:25,
        //    fileTypeDesc:'图片类型',
        //    fileTypeExts:'*.jpeg;*.jpg;*.png;*.gif',
        //    onUploadSuccess:function(fiel,data,response){
        //        // alert('file'+file);
        //        //alert('data数据'+data);
        //        //$('.form-table').append('<div class="weibo_pic_content"><img src="' + data + '" class="weibo_pic_img">');
        //        //alert('response数据'+response);
        //        //console.log(file);
        //        //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
        //        $('#image').attr('src','/Public/images/130_'+data);
        //        $('#pic').val(data);
        //    },
        //    //onUploadComplete : function(file) {
        //    //    alert('The file ' + file.name + ' finished processing.');
        //    //}
        //});

        //测试TP  +Uploadify上传
        $('#file').uploadify({
            swf:ThinkPhP['UPLOADIFY'] + '/uploadify.swf',
            uploader : ThinkPhP['MODULE'] + '/Product/uploadify' ,
            buttonClass : 'some-class',
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
                $('#images').val(parsedData.imgPath);
                alert(ThinkPhP['ROOT']+'/Uploads/'+parsedData.thumbPath);

                //alert(data);
                //
                //alert(parsedJson.thumbPath);
            },
            //onUploadComplete : function(file) {
            //    alert('The file ' + file.name + ' finished processing.');
            //}
        });
    }

}