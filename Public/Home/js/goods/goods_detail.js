/**
 * Created by Administrator on 2017/11/12.
 */

/*切换商品评论，商品详情  and 购买数量样式*/
$('.goods-Review-area').hide();
$("#goods_comment li").click(function() {

    $(this).siblings('li').removeClass('active');  // 删除其他兄弟元素的样式

    $(this).addClass('active');                            // 添加当前元素的样式
    if($(this).val()==1){
        $('.goods-info-area').hide();
        $('.goods-Review-area').show();
    }else if($(this).val()==0){
        $('.goods-info-area').show();
        $('.goods-Review-area').hide();
    }
});

$('#quantity').numberspinner({
    value:1,
    height:32,
    width:125,
    min: 1,
    max: 100,
    editable: false
});

//跳转商品订单验证页
$('#buy_button').click(function(){
    location.href=ThinkPhP['MODULE'] + '/Order/check_order_info?id='+$('#goods_detail_goods_id').val()+'&number='+$('#quantity').val();

});