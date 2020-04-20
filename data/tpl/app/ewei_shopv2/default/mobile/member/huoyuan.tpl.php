<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
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
    .container {
    height: 100%;
    width: 100%;
    position: fixed;
    background-color: #999;
    opacity: 0.5;
     display: none; 
    z-index: 10;
}
</style>
<script type="text/javascript">
    $(function(){
        $('.dian1').click(function(){
            $('.zhxie').show();
            $('.container').show();
        });
        $('.dian2').click(function(){
            $('.chexingdiv').show();
            $('.container').show();
        });
        $('.dian3').click(function(){
            $('.xinxi').show();
            $('.container').show();
        });
        $('.dian4').click(function(){
            $('.fuwu').show();
            $('.container').show();
        });
        $('.container').click(function(){
            $('.chexingdiv').hide();
            $('.zhxie').hide();
            $('.xinxi').hide();
            $('.fuwu').hide();
            $(this).hide();
        });
        $('.quxiao').click(function(){
            $('.zhxie').hide();
            $('.chexingdiv').hide();
             $('.xinxi').hide();
             $('.fuwu').hide();
            $('.container').hide();
        });
        $('.quren').click(function(){
             $('.zhxie').hide();
            $('.container').hide();
            var a=$('input[name="zhizhao"]:checked').val();
            $('.dian1').val(a);
        });
        $('.quren2').click(function(){
            var a=$('input[name="yongche"]:checked').val()+',';
            var obj = $("input[name='chechang']");
            var s='';
            for(var i=0;i<obj.length;i++){
                if(obj[i].checked)
                    s +=obj[i].value+'米,';
            }
            var obj2 = $("input[name='chexing']");
            var s2='';
            for(var i=0;i<obj2.length;i++){
                if(obj2[i].checked)
                    s2 +=obj2[i].value+',';
            }
            var lastIndex = s2.lastIndexOf(',');
            if (lastIndex > -1) {
               s2 = s2.substring(0, lastIndex) + s2.substring(lastIndex + 1, s2.length);
            }
            if ($("input[name='chechang']:checked").length==0) {
        　　      FoxUI.toast.show('请选择车长');
                return
            }
            if ($("input[name='chexing']:checked").length==0) {
        　　      FoxUI.toast.show('请选择车型');
                return
            }
            var b=$('.zhanchechang').val();
            var c='占'+b+'米,';
            if(b==''||b==0)
            {
                c='';
            }
             console.log(a,s,c,s2);
             var zhi=a+s+c+s2;
           $('.dian2').val(zhi);
            $('.chexingdiv').hide();
            $('.container').hide();



            // $('.dian1').val(a);
        });
        var cb1 = $('[name="chechang"]');
        cb1.change(function () {
        if (this.checked && cb1.filter(':checked').length > 3) this.checked = false;
        });
        var cb2 = $('[name="chexing"]');
        cb2.change(function () {
        if (this.checked && cb2.filter(':checked').length > 3) this.checked = false;
        });
        // var cb3 = $('[name="yaoqiu"]');
        // cb3.change(function () {
        // if (this.checked && cb3.filter(':checked').length > 3) this.checked = false;
        // });
        $('input[name="baozhuang"]').on('click', function() {
            if($(this).attr('id')=='baozhuang6')
            {
                $('.qita').show();
            }
            else{
                $('.qita').hide();
            }
        });       
        $('.quren3').click(function(){
            var xinming= $('#huoming').val();
            var qita= $('.qita').val();
            $('input[id="baozhuang6"]').val(qita);
            var bao=$("input[name='baozhuang']:checked").val();
            if (xinming==0||xinming=='') {
        　　      FoxUI.toast.show('请填写货物名称');      
        　　      return
            }
            // console.log(a);
            var zh1=$('.zhong1').val();
            var zh2=$('.zhong2').val();
            // console.log(zh2);
            if(zh1==''&&zh2=='')
            {
                var zhong='';
                FoxUI.toast.show('请填写货重体积');
                return
            }
            if(zh1==''||zh2=='')
            {
                var zhong=zh1+zh2+'吨,';
                // console.log(ti);
            }
            if(zh1==''&&zh2=='')
            {
                var zhong='';
                FoxUI.toast.show('请填写货重体积');
                return
            }
            if(zh1!=''&&zh2!='')
            {
                var zhong=zh1+'-'+zh2+'吨,';
            }
            var ti1=$('.ti1').val();
            var ti2=$('.ti2').val();
            // console.log(zh2);
            if(ti1==''||ti2=='')
            {
                var ti=ti1+ti2+'方';
                // console.log(ti);
            }
            if(ti1==''&&ti2=='')
            {
                var ti='';
                // console.log(ti);
            }
            if(ti1!=''&&ti2!='')
            {
                var ti=ti1+'-'+ti2+'方';
                console.log('1');
            }
            var xinval=xinming+','+bao+','+zhong+ti;
             $('.dian3').val(xinval);
             $('.xinxi').hide();
            $('.container').hide();
        });
        $('.quren4').click(function(){
             $('.fuwu').hide();
            $('.container').hide();
            var a=$('.wenben').val();
            console.log(a);
            var obj = $("input[name='yaoqiu']");
            var s='';
            for(var i=0;i<obj.length;i++){
                if(obj[i].checked)
                    s +=obj[i].value+',';
            }
             var zhi=s+a;
           $('.dian4').val(zhi);
           



            // $('.dian1').val(a);
        });
});
</script>
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">发布货源
        </div>
        <div class="fui-header-right">&nbsp;</div>
    </div>
    <style type="text/css">
        .dizhi{ float: left; }
    </style>
    <div class='fui-content'>
        <div class="container"></div>
     <form method='post' class='form-ajax' >
        <div class="fui-cell-group" style="margin: .6rem; border-radius: .4rem">
            <div style="overflow: hidden; position: relative; border-bottom: 1px solid #ebebeb;" class="dizhifu">
                <div class="dizhi" style="width: 10%">
                    <div class="fui-cell" style="padding: 1.5rem 0rem 1.95rem; text-align: right;">
                        <div class="fui-cell-info c000" ><img src="../addons/ewei_shopv2/template/mobile/default/static/images/fa_03.png"  style="width: 1.2rem; vertical-align: middle;" /></div>
                    </div>
                </div>
                <div class="dizhi" style="width: 90%;">
                    <div class="fui-cell">
                        <div class="fui-cell-info c000"><input type="text" id="areas" name="zhaaddr1" data-value="" value="" placeholder="请填写装货地" class="fui-input" readonly="readonly"></div>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-info c000"><input type="text" id="areaszhuang" name="zhaaddr2" value="" placeholder="选填,输入详细地址" class="fui-input"></div>
                    </div>
                </div>
<!--                 <div class="dizhi" style="width: 10%">
                     <div class="fui-cell" style="padding: 1.5rem 0rem 1.95rem; text-align: left;">
                        <div class="fui-cell-info c000" id="ac"><img src="../addons/ewei_shopv2/template/mobile/default/static/images/img_05.png"  style="width: 1.2rem;" class="addizhi" /></div>
                    </div>
                    
                </div> -->
            </div>
            <div style="overflow: hidden; position: relative; border-bottom: 1px solid #ebebeb;" class="dizhifu">
                <div class="dizhi" style="width: 10%">
                    <div class="fui-cell" style="padding: 1.5rem 0rem 1.95rem; text-align: right;">
                        <div class="fui-cell-info c000" ><img src="../addons/ewei_shopv2/template/mobile/default/static/images/fa_08.png"  style="width: 1.2rem; vertical-align: middle;" /></div>
                    </div>
                </div>
                <div class="dizhi" style="width: 90%">
                    <div class="fui-cell">
                        <div class="fui-cell-info c000"><input type="text" id="areas3" name="addr1" data-value="" value="" placeholder="请填写卸货地" class="fui-input" readonly="readonly"></div>
                    </div>
                    <div class="fui-cell">
                        <div class="fui-cell-info c000"><input type="text" id="areasxie" name="addr2" value="" placeholder="选填,输入详细地址" class="fui-input"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="fui-cell-group" style="margin: .6rem; border-radius: .4rem">
            <div class="fui-cell">
                <div class="fui-cell-label">货物信息</div>
                <div class="fui-cell-info c000"><input type="text" id="huoxianxi" name="hwxx" value="" placeholder="输入货物信息" class="fui-input dian3" readonly="readonly"></div>
                <div class="fui-cell-remark down"></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">车长车型</div>
                <div class="fui-cell-info c000"><input type="text" id="chexingval" name="cxcc" value="" placeholder="选择车长车型" class="fui-input dian2" readonly="readonly"></div>
                <div class="fui-cell-remark down"></div>
            </div>
            <div class="fui-cell">
                <div class="fui-cell-label">几装几卸</div>
                <div class="fui-cell-info c000"><input type="text" id="zhaungxie" name="jzjx" value="一装一卸" placeholder="输入货物信息" class="fui-input dian1" readonly="readonly"></div>
                <div class="fui-cell-remark down"></div>
            </div>
        </div>

        <div class="fui-cell-group" style="margin: .6rem; border-radius: .4rem">
            <div class="fui-cell">
                <div class="fui-cell-label">装货时间</div>
                <div class="fui-cell-info c000"><input type="text" id="areas5" name="zhtime" data-value="" value="" placeholder="请填写装货时间" class="fui-input" readonly="readonly" ></div>
                <div class="fui-cell-remark down"></div>
            </div>
        </div>
        <div class="fui-cell-group" style="margin: .6rem; border-radius: .4rem">
            <div class="fui-cell">
                <div class="fui-cell-label" style="width: 5.25rem;">服务要求和备注</div>
                <div class="fui-cell-info c000"><input type="text" id="fuwu" name="remark" value="" placeholder="请输入服务要求和备注" class="fui-input dian4" style="height: auto;"></div>
                <div class="fui-cell-remark down"></div>
            </div>
        </div>
        <div class="fui-cell-group" style="margin: .6rem; border-radius: .4rem">
            <div class="fui-cell applyradio" style="padding: 0rem 0.6rem;">
                <div class="fui-cell-remark noremark"><input name="1" type="checkbox" class="fui-radio fui-radio-danger" checked="cheched " id="xieyi" value="xieyi"></div>
                <div class="fui-cell-info" style="color: #666;padding: 0.75rem 0rem 0.65rem;">
                    我已阅读并同意<a href="#" style="color: #2D98D6">《货物运输协议》</a>等相关协议
                </div>
            </div>
        </div>
        <style type="text/css">
                .cailiao{overflow: hidden; width: 100%; padding:.4rem .4rem .2rem}
                .cailiao1{ float: left; width: 21%; margin:1% 2%}
                .cailiao1 input{display: none;}
                .cailiao1 label{ font-size: 0.7rem; width: 100%; text-align: center; display: block; padding:.2rem 0;border-radius: .4rem; background-color: #F3F3F3;border: 1px solid #F3F3F3; }
                .cailiao1 input:checked+label{color: #D76C37; border: 1px solid #D76C37; background-color: #FFEFE2}
                .yicang{display: none;}
                .tex{border: 1px solid #747474!important; height: 8rem; padding: .6rem}
                .zhxie{ background-color: #fff; height: 12rem; position: fixed; bottom: 0; width: 100%; display: none; z-index: 12}
                .chexingdiv{ background-color: #fff;  position: fixed; bottom: 0; width: 100%;  z-index: 12; padding-bottom: 1rem; display: none;}
                .xinxi{ background-color: #fff;  position: fixed; bottom: 0; width: 100%;  z-index: 12; padding-bottom: 1rem; display: none;}
                .fuwu{ background-color: #fff;  position: fixed; bottom: 0; width: 100%;  z-index: 12; padding-bottom: 1rem; display: none;}
                .lab{ margin:0 2% }
                .lab2{ color: #F88622; font-size: .8rem; padding: .2rem 0 ;margin:0 2%}
                .lab span{ color: #A0A0A0; font-size: .65rem }
                .cailiao2{ float: left; width: 29%; margin:1% 2%}
                .cailiao2 input{display: none;}
                .cailiao2 label{ font-size: 0.7rem; width: 100%; text-align: center; display: block; padding:.2rem 0;border-radius: .4rem; background-color: #F3F3F3;border: 1px solid #F3F3F3; }
                .cailiao2 input:checked+label{color: #D76C37; border: 1px solid #D76C37; background-color: #FFEFE2}
            </style>
           <div class="xinxi">
                <div class="fui-picker-header" style="border-bottom: 1px solid #ebebeb;">
                    <div class="left "><a href="javascript:" class="text-cancel fui-picker-cancel quxiao">取消</a></div>
                    <div class="center" style="font-weight: bold;">货物信息</div>
                    <div class="right"><a href="javascript:" class="text-success fui-picker-confirm quren3" style="color: #D76C37;">确定</a></div>
                </div>
                    <style type="text/css">
                        .xinUl{ width: 100%;  overflow: hidden; }
                        .xinUl li{ list-style: none; overflow: hidden; margin: .6rem; border-bottom: 1px solid #ebebeb; color: #333; padding: .2rem 0}
                        .xinUl li .span1{ float: left; padding: .2rem 0}
                        .xinUl li .span2{ float: right; background-color: #F3F3F3; padding: .2rem .4rem; font-size: .6rem; border-radius: .4rem }
                        .huodiv{ margin: .6rem; border-radius: .4rem }
                        .huop{ position: relative; width: 100%; background-color: #FEF0E3; text-align:center; height: 2.2rem; line-height: 2.2rem }
                        .huospan{ position: absolute; width: 4rem; display: inline-block; right: .4rem; border: 1px solid #333; text-align: center;white-space: nowrap;text-overflow: ellipsis;overflow: hidden; font-size: .65rem; padding: .2rem; height: auto; line-height: normal; top: .4rem}
                        .soubot{ margin: .6rem; border-radius: .4rem; border: 2px solid #FEF0E3; padding-bottom: .6rem;}
                        .zizhong{ overflow: hidden; margin:.2rem .6rem; height: 2rem; line-height: 2rem}
                        .tidiv1{ float: left; width: 20% }
                        .tidiv2{ float: right; width: 80%; color: #ccc; text-align: right;}
                        .tidiv2 input{ width: 40%; background-color: #F3F3F3; border-radius: .4rem; border: 1px solid #F3F3F3; padding: .3rem; text-align: right;}
                    </style>
                    <div class="fui-cell-group" style="margin: .4rem 0 .2rem;">
                    <div class="fui-cell" style="padding: 0 4%">
                        <div class="fui-cell-label" style="width:4.8rem">货物名称(必填)</div>

                        <div class="fui-cell-info c000" style="background-color: #F3F3F3;padding: 0.4rem 0.6rem;border-radius: .4rem; position: relative;"><input type="tel" id="huoming" name="huoming" value="" placeholder="请填写货物名称" class="fui-input zhanchechang"></div>
                    </div>
                </div>
                <div class="soubot">
                    
                    <div class="cailiao">
                    <p class="lab2">包装方式必填</p>
                    <div class="cailiao2">
                        <input type="radio" name="baozhuang" id="baozhuang1" value="散装">
                        <label for="baozhuang1">散装</label>
                    </div>
                    <div class="cailiao2">
                        <input type="radio" name="baozhuang" id="baozhuang2" value="袋装">
                        <label for="baozhuang2">袋装</label>
                    </div>
                    <div class="cailiao2">
                        <input type="radio" name="baozhuang" id="baozhuang3" value="框装">
                        <label for="baozhuang3">框装</label>
                    </div>
                    <div class="cailiao2">
                        <input type="radio" name="baozhuang" id="baozhuang4" value="捆扎">
                        <label for="baozhuang4">捆扎</label>
                    </div>
                    <div class="cailiao2">
                        <input type="radio" name="baozhuang" id="baozhuang5" value="压块">
                        <label for="baozhuang5">压块</label>
                    </div>
                    <div class="cailiao2">
                        <input type="radio" name="baozhuang" id="baozhuang6" value="">
                        <label for="baozhuang6">其他</label>
                    </div>
                </div>
                <div class="fui-cell-group">
                        <div class="fui-cell" style="padding: 0rem 4%">
                            <div class="fui-cell-info c000"><input type="text" id="" name=""  value="" placeholder="请填写装货地" class="fui-input qita" style="padding: 0.75rem .4rem; background-color: #F3F3F3; display: none;"></div>
                        </div>
                    </div>
                </div>
                <div class="soubot">
                    <div style="overflow: hidden;width: 100%;padding: .4rem .4rem .2rem;">
                         <p class="lab2">货重/体积，必填一项</p>
                         <div class="zizhong">
                             <div class="tidiv1">重量(吨)</div>
                             <div class="tidiv2">
                                 <input type="number" name="" placeholder="0-999" class="zhong1">&nbsp;—&nbsp;<input type="number" name="" placeholder="0-999" class="zhong2">
                             </div>
                         </div>
                         <div class="zizhong">
                             <div class="tidiv1">体积(方)</div>
                             <div class="tidiv2">
                                 <input type="number" name="" placeholder="0-999" class="ti1">&nbsp;—&nbsp;<input type="number" name="" placeholder="0-999" class="ti2">
                             </div>
                         </div>
                    </div>
                      
                 </div>
            </div>
            <div class="zhxie">
                <div class="fui-picker-header" style="border-bottom: 1px solid #ebebeb;">
                    <div class="left "><a href="javascript:" class="text-cancel fui-picker-cancel quxiao">取消</a></div>
                    <div class="center" style="font-weight: bold;">几装几卸</div>
                    <div class="right"><a href="javascript:" class="text-success fui-picker-confirm quren" style="color: #D76C37">确定</a></div>
                </div>
                <div class="cailiao">
                    <div class="cailiao1">
                        <input type="radio" name="zhizhao" id="zhizhao1" checked="" value="一装一卸">
                        <label for="zhizhao1">一装一卸</label>
                    </div>
                    <div class="cailiao1">
                        <input type="radio" name="zhizhao" id="zhizhao2" value="一装两卸">
                        <label for="zhizhao2">一装两卸</label>
                    </div>
                    <div class="cailiao1">
                        <input type="radio" name="zhizhao" id="zhizhao3" value="两装一卸">
                        <label for="zhizhao3">两装一卸</label>
                    </div>
                    <div class="cailiao1">
                        <input type="radio" name="zhizhao" id="zhizhao4" value="两装两卸">
                        <label for="zhizhao4">两装两卸</label>
                    </div>
                </div>
            </div>
            <div class="chexingdiv">
                <div class="fui-picker-header" style="border-bottom: 1px solid #ebebeb;">
                    <div class="left "><a href="javascript:" class="text-cancel fui-picker-cancel quxiao">取消</a></div>
                    <div class="center" style="font-weight: bold;">车长车型</div>
                    <div class="right"><a href="javascript:" class="text-success fui-picker-confirm quren2" style="color: #D76C37">确定</a></div>
                </div>
                <div class="cailiao">
                    <p class="lab">用车类型</p>
                    <div class="cailiao1">
                        <input type="radio" name="yongche" id="yongche1" checked="" value="整车">
                        <label for="yongche1">整车</label>
                    </div>
                    <div class="cailiao1">
                        <input type="radio" name="yongche" id="yongche2" value="零担">
                        <label for="yongche2">零担</label>
                    </div>
                </div>
                <div class="cailiao">
                    <p class="lab">车长<span>(必填，最多3项)</span></p>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang1" value="1.8">
                        <label for="chechang1">1.8</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang2" value="2.7">
                        <label for="chechang2">2.7</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang3" value="3.8">
                        <label for="chechang3">3.8</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang4" value="4.2">
                        <label for="chechang4">4.2</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang5" value="5">
                        <label for="chechang5">5</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang6" value="6.2">
                        <label for="chechang6">6.2</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang7" value="6.8">
                        <label for="chechang7">6.8</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang8" value="7.7">
                        <label for="chechang8">7.7</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang9" value="8.2">
                        <label for="chechang9">8.2</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang10" value="8.7">
                        <label for="chechang10">8.7</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang11" value="9.6">
                        <label for="chechang11">9.6</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang12" value="11.7">
                        <label for="chechang12">11.7</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang13" value="12.5">
                        <label for="chechang13">12.5</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang14" value="13">
                        <label for="chechang14">13</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang15" value="13.7">
                        <label for="chechang15">13.7</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang16" value="15">
                        <label for="chechang16">15</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang17" value="16">
                        <label for="chechang17">16</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chechang" id="chechang18" value="17.5">
                        <label for="chechang18">17.5</label>
                    </div>
                </div>
                <div class="fui-cell-group" style="margin: .4rem 0 .2rem;">
                    <div class="fui-cell" style="padding: 0 4%">
                        <div class="fui-cell-label">占用车长</div>

                        <div class="fui-cell-info c000" style="background-color: #F3F3F3;padding: 0.4rem 0.6rem;border-radius: .4rem; position: relative;"><input type="tel" id="" name="" value="" placeholder="0-20" class="fui-input zhanchechang"><span style="position: absolute; right: 0; padding: .2rem">米</span></div>
                    </div>
                </div>
                <div class="cailiao">
                    <p class="lab">车型<span>(必填，最多3项)</span></p>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing1" value="平板">
                        <label for="chexing2">平板</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing2" value="高栏">
                        <label for="chexing2">高栏</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing3" value="箱式">
                        <label for="chexing3">箱式</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing4" value="集装箱">
                        <label for="chexing4">集装箱</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing5" value="自卸">
                        <label for="chexing5">自卸</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing6" value="冷藏">
                        <label for="chexing6">冷藏</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing7" value="保温">
                        <label for="chexing7">保温</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing8" value="高低板">
                        <label for="chexing8">高低板</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing9" value="面包车">
                        <label for="chexing9">面包车</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing10" value="棉被车">
                        <label for="chexing10">棉被车</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing11" value="爬梯车">
                        <label for="chexing11">爬梯车</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="chexing" id="chexing12" value="飞翼车">
                        <label for="chexing12">飞翼车</label>
                    </div>
                </div>
            </div>
            <div class="fuwu">
                <div class="fui-picker-header" style="border-bottom: 1px solid #ebebeb;">
                    <div class="left "><a href="javascript:" class="text-cancel fui-picker-cancel quxiao">取消</a></div>
                    <div class="center" style="font-weight: bold;">服务要求和备注</div>
                    <div class="right"><a href="javascript:" class="text-success fui-picker-confirm quren4" style="color: #D76C37">确定</a></div>
                </div>
                <div class="fui-cell-group">
                    <div class="fui-cell">
                <textarea placeholder="请输入备注,最多50个字" style="height: 5rem;
    padding: .6rem; background-color: #F8F8F8" class="wenben"></textarea>
            </div>
                </div>
                <div class="cailiao">
                    <p class="lab">特殊要求</p>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu2" value="三不超">
                        <label for="yaoqiu2">三不超</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu3" value="需雨布">
                        <label for="yaoqiu3">需雨布</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu8" value="有禁区">
                        <label for="yaoqiu8">有禁区</label>
                    </div>
                     <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu7" value="需回单">
                        <label for="yaoqiu7">需回单</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu9" value="需押车">
                        <label for="yaoqiu9">需押车</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu10" value="禁止配货">
                        <label for="yaoqiu10">禁止配货</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu11" value="全程高速">
                        <label for="yaoqiu11">全程高速</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu12" value="派人跟车">
                        <label for="yaoqiu12">派人跟车</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu5" value="随时装">
                        <label for="yaoqiu5">随时装</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu6" value="高价急走">
                        <label for="yaoqiu6">高价急走</label>
                    </div>
                                        <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu13" value="绿通">
                        <label for="yaoqiu13">绿通</label>
                    </div>
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu1" value="到付">
                        <label for="yaoqiu1">到付</label>
                    </div>
                    
                    <div class="cailiao1">
                        <input type="checkbox" name="yaoqiu" id="yaoqiu4" value="全部现金">
                        <label for="yaoqiu4">全部现金</label>
                    </div>
                </div>
            </div>
            <div class="fui-cell-group" style="padding: .4rem 0; margin: .4rem 0 4rem">
                    <div class="fui-cell" style="margin: 0 4%; padding:0 .4rem;background-color: #F3F3F3;border-radius: .4rem;">
                        <div class="fui-cell-label">期望运费</div>

                        <div class="fui-cell-info c000" style="padding: 0.4rem 0.6rem; position: relative;"><input type="tel" id="yunfeiqi" name="" value="" placeholder="请输入运费" class="fui-input zhanchechang" style="text-align: left;"><span style="position: absolute; right: 0; padding: .2rem">元</span></div>
                    </div>
                </div>
             <a id="btn-submit2" class='external btn btn-danger block  nav-item' style="position: fixed; bottom: 0; width: 100%; margin: 0; padding: 0; border-radius: 0; background-color: #FF5C01; height: 2.2rem; line-height: 2.2rem; font-size: .8rem">确认发货</a>
            </form> 

    </div>
    </div>
</div>
<script language='javascript' type="text/javascript">
    require(['biz/member/address'], function (modal) {
        modal.initPost({new_area: <?php  echo $new_area?>, address_street: <?php  echo $address_street?>});
    });
    </script>
    <script language='javascript' type="text/javascript">
        require(['biz/member/address3'], function (modal) {
            modal.initPost({new_area: <?php  echo $new_area?>, address_street: <?php  echo $address_street?>});
        });
    </script>
     <script language='javascript' type="text/javascript">
        require(['biz/member/address5'], function (modal) {
            modal.initPost({new_area: <?php  echo $new_area?>, address_street: <?php  echo $address_street?>});
        });
    </script>
    <script language='javascript'>
        require(['biz/member/address'], function (modal) {
        modal.initList();
    });</script>
    <script language='javascript'>
        require(['biz/member/address3'], function (modal) {
        modal.initList();
    });</script>
     <script language='javascript'>
        require(['biz/member/address5'], function (modal) {
        modal.initList();
    });</script>
    <script language='javascript'>
        require(['biz/member/huoyuan'], function (modal) {
        modal.init({});
    });</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--913702023503242914-->