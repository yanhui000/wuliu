<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <title>里程计算</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=1">
    <meta name="renderer" content="webkit">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="format-detection" content="telephone=no">
    <script ymm="1">function makeFontSize() {
        if (0 == docEl.clientWidth) return void setTimeout(makeFontSize, 5);
        var e = docEl.clientWidth > 560 ? 560 : docEl.clientWidth;
        rem = e * dpr / 10,
        scale = 1 / dpr,
        docEl.setAttribute("data-dpr", dpr),
        docEl.firstElementChild.appendChild(fontEl),
        fontEl.innerHTML = "html{font-size:" + rem / dpr + "px!important;overflow-x: hidden;}"
      }
      var dpr, rem, scale, docEl = document.documentElement,
      fontEl = document.createElement("style"),
      metaEl = document.querySelector('meta[name="viewport"]');
      dpr = window.devicePixelRatio || 1,
      makeFontSize()</script>
    <style>body,html{padding:0;margin:0}.pre-loading-wrapper{position:relative;margin:200px auto 0;width:50px;height:50px}.pre-loading-wrapper .loading-item{position:absolute;left:0;top:0;width:100%;height:100%;border-radius:50%;opacity:.6;background-color:#fc8700;-webkit-animation:loading-bounce 2s infinite ease-in-out;animation:loading-bounce 2s infinite ease-in-out}.pre-loading-wrapper .loading-item-2{-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes loading-bounce{0%,100%{-webkit-transform:scale(0);transform:scale(0)}50%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes loading-bounce{0%,100%{-webkit-transform:scale(0);transform:scale(0)}50%{-webkit-transform:scale(1);transform:scale(1)}}</style>
    <link href="static/css/app.1e8e633.css" rel="stylesheet"></head>
  
  <body>
  	
    <div id="app" class="app">
    	
      <div class="pre-loading-wrapper">
        <div class="loading-item loading-item-1"></div>
        <div class="loading-item loading-item-2"></div>
        <div class="loading-item loading-item-3"></div>
      </div>
    </div>
    <script ymm="1">window.loadingStartTime = new Date - 0</script>
    <script ymm="1" src="static/js/index.min.js"></script>
    <script ymm="1" src="static/js/area.normalized.min.js"></script>
    <script ymm="1" src="static/js/polyfill.min.js"></script>
    <script ymm="1" src="static/js/vue.runtime.min.js"></script>
    <script ymm="1" src="static/js/vue-router.min.js"></script>
    <script ymm="1" src="static/js/vuex.min.js"></script>
    <script ymm="1" type="text/javascript" src="static/js/manifest.f117221.js"></script>
    <script ymm="1" type="text/javascript" src="static/js/vendor.9549a55.js"></script>
    <script ymm="1" type="text/javascript" src="static/js/app.3e660ba.js"></script>
  </body>
  <script ymm="1" src="static/js/raven.min.js"></script>
  <script ymm="1">Raven.config("https://79ca6ce894694288969eff82fc7ab09e@sentry.ymm56.com/4", {
      release: "1.0.6"
    }).install()</script>

</html>