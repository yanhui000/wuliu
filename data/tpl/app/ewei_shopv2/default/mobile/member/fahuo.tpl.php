<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<style>

     .fui-list-group-title.lineblock2:before{

        content: "";

        position: absolute;

        left: .5rem;

        bottom: 0;

        right: .5rem;

        height: 1px;

        border-top: 1px solid #ebebeb;

        -webkit-transform-origin: 0 100%;

        -ms-transform-origin: 0 100%;

        transform-origin: 0 100%;

        -webkit-transform: scaleY(0.5);

        -ms-transform: scaleY(0.5);

        transform: scaleY(0.5);

    }

.fahuo{width: 100%; overflow: hidden; margin: 0.35rem 0; border-radius: .2rem;border:1px solid #fff;}
.fahuo li{ float: left; width: 33.33%; list-style: none; border-right:1px solid #fff;padding: 0.2rem 0; font-size: .6rem}
.fahuo li.current{ background-color: #fff; color: #FA871D }
.yicang{ display: none; }
.fahuop{font-size: 1rem; padding:.6rem 2rem; display: inline-block;position: absolute; left: 50%; bottom: 15%;transform: translate(-50%, -50%);}
.fahuoA{ background-color: #FA871D; color: #fff; font-size: 1rem; padding:.6rem 2rem; display: inline-block; border-radius: .2rem;/*position: absolute; left: 50%; bottom: 15%;transform: translate(-50%, -50%);*/ }
.shaixuan{ width: 100%; overflow: hidden; background-color: #fff;border-bottom: 1px solid #E3E3E3;}
.shaixuan li{ list-style: none; float: left; width: 33.33%; border-right: 1px solid #E3E3E3; text-align: center; margin: .6rem 0; font-size: .7rem}
.sxatr{ padding-right: .4rem }
.city{ background-color: #fff; padding: .6rem 0}
.citydq{ overflow: hidden; margin: 0 4% 4%}
.citydqp{ float: left; }
.citydqa{ float: right;}
.cityxiaji{ overflow: hidden; margin: 0 3% }
.cityxiaji li{ float: left; border: 1px solid #ccc; width: 23%; list-style: none; text-align: center; margin: 1%; padding: .4rem 0; font-size: .75rem}
.cityxiaji li.moren{  border: 1px solid #FA871D; color: #FA871D }
.shaiqie{width: 100%;position: absolute;/*height: 100%;  background-color: #fff;z-index: 10;*/}
.paixu{ overflow: hidden; background-color: #fff}
.paixu li{ float: left; width: 100%; overflow: hidden; border-bottom: 1px solid #E3E3E3; padding: .4rem}
.paixu li.moren2{color: #FA871D}
.paixu li .span1{ float: left; }
.paixu li .span2{ float: right; }
.container {
    height: 100%;
    width: 100%;
    position: fixed;
    background-color: #999;
    opacity: 0.5;
  /*  display: none;*/
    z-index: 10;
}
.art{ position: absolute; width: 100%; z-index: 20 }
</style>
<script type="text/javascript">
    $(function(){
        var $lis=$(".fahuo li");
        $lis.click(function(){
            $(this).addClass("current").siblings().removeClass("current");
            var index=$lis.index(this);
            console.log(index);
            $(".qiehuan section").eq(index).show().siblings().hide();
        });
        var $shai=$(".shaixuan li");
        $shai.click(function(){
            //$(this).addClass("current").siblings().removeClass("current");
            $(this).find('span.sxatr').text()
            var index=$shai.index(this);
            // $('.tog').show();
            $(".shaiqie article").eq(index).toggle().siblings().hide();
            // $('.container').show();
        });
        // $('.tog').click(function(){
        // 	$(this).hide();
        // });
        $('.cityxiaji li').click(function(){
        	$(this).addClass('moren');
        	$(this).siblings().removeClass("moren");
        	$(this).parent().parent().parent().hide();
        	var neirong=$(this).text();
        	$(".shaixuan li").find('span.sxatr').text()
            var index2=$(this).parent().parent().parent().index();
            console.log(index2);
            $(".shaixuan li").eq(index2).find('span.sxatr').text(neirong);
             // $('.container').hide();
        });
        $('.paixu li').click(function(){
            $(this).addClass('moren2');
            $(this).siblings().removeClass("moren2");
            $(this).parent().parent().hide();
            var neirong=$(this).find('span.span1').text();
            $(".shaixuan li").find('span.sxatr').text();
            var index2=$(this).parent().parent().index();
            console.log(index2);
            $(".shaixuan li").eq(index2).find('span.sxatr').text(neirong);
        });
        $('.container').click(function(){
        	$('.shaiqie article').hide();
        });

    })
</script>
<div class='fui-page order-list-page'>
    <div class="fui-header">

        <div class="fui-header-left">

            <!--<a class="" style="position: relative;">消息<span class="badge2">13</span></a>-->

        </div>

        <div class="title" style="width: 60%; margin: 0 20%">
        发货
        </div>

        <!-- <div class="fui-header-right">

            <a class="icon icon-delete external"><span class="icon icon-search2" style="font-size: 1rem; color: #fff"></span></a>

        </div> -->

    </div>
	<div class='fui-content' style="top: 2.2rem">
	<!-- 	<div class="tog"></div> -->
		<div class="qiehuan">
			<section>
               <!--  <p class="fahuop">您周围有<span>89987+</span>司机等待您发货</p>
				<a href="" class="fahuoA">发货</a>
 -->

                <div class='content-empty' style="position: absolute;width: 100%; top: 65%;margin-top: 0">
                   <p style="color: #999;font-size: .75rem; margin: 1rem 0">您周围有<span style="color: #FA871D">89987+</span>司机等待您发货</p>
                   <a href="<?php  echo mobileUrl('member/huoyuan')?>" class="fahuoA external nav-item">发货</a>
                </div>
			</section>
			<section class="yicang">
				<ul class="shaixuan">
					<li><span class="sxatr">出发地</span><span class="icon icon-unfold"></span>
					</li>
					<li><span class="sxatr">目的地</span><span class="icon icon-unfold"></span></li>
					<li style="border: none;"><span class="sxatr">全部</span><span class="icon icon-unfold"></span></li>
				</ul>
				<div class="shaiqie">
					<article class="yicang">
                        <div class="container"></div>
						<div class="city art">
							<!-- <div class="citydq">
								<p class="citydqp">选择：济南</p>
								<a href="#" class="citydqa">返回上一级</a>
							</div> -->
							<ul class="cityxiaji">
								<li>全市1</li>
								<li>莱芜区</li>
								<li>钢城区</li>
								<li>章丘区</li>
							</ul>
						</div>
					</article>
					<article class="yicang">
                        <div class="container"></div>
						<div class="city art">
							<!-- <div class="citydq">
								<p class="citydqp">选择：济南</p>
								<a href="#" class="citydqa">返回上一级</a>
							</div> -->
							<ul class="cityxiaji">
								<li>全市2</li>
								<li>莱芜区</li>
								<li>钢城区</li>
								<li>章丘区</li>
							</ul>
						</div>
					</article>
					<article class="yicang">
                        <div class="container"></div>
                        <ul class="paixu art">
                            <li class="moren2"><span class="span1">全部</span></li>
                            <li><span class="span1">今天</span></li>
                            <li><span class="span1">昨天</span></li>
                            <li><span class="span1">前天</span></li>
                            <li><span class="span1">12月19号</span></li>
                            <li><span class="span1">12月18号</span></li>
                            <li><span class="span1">12月17号</span></li>
                            <li><span class="span1">12月16号</span></li>
                        </ul>
                    </article>
				</div>
				<div>444</div>
				<div class='content-empty' style="position: absolute; left: 50%; top: 50%;transform: translate(-50%, -50%); margin-top: 0">
					<img src="<?php echo EWEI_SHOPV2_STATIC;?>images/nolist3.png" style="width: 6rem;margin-bottom: .5rem;"><br/><p style="color: #999;font-size: .75rem">暂无数据</p>
		        </div>
			</section>
			<section class="yicang">
				<div class='content-empty' style="position: absolute; left: 50%; top: 50%;transform: translate(-50%, -50%); margin-top: 0">
					<img src="<?php echo EWEI_SHOPV2_STATIC;?>images/nolist3.png" style="width: 6rem;margin-bottom: .5rem;"><br/><p style="color: #999;font-size: .75rem">您尚未保存任何常发资源</p>
		        </div>
			</section>
		</div>
    </div>
    <?php  $this->footerMenus()?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>