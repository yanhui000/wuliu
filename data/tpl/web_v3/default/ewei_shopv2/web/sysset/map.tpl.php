<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <title>路线规划</title>
    <style type="text/css">
        html,
        body,
        #container {
            width: 100%;
            height: 100%;
        }
    </style>
    <style type="text/css">
        #panel {
            position: fixed;
            background-color: white;
            max-height: 90%;
            overflow-y: auto;
            top: 10px;
            right: 10px;
            width: 280px;
        }
        #panel .amap-call {
            background-color: #009cf9;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        #panel .amap-lib-driving {
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            overflow: hidden;
        }
    </style>
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />
    <script src="https://a.amap.com/jsapi_demos/static/demo-center/js/demoutils.js"></script>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.15&key=b30a307f25c4eca152ad5cdcd783810d&plugin=AMap.Driving"></script>
    <script type="text/javascript" src="https://cache.amap.com/lbs/static/addToolbar.js"></script>
</head>
<body>
<input type="hidden"  id="origin_second" value=<?php  echo $origin_second?>>
<input type="hidden" id="origin_third" value=<?php  echo $origin_third?>>
<input type="hidden" id="dest_second" value=<?php  echo $dest_second?>>
<input type="hidden" id="dest_third" value=<?php  echo $dest_third?>>
<input type="hidden" id="$strategy" value=<?php  echo $strategy?>>
<div id="container"></div>
<div id="panel"></div>
<script type="text/javascript">

    window.location.href;
    //获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg); //匹配目标参数
        if (r != null) return decodeURI(r[2]); return null; //返回参数值
    }
    var origin_second = getUrlParam('origin_second');
    var origin_third = getUrlParam('origin_third');
    var dest_second = getUrlParam('dest_second');
    var dest_third = getUrlParam('dest_third');
    var strategy = getUrlParam('strategy');
    console.log(strategy);
    if (origin_third == '请选择县') {
        origin_third = ''
    }
    if (dest_third == '请选择县') {
        dest_third = '';
    }
    //基本地图加载
    var map = new AMap.Map("container", {
        resizeEnable: true,
        center: [116.397428, 39.90923],//地图中心点
        zoom: 13 //地图显示的缩放级别
    });
    //构造路线导航类
    //最快捷模式
    if (strategy == 'LEAST_TIME'){
        var driving = new AMap.Driving({
            policy:AMap.DrivingPolicy.LEAST_TIME,
            map: map,
            panel: "panel",
        });
    }else if (strategy == 'LEAST_FEE'){
        var driving = new AMap.Driving({
            policy:AMap.DrivingPolicy.LEAST_FEE,
            map: map,
            panel: "panel",
        });
    }else {
        var driving = new AMap.Driving({
            policy:AMap.DrivingPolicy.LEAST_DISTANCE,
            map: map,
            panel: "panel",
        });
    }

    // 根据起终点名称规划驾车导航路线
    driving.search([
        {keyword: origin_third,city:origin_second},
        {keyword: dest_third,city:dest_second}
    ], function(status, result) {
        // result 即是对应的驾车导航信息，相关数据结构文档请参考  https://lbs.amap.com/api/javascript-api/reference/route-search#m_DrivingResult
        if (status === 'complete') {
            log.success('绘制驾车路线完成')
        } else {
            log.error('获取驾车数据失败：' + result)
        }
    });
</script>
</body>
</html>