<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='fui-page  fui-page-current'>
    <div class="fui-header">
		<div class="fui-header-left">
			<a class="back" onclick='location.back()'></a>
		</div>
		<div class="title">修改密码</div>
		<div class="fui-header-right">&nbsp;</div>
	</div>

	<div class='fui-content' style='margin-top:5px;'>

		<div class="fui-cell-group">

			<div class="fui-cell must">
				<div class="fui-cell-label">手机号</div>
				<div class="fui-cell-info"><?php  echo $member['mobile'];?></div>
				<input type="hidden" id="mobile" value="<?php  echo $member['mobile'];?>" />
			</div>

			<?php  if(!empty($wapset['smsimgcode'])) { ?>
			<div class="fui-cell must">
				<div class="fui-cell-label">图形验证码</div>
				<div class="fui-cell-info">
					<input type="tel" class="fui-input" value="" placeholder="请输入图形验证码" name="verifycode2" id="verifycode2" maxlength="4" />
				</div>
				<div class="remark noremark">
					<img src="../web/index.php?c=utility&a=code&r=<?php  echo time()?>" style="width: 3.5rem; height: 1.5rem; vertical-align: middle;" id="btnCode2">
				</div>
			</div>
			<?php  } ?>

			<div class="fui-cell must">
				<div class="fui-cell-label">短信验证码</div>
				<div class="fui-cell-info"><input type="tel" class='fui-input' id='verifycode' name='verifycode' placeholder="5位验证码"  value="" maxlength="5" /></div>
				<div class="fui-cell-remark noremark"><a class="btn btn-default btn-default-o btn-sm" id="btnCode">获取验证码</a></div>
			</div>

			<div class="fui-cell must">
				<div class="fui-cell-label">新密码</div>
				<div class="fui-cell-info"><input type="password" class='fui-input' id='pwd' name='pwd' placeholder="请输入您的登录密码"  value="" /></div>
			</div>
			<div class="fui-cell must">
				<div class="fui-cell-label">确认密码</div>
				<div class="fui-cell-info"><input type="password" class='fui-input' id='pwd1' name='pwd1' placeholder="请输入确认登录密码"  value="" /></div>
			</div>

		</div>

		<a href='#' id='btnSubmit' class='btn btn-success block'>立即修改</a>
	</div>
	<script language='javascript'>
		require(['biz/member/account'], function (modal) {
		  	modal.initChange({endtime: <?php  echo intval($endtime)?>});
		});
</script>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>


<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+4-->