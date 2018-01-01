<?php if (!defined('THINK_PATH')) exit();?><!--Firefox火狐浏览器渲染遮罩专用-->
<div class="tabs-loading">Loading...</div>
<link rel="stylesheet" type="text/css" href="/shop4.4/Public/Admin/css/goods/goods.css" />
<link rel="stylesheet" type="text/css" href="/shop4.4/Public/webuploader/0.1.5/webuploader.css" />


<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="main" style="width: auto;height:600px;"></div>



<script type="text/javascript">

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

        var a=  $('#test').val();
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [a, 20, 36, 10, 10, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);

</script>

<script type="text/javascript" src="/shop4.4/Public/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="/shop4.4/Public/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="/shop4.4/Public/Admin/js/goods/datagrid-detailview.js"></script>
<script type="text/javascript" src="/shop4.4/Public/uploadify/jquery.uploadify.js"></script>

<!--<script type="text/javascript" src="/shop4.4/Public/Admin/js/goods/goods_edit.js"></script>-->