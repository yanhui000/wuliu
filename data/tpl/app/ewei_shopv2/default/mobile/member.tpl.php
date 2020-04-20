<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
	.fui-icon-col.external.before:before{
		content: '';
		position: absolute;
		top: 1rem;
		bottom: 1rem;
		left: 0;
		width: 1px;
		background-color: #ebebeb;
		display: block;
		z-index: 15;
	}
.fui-icon-group.col-5 .fui-icon-col{width: 25%!important}
.member-page .fui-icon-group .fui-icon-col .icon{height: 1.4rem!important;line-height: 1.4rem!important;}
.fui-icon-group .fui-icon-col .icon img{ width: 1.4rem!important; height: 1.4rem!important }
.fui-cell-group .fui-cell .fui-cell-remark:after{border-color:#FA871D!important;}
</style>
<div class='fui-page  fui-page-current'>
    <!-- <div class="fui-header">
		<div class="fui-header-left">
			<a class="back" onclick='location.back()'></a>
		</div>
		<div class="title">会员中心</div>
		<div class="fui-header-right"></div>
	</div> -->
	<div class='fui-content member-page navbar' style="top:0">
		<div style="overflow: hidden;background: #FA871D;">
		<div class="headinfo" style="z-index:100;border: none;">
	    <div class="userinfo" style="height: auto; width:100%">
			<div class="fui-list">
				<div class="fui-list-media"><img src="<?php  echo $member['avatar'];?>" onerror="this.src='../addons/ewei_shopv2/static/images/noface.png'" style="width: 3rem; height: 3rem;border-radius: 50%;" /></div>
				<div class="fui-list-info" style="width: 12rem">
				<div class="title"> </div>
					<div class="text" style="color: #fff; font-size: 1rem">
						<?php  echo $member['nickname'];?>
					</div>
			
					<div class="subtitle" style="color: #fff">
						交易:0
					</div>
				</div>
			</div>
					<a class="setbtn external" href="<?php  echo mobileUrl('member/info')?>"><i class="icon icon-shezhi"></i></a>
			    </div>

	</div>
				<div class="headinfo" style="z-index:100;border: none; padding-top: 0">
				<!-- <a class="setbtn" href="<?php  echo mobileUrl('member/info')?>" data-nocache='true'><i class="icon icon-shezhi"></i></a> -->
			
                  <div class="child" style="width: 50%">
                 
					<div class="num" style="padding-top: 1.2rem; color: #fff"><?php  echo number_format($member['credit2'],2)?></div>
					<div class="title" style="padding-top:0.4rem;">我的余额</div>
                 
					<!-- <?php  if(empty($_W['shopset']['trade']['closerecharge'])) { ?><a href="<?php  echo mobileUrl('member/recharge')?>"><div class="btn">充值</div></a><?php  } ?> -->
				</div>
		<!-- 		<div class="child userinfo">
					<a href="<?php  echo mobileUrl('member/info')?>" data-nocache="true" style="color: white;">
						<div class="face"><img src="<?php  echo $member['avatar'];?>" onerror="this.src='../addons/ewei_shopv2/static/images/noface.png'"/></div>
						<div class="name"><?php  echo $member['nickname'];?></div>
					</a>
					<div class="level" <?php  if(!empty($_W['shopset']['shop']['levelurl'])) { ?>onclick='location.href="<?php  echo $_W['shopset']['shop']['levelurl'];?>"'<?php  } ?>>
					<?php  if(empty($level['id'])) { ?>
					[<?php  if(empty($_W['shopset']['shop']['levelname'])) { ?>普通会员<?php  } else { ?><?php  echo $_W['shopset']['shop']['levelname'];?><?php  } ?>]
					<?php  } else { ?>
					[<?php  echo $level['levelname'];?>]
					<?php  } ?>
					<?php  if(!empty($_W['shopset']['shop']['levelurl'])) { ?><i class='icon icon-question1' style='font-size:0.65rem'></i><?php  } ?>
				</div>
			</div> -->
	
<!--                   <div class="child" style="width: 50%">
                <a href="<?php  echo mobileUrl('commission/down',array('stem'=>1))?>">
				<div class="num" style="padding-top: 1.2rem; color: #fff"><?php  echo number_format($zongs,0)?></div>
				<div class="title" style=" padding-top: 0.4rem">我的团队</div>
              </a>
			</div> -->
                  
		</div>

		<!--<div class="member_header" style="border-radius:0;"></div>-->
		</div>

    <?php  if(p('task')) { ?>
        <?php  if(p('task')->get_unread()) { ?>
            <div class="fui-cell-group fui-cell-click" style="border-top: 1px solid #ebebeb;border-bottom: 1px solid #ebebeb;    margin-bottom: 0.5rem;">
                <a class="fui-cell external" href="<?php  echo mobileUrl('task')?>">
                    <div class="fui-cell-icon"><i class="icon icon-gifts"></i></div>
                    <style>
                        .task-red-mark{background-color: #ff5555;position: absolute;width: 6.9px;height: 6.9px;border-radius: 50%;display: block;left: 6.9rem;top: 0.69rem}
                    </style>
                    <div class="fui-cell-text"><p>您有奖励待领取</p><span class="task-red-mark"></span></div>
                    <div class="fui-cell-remark"></div>
                </a>
            </div>
        <?php  } else if(p('task')->TasknewEntrance()) { ?>
            <div class="fui-cell-group fui-cell-click" style="border-top: 1px solid #ebebeb;border-bottom: 1px solid #ebebeb;    margin-bottom: 0.5rem;">
                <a class="fui-cell" href="<?php  echo mobileUrl('task')?>">
                    <div class="fui-cell-icon"><i class="icon icon-gifts"></i></div>
                    <div class="fui-cell-text"><p>任务中心</p></div>
                    <div class="fui-cell-remark"></div>
                </a>
            </div>
        <?php  } ?>
    <?php  } ?>
   <!-- <div class="fui-cell-group fui-cell-click" style="margin-top: 0;margin-bottom: .5rem">
		<a class="fui-cell external" href="<?php  echo mobileUrl('member/wanshanxinxi')?>" style="background-color: #FFF7EA; padding: .6rem; margin: .6rem">
			<div class="fui-cell-icon"><i class="icon icon-infofill" style="color: #FA871D"></i></div>
			<div class="fui-cell-text" style="color: #FA871D"><p>公司资料待完善</p></div>
			<div class="fui-cell-remark" style="color: #FA871D">去完善</div>
		</a>
	</div>-->
	<div class="fui-cell-group fui-cell-click" style="margin-top: 0">
		<div class="fui-cell external" href="<?php  echo mobileUrl('order')?>">
			<div class="fui-cell-text" style="font-size: .8rem;">我的服务</div>
		</div>
		<?php  $check_cycelbuy=p('cycelbuy')?>
		<div class="fui-icon-group selecter <?php  if($check_cycelbuy) { ?>col-5<?php  } else { ?>col-4<?php  } ?>">
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('member/kehufuwu')?>">
				<div class="icon icon-green radius"><img src="../addons/ewei_shopv2/template/mobile/default/static/images/fuwu2.png"></div>
				<div class="text">客服服务</div>
			</a>
	
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('member/yijian')?>">
				<div class="icon icon-blue radius"><img src="../addons/ewei_shopv2/template/mobile/default/static/images/fuwu4.png"></div>
				<div class="text">意见反馈</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('member/licheng')?>">
				<div class="icon icon-pink radius"><img src="../addons/ewei_shopv2/template/mobile/default/static/images/fuwu7.png"></div>
				<div class="text">里程计算</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('member/shuju')?>">
				<div class="icon icon-pink radius"><img src="../addons/ewei_shopv2/template/mobile/default/static/images/fuwu5.png"></div>
				<div class="text">数据统计</div>
			</a>
					
		</div>
	</div>
		<?php  if($needbind) { ?>
			<div class="fui-cell-group fui-cell-click external">
				<a class="fui-cell"  href="<?php  echo mobileUrl('member/bind')?>">
					<div class="fui-cell-text">
						<i class="icon icon-shouji" style="color: #666;"></i>
							绑定手机号
						<div class="fui-cell-tip">如果您用手机号注册过会员或您想通过微信外购物请绑定您的手机号码</div>
					</div>
					<div class="fui-cell-remark"></div>
				</a>
			</div>
		<?php  } ?>

		<?php  if(!empty($roleuser)) { ?>
			<div class="fui-cell-group fui-cell-click external">
				<a class="fui-cell"  href="<?php  echo mobileUrl('mmanage')?>" data-nocache="true">
					<div class="fui-cell-text">
						<i class="icon icon-shouji" style="color: #666;"></i>
						<?php  echo m('plugin')->getName('mmanage')?>
						<div class="fui-cell-tip">当前用户已绑定操作员，您可以通过手机管理商城</div>
					</div>
					<div class="fui-cell-remark"></div>
				</a>
			</div>
		<?php  } ?>




	<?php  if($newstore_plugin) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell external" href="<?php  echo mobileUrl('newstore/norder')?>">
			<div class="fui-cell-icon"><i class="icon icon-list"></i></div>
			<div class="fui-cell-text">我的预约</div>
			<div class="fui-cell-remark" style="font-size: 0.65rem;">查看全部预约</div>
		</a>
		<div class="fui-icon-group selecter">
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('newstore/norder',array('status'=>0))?>">
				<?php  if($statics['norder_0']>0) { ?><div class="badge"><?php  echo $statics['norder_0'];?></div><?php  } ?>
				<div class="icon icon-green radius"><i class="icon icon-pay"></i></div>
				<div class="text">待付款</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('newstore/norder',array('status'=>1))?>">
				<?php  if($statics['norder_1']>0) { ?><div class="badge"><?php  echo $statics['norder_1'];?></div><?php  } ?>
				<div class="icon icon-orange radius"><i class="icon icon-like"></i></div>
				<div class="text">待使用</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('newstore/norder',array('status'=>3))?>">
				<?php  if($statics['norder_3']>0) { ?><div class="badge"><?php  echo $statics['norder_3'];?></div><?php  } ?>
				<div class="icon icon-blue radius"><i class="icon icon-discover"></i></div>
				<div class="text">已完成</div>
			</a>
			<a class="fui-icon-col external" href="<?php  echo mobileUrl('newstore/norder',array('status'=>4))?>">
				<?php  if($statics['norder_4']>0) { ?><div class="badge"><?php  echo $statics['norder_4'];?></div><?php  } ?>
				<div class="icon icon-pink radius"><i class="icon icon-remind"></i></div>
				<div class="text">取消预约</div>
			</a>
		</div>
	</div>
	<?php  } ?>


	<?php  if(!empty($haveverifygoods)) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell external" href="<?php  echo mobileUrl('verifygoods')?>">
			<div class="fui-cell-icon"><i class="icon icon-list"></i></div>
			<div class="fui-cell-text">待使用商品信息</div>
			<div class="fui-cell-remark" style="font-size: 0.5rem;"></div>
		</a>

		<?php  if(!empty($verifygoods)) { ?>
		<div class="fui-icon-group selecter" style="overflow: scroll;">
			<ul class="banner-ul">
				<?php  if(is_array($verifygoods)) { foreach($verifygoods as $item) { ?>
				<li   <?php  if($item['numlimit']) { ?>class="banner-li-blue"<?php  } ?>>
				<a  <?php  if($item['cangetcard']) { ?> href="javascript:;" onclick="addCard('<?php  echo $item['card_id'];?>','<?php  echo $item['cardcode'];?>')" <?php  } else { ?> href="<?php  echo mobileUrl('verifygoods/detail',array('id'=>$item['id']))?>" <?php  } ?>>
				<div></div>
				<span>  <?php  if($item['cangetcard']) { ?>  待激活 <?php  } else { ?>待使用<?php  } ?></span>
				<img src="<?php  echo $item['thumb'];?>" alt="">
				<p>	<?php  echo $item['title'];?></p>
				</a>
				</li>
				<?php  } } ?>
			</ul>
		</div>
		<?php  } ?>
	</div>
	<?php  } ?>

	<?php  if($hasThreen) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell"  href="<?php  echo mobileUrl('threen')?>">
			<div class="fui-cell-icon"><i class="icon icon-profile"></i></div>
			<div class="fui-cell-text"><p><?php  echo $plugin_threen_set['texts']['threen'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>
	<?php  if($haslive) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell" href="<?php  echo mobileUrl('live')?>">
			<div class="fui-cell-icon"><i class="icon icon-zhibo1"></i></div>
			<div class="fui-cell-text"><p><?php  echo $live_set['pluginname'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>
	<?php  if($hassign) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell" href="<?php  echo mobileUrl('sign')?>">
			<div class="fui-cell-icon"><i class="icon icon-qiandao"></i></div>
			<div class="fui-cell-text"><p><?php  echo $hassign;?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>

	<?php  if($hasglobonus) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell"  href="<?php  echo mobileUrl('globonus')?>">
			<div class="fui-cell-icon"><i class="icon icon-gudong1"></i></div>
			<div class="fui-cell-text"><p><?php  echo $plugin_globonus_set['texts']['center'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>

	<?php  if($hasabonus) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell"  href="<?php  echo mobileUrl('abonus')?>">
			<div class="fui-cell-icon"><i class="icon icon-profile"></i></div>
			<div class="fui-cell-text"><p><?php  echo $plugin_abonus_set['texts']['center'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>


	<?php  if($hasauthor) { ?>
	<div class="fui-cell-group fui-cell-click">
		<a class="fui-cell"  href="<?php  echo mobileUrl('author')?>">
			<div class="fui-cell-icon"><i class="icon icon-profile"></i></div>
			<div class="fui-cell-text"><p><?php  echo $plugin_author_set['texts']['center'];?></p></div>
			<div class="fui-cell-remark"></div>
		</a>
	</div>
	<?php  } ?>

	<?php  if(!empty($showcard)) { ?>
        <div class="fui-cell-group fui-cell-click">
            <a class="fui-cell" href="javascript:;" onclick="addCard('<?php  echo $card['card_id'];?>','')">
                <div class="fui-cell-icon"><i class="icon icon-same"></i></div>
                <div class="fui-cell-text"><p><?php  echo $cardtag;?></p></div>
                <div class="fui-cell-remark"></div>
            </a>
        </div>
	<?php  } ?>

	
	<?php  if(!is_weixin()) { ?>
 	<div class="fui-cell-group fui-cell-click transparent">
		<a class="fui-cell external changepwd" href="<?php  if(!empty($member['mobileverify'])) { ?><?php  echo mobileUrl('member/changepwd')?><?php  } else { ?><?php  echo mobileUrl('member/bind')?><?php  } ?>">
			<div class="fui-cell-text" style="text-align: center;border: 1px solid #FA871D; color:#FA871D"><p>修改密码</p></div>
		</a>
		<a class="fui-cell external btn-logout">
			<div class="fui-cell-text" style="text-align: center; background-color:#FA871D"><p>退出登录</p></div>
		</a>
	</div>

	<div class="pop-apply-hidden" style="display: none">
		<div class="verify-pop pop">
			<div class="close"><i class="icon icon-roundclose"></i></div>
			<div class="qrcode">
				<div class="inner">
					<div class="title"><?php  echo $set['applytitle'];?></div>
					<div class="text"><?php  echo $set['applycontent'];?></div>
				</div>
				<div class="inner-btn" style="padding: 0.5rem">
					<div class="btn btn-warning" style="width: 100%; margin: 0">我已阅读</div>
				</div>
			</div>
		</div>
	</div>

	<?php  } ?>
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_copyright', TEMPLATE_INCLUDEPATH)) : (include template('_copyright', TEMPLATE_INCLUDEPATH));?>
	</div>
	<script language='javascript'>
		require(['biz/member/index'], function (modal) {
			modal.init();
		});
	</script>
</div>

<script  language='javascript'>
	var lis = $('.banner-ul').find('li');
	$('.banner-ul').width(lis.length*8.3+'rem');

	function addCard(card_id,code) {

		var data = {'openid': '<?php  echo $_W["openid"]?>', 'card_id': card_id, 'code': code};
		$.ajax({
			url: "<?php  echo mobileUrl('sale/coupon/getsignature')?>",
			data: data,
			cache: false
		}).done(function (result) {
			var data = jQuery.parseJSON(result);
			if (data.status == 1) {
				wx.addCard({
					cardList: [
						{
							cardId: card_id,
							cardExt: data.result.cardExt
						}
					],
					success: function (res) {
						//alert('已添加卡券：' + JSON.stringify(res.cardList));
					},
					cancel: function (res) {
						//alert(JSON.stringify(res))
					}
				});
			} else {
				alert("微信接口繁忙,请稍后再试!");
				alert(data.result.message);
			}
		});
	}

</script>

<?php  if(empty($_GPC['isnewstore']) ) { ?>
	<?php  $this->footerMenus()?>
<?php  } else { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../../../plugin/newstore/template/mobile/default/_menu', TEMPLATE_INCLUDEPATH)) : (include template('../../../plugin/newstore/template/mobile/default/_menu', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
