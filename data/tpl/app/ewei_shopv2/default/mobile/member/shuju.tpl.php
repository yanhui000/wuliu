<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <script type="text/javascript">
        
        document.addEventListener('plusready', function(){
            //console.log("所有plus api都应该在此事件发生后调用，否则会出现plus is undefined。"
            
        });
    </script>
   <link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/static/js/dist/foxui/css/foxui.min.css?v=0.2">
    <link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/style.css?v=3.0.0">
     <link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/static/fonts/iconfont.css?v=2017070719">
    <script src="./resource/js/lib/jquery-1.11.1.min.js"></script>
     <script type="text/javascript" src="../addons/ewei_shopv2/static/js/dist/foxui/js/foxui.min.js"></script>
    <script type="text/javascript" src="../addons/ewei_shopv2/template/mobile/default/static/js/echarts.min.js"></script>
<link rel="stylesheet" type="text/css" href="../addons/ewei_shopv2/template/mobile/default/static/css/calendar.css">
<script type="text/javascript">
    $(function(){
        $(".shoutable tr:odd").css("background-color","#fff");
        $(".shoutable tr:even").css("background-color","#F8F8F8");
        var $lis=$(".pingUl li");
        $lis.click(function(){
            $(this).addClass("cur").siblings().removeClass("cur");
            var index=$lis.index(this);
            console.log(index);
            $(".qiehuan section").eq(index).show().siblings().hide();
        });
        var $lis2=$(".pingUl2 li");
        $lis2.click(function(){
            $(this).addClass("cur2").siblings().removeClass("cur2");
            var index=$lis2.index(this);
            console.log(index);
            $(".qiehuan2 article").eq(index).show().siblings().hide();
        });
    })
</script>
<style>
    .fui-header{ background-color: #fff!important; }
    .fui-header a.back:before{ border-color: #FA871D!important }
    .fui-header .title{ color: #000!important }
    .fui-cell-group .fui-cell .fui-cell-icon{
        width: auto;
    }
    .fui-cell-group .fui-cell .fui-cell-icon img{
        width: 2rem;
        height: 2rem;
    }
    .fui-cell-group .fui-cell.no-border{
        padding-top: 0;
    }
    .fui-cell-group .fui-cell.no-border .fui-cell-info{
        font-size: .6rem;
        color: #999;
    }
    .fui-cell-group .fui-cell.applyradio  .fui-cell-info{
        line-height: normal;
    }
    .shujuTop{ overflow: hidden; background-color: #fff; padding: .6rem 0;margin-bottom: .5rem }
    .shujudate{ overflow: hidden; background-color: #fff; padding: .6rem 0; margin-top: .5rem }
    .biaoti{font-weight: bold; font-size: .75rem; padding: 0 .4rem; margin: .4rem 0 .8rem}
    .fapiao{ overflow: hidden; width: 100%; margin: .4rem 0 .8rem; padding: 0 1rem }
    .fapiaos{ float: left; width: 50%; text-align: center; }
    .p1{font-weight: bold; font-size: 1rem}
    .p2{ color: #939393; font-size: .65rem }
    .tianshu{ overflow: hidden; margin: .4rem 0 .8rem}
    .tianshu li{ list-style: none; float: left; width: 50%; text-align: right; overflow: hidden; }
    .tianshu p{ width: 3rem; text-align: center; border-radius: .6rem; border:1px solid #979797; padding: .1rem; margin: 0 .4rem }
    .tianshu p.moren{  border:1px solid #FF5C01; background-color: #FF5C01; color: #fff }
    .shijian{ overflow: hidden;margin: .4rem 0 .8rem }
    .shijians{ width: 40%; float: left; overflow: hidden;}
    .shijians .room{ width: 48%; display: inline-block; border: none; color: #333 }
    .shijian2{ width: 20%; float: left; text-align: center; }
</style>

</head>
<body style="background-color: #0E1726">
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">数据统计</div>
        <div class="fui-header-right"></div>
    </div>
    <div class='fui-content'>
        <div class="shujuTop">
            <p class="biaoti">数据概览</p>
            <div class="fapiao">
                <div class="fapiaos">
                    <p class="p1">0</p>
                    <p class="p2">发货量/票</p>
                </div>
                <div class="fapiaos">
                    <p class="p1">0</p>
                    <p class="p2">成单量/票</p>
                </div>
            </div>
            <ul class="tianshu">
                <li><p style="float: right;" class="moren">近7天</p></li>
                <li><p style="float: left;">近30天</p></li>
            </ul>
            <div class="shijian">
                <div class="shijians"><input type="text" id='ktime' name='ktime' value="2019-09-07" placeholder="请选择挂团日期"  class="room"/ style="margin-left: 42%"><span class="icon icon-unfold" style="width: 10%; display: inline-block;"></span></div>
                <div class="shijian2">到</div>
                <div class="shijians"><input type="text" id='ktime' name='ktime' value="2019-09-13" placeholder="请选择挂团日期"  class="room"/><span class="icon icon-unfold" style="width: 10%; display: inline-block;"></span></div>
            </div>   
        </div>
        <div class="shujuTop">
            <p class="biaoti">发货量:0票</p>
            <div id="main" style="width: 100%; height: 300px; background-color: #fff"></div>
        </div>
        <div class="shujuTop">
            <p class="biaoti">成单量:0票</p>
            <div id="main2" style="width: 100%; height: 300px; background-color: #fff"></div>
        </div>
        <div class="shujudate">
            <style type="text/css">
                .shoutable{ background-color: #fff; width: 100%;border-collapse: collapse; }
                .shoutable tr{ /*border-bottom: 1px solid #ccc;*/ background-color: #F8F8F8 }
                .shoutable td{ padding:.6rem .8rem; font-size: .7rem;  font-weight: bold; width: 33%; text-align: center;}
                .ri{text-align: right!important;}
                .le{ text-align: left!important; }
            </style>
            <p class="biaoti">数据详情</p>
            <table class="shoutable">
                <tr>
                    <td class="le" style="color: #939393;">日期</td>
                    <td style="color: #939393;">发货量</td>
                    <td class="ri" style="color: #939393;">成交量</td>
                </tr>
                <tr>
                    <td class="le">09-12</td>
                    <td>0</td>
                    <td class="ri">0</td>
                </tr>
                <tr>
                    <td class="le">09-13</td>
                    <td>0</td>
                    <td class="ri">0</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));
    var myChart2 = echarts.init(document.getElementById('main2'));
    option = {
        // tooltip: {
        //     trigger: 'axis'
        // },
        grid: {
            top:'3%',
            left: '3%',
            right: '5%',
            bottom: '3%',
            containLabel: true
        },
        tooltip : {
            trigger: 'axis',
            backgroundColor:'#FF7F4E',
            default: 'normal' ,
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#FF7F4E'
                }
            }
        },
        color:'#FF7F4E',
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['09.21','09.22','09.23','09.24','09.25','09.26','09.27']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'当日发货',
                type:'line',
                stack: '总量',
                data:[120, 132, 101, 134, 90, 230, 210]
            },
        ]
    };
    option2 = {
        grid: {
            top:'3%',
            left: '3%',
            right: '5%',
            bottom: '3%',
            containLabel: true
        },
        tooltip : {
            trigger: 'axis',
            backgroundColor:'#FF7F4E',
            default: 'normal' ,
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#FF7F4E'
                }
            }
        },
        color:'#FF7F4E',
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['09.21','09.22','09.23','09.24','09.25','09.26','09.27']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'当日成单',
                type:'line',
                stack: '总量',
                data:[0, 0, 0, 0, 0, 0, 0]
            },
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    myChart2.setOption(option2);
</script>
<script src="../addons/ewei_shopv2/template/mobile/default/static/js/calendar.js"></script>
<script>
    $('.room').datePicker({
        okFunc: function (date) {
            console.log(date);
        }
    });
</script>
</body>
</html>
<!-- <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?> -->
<!--913702023503242914-->