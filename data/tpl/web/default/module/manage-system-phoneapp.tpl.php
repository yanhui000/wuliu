<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">
	应用管理
</div>
<ul class="we7-page-tab">
	<li <?php  if($do == 'installed') { ?>class="active"<?php  } ?>><a href="<?php  echo url('module/manage-system/installed', array('account_type' => ACCOUNT_TYPE))?>">已安装APP应用  </a></li>
	<?php  if($_W['isfounder'] && uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
	<li <?php  if($do == 'not_installed' && $_GPC['status'] != 'recycle') { ?>class="active"<?php  } ?>><a href="<?php  echo url('module/manage-system/not_installed', array('account_type' => ACCOUNT_TYPE))?>">未安装APP应用<span class="color-red">  (<?php  echo $total_uninstalled;?>) </span></a></li>
	<li <?php  if($do == 'not_installed' && $_GPC['status'] == 'recycle') { ?>class="active"<?php  } ?>><a href="<?php  echo url('module/manage-system/not_installed', array('status' => 'recycle', 'account_type' => ACCOUNT_TYPE))?>">已停用APP应用</a></li>
	<?php  } ?>
</ul>
<?php  if($do == 'installed') { ?>
<div id="js-system-module" ng-controller="installedCtrl" ng-cloak>
	<div class="we7-page-search clearfix">
		<form action="" method="get" class="row">
			<div class="form-group we7-margin-bottom  col-sm-4">
				<input type="hidden" name="letter" ng-model="activeLetter">
				<input type="hidden" name="c" value="module">
				<input type="hidden" name="a" value="manage-system">
				<input type="hidden" name="do" value="page">
				<div class="input-group">
					<input class="form-control" name="title" value="<?php  echo $title;?>" type="text" placeholder="名称" >
					<span class="input-group-btn"><button class="btn btn-default" id="search"><i class="fa fa-search"></i></button></span>
				</div>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>

	<ul class="letters-list">
		<li ng-class="activeLetter == letter ? 'active' : ''" ng-repeat="letter in letters"><a href="javascript:;" ng-click="searchLetter(letter)">{{ letter }}</a></li>
	</ul>

	<form action="" method="get">
		<table class="table we7-table table-hover vertical-middle table-manage">
			<col width="120px" />
			<col width="350px"/>
			<col width="230px" />
			<tr>
				<th colspan="2" class="text-left filter">
					<div class="dropdown dropdown-toggle we7-dropdown">
						<a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							安装时间排序
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="" class="active">更新时间排序</a></li>
						</ul>
					</div>
				</th>
				<th class="text-right">
					<?php  if(user_is_founder($_W['uid']) && !user_is_vice_founder($_W['uid'])) { ?>
					<div class="we7-form">
						<input type="checkbox" name="" onclick="filter('new_branch')" id="filter-1" value="1">
						<label class="checkbox-inline" for="filter-1">
							新分支应用
						</label>
						<span class="we7-margin-right"></span>
						<input type="checkbox" name="" onclick="filter('upgrade_branch')" id="filter-2" value="2">
						<label class="checkbox-inline" for="filter-2">
							有升级的应用
						</label>
					</div>
					<?php  } ?>
				</th>
			</tr>
			<tr>
				<th colspan="2" class="text-left bg-light-gray">
					PC应用名/版本
				</th>
				<th class="text-right bg-light-gray">操作</th>
			</tr>
			<tr ng-repeat="module in module_list">
				<td class="text-left module-img">
					<img ng-if="module.main_module == ''" ng-src="{{ module.logo }}" class="img-responsive icon"/>
					<div class="img" ng-if="module.main_module != ''">
						<img src="" alt="子应用icon" class="plugin-img" ng-src="{{ module.logo }}"/>
						<img src="" alt="主应用icon" class="module-img" ng-src="{{ allModules[module.main_module].logo }}"/>
					</div>
				</td>
				<td class="text-left">
					<p>{{ module.title }}</p>
					<span>版本：{{ module.version }} </span><span class="color-red" ng-if="module.upgrade && isFounder == 1">发现新版本</span>
				</td>
				<td class="vertical-middle table-manage-td">
					<div class="link-group">
						<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
						<a ng-href="{{ './index.php?c=module&a=manage-system&do=upgrade&module_name='+module.name}}" class="color-red del" ng-if="module.upgrade && module.from != 'cloud' && isFounder == 1">升级</a>
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&show=upgrade" class="color-red del" ng-if="module.upgrade && module.from == 'cloud' && isFounder == 1">升级</a>
						<?php  } ?>
						<!--<a href="#">进入应用</a>-->
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>&type=<?php echo ACCOUNT_TYPE_PHONEAPP_NORMAL;?>" ng-if="isFounder == 1">管理设置</a>
						<!--<a href="javascript:;" ng-if="isFounder == 1" ng-click="editModule(module.mid)">编辑</a>-->
					</div>
					<div class="manage-option text-right">
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>&type=<?php echo ACCOUNT_TYPE_PHONEAPP_NORMAL;?>" ng-if="isFounder == 1">基本信息</a>
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>&type=<?php echo ACCOUNT_TYPE_PHONEAPP_NORMAL;?>&show=group" ng-if="isFounder == 1">应用权限组</a>
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>&type=<?php echo ACCOUNT_TYPE_PHONEAPP_NORMAL;?>&show=subscribe" ng-if="isFounder == 1 && module.subscribes.length">订阅消息</a>
						<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
						<a href="<?php  echo url('module/manage-system/uninstall')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>" ng-if="isFounder == 1" onclick="return confirm('确认要停用模块吗？')">停用</a>
						<?php  } ?>
					</div>
				</td>
			</tr>
		</table>
		<div class="select-all">
			<div class="we7-form text-right" ng-bind-html="pager">
			</div>
		</div>
	</form>

	<div class="modal fade" id="module-info"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form" id="form-info">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">编辑模块信息</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块标题</label>
							<div class="col-sm-10">
								<input type="text" name="title" ng-model="moduleOriginal.title" class="form-control">
								<span class="help-block">模块的名称, 显示在用户的模块列表中. 不要超过10个字符</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块简述</label>
							<div class="col-sm-10">
								<input type="text" name="ability" ng-model="moduleOriginal.ability" class="form-control">
								<span class="help-block">模块功能描述, 使用简单的语言描述模块的作用, 来吸引用户</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块介绍</label>
							<div class="col-sm-10">
								<textarea type="text" name="description" ng-model="moduleOriginal.description" class="form-control" rows="5">{{ moduleinfo.description }}</textarea>
								<span class="help-block">模块详细描述, 详细介绍模块的功能和使用方法</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块缩略图</label>
							<div class="col-sm-10">
								<div class="we7-input-img" ng-class="{ 'active' : moduleOriginal.logo }" style="width: 100px;height: 100px;">
									<img ng-src="{{ moduleOriginal.logo }}" ng-if="moduleOriginal.logo">
									<a href="javascript:;" class="input-addon" ng-hide="moduleOriginal.logo" ng-click="changePicture('logo')"><span>+</span></a>
									<input type="hidden" name="thumb">
									<div class="cover-dark">
										<a href="javascript:;" class="cut" ng-click="changePicture('logo')">更换</a>
										<a href="javascript:;" class="del" ng-click="delPicture('logo')"><i class="fa fa-times"></i></a>
									</div>
								</div>
								<span class="help-block">用 48*48 的图片来让你的模块更吸引眼球吧。仅支持jpg格式</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块封面</label>
							<div class="col-sm-10">
								<div class="we7-input-img" ng-class="{ 'active' : moduleOriginal.preview}"  style="width: 100px;height: 100px;">
									<img ng-src="{{ moduleOriginal.preview }}">
									<a href="javascript:;" class="input-addon" ng-click="changePicture('preview')"><span>+</span></a>
									<input type="hidden" name="thumb">
									<div class="cover-dark">
										<a href="javascript:;" class="cut" ng-click="changePicture('preview')">更换</a>
										<a href="javascript:;" class="del" ng-click="delPicture('preview')"><i class="fa fa-times"></i></a>
									</div>
								</div>
								<span class="help-block">模块封面, 大小为 600*350, 更好的设计将会获得官方推荐位置。仅支持jpg格式</span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button  class="btn btn-primary" type="text" name="submit" ng-click="save()" data-dismiss="modal">保存</button>
						<input type="hidden" name="token" value="c781f0df">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="upgrade-info"  tabindex="-1" role="dialog" aria-labelledby="myModalLabels" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">模块分支版本信息</h4>
				</div>
				<div class="modal-body">
					<div style="margin:-30px -30px 30px;" class="modal-alert">
						<div class="alert alert-info">
							<p><i class="wi  wi-info-sign"></i> 应用分支按照等级顺序排列。</p>
							<p><i class="wi  wi-info-sign"></i> 如果要升级到其它分支最新版本，需要花费对应分支价格数量的交易币。</p>
							<p><i class="wi  wi-info-sign"></i> 已购买的模块分支可以免费升级到该分支的最新版本。</p>
						</div>
					</div>
					<table class="table we7-table vertical-middle">
						<col width="">
						<col width="180px">
						<col width="400px">
						<tr>
							<th colspan="3" class="text-left">{{ module_list[upgradeInfo.name].title }}---模块分支信息</th>
						</tr>
						<tr>
							<td class="text-left">
								分支名称
							</td>
							<td class="text-center">
								升级价格
							</td>
							<td class="text-right">
								操作
							</td>
						</tr>
						<tr ng-repeat="branch in upgradeInfo.branches">
							<td class="text-left">  {{ branch.name }}</td>
							<td class="text-center">  {{  branch.displayorder > upgradeInfo.site_branch.displayorder ? branch.upgrade_price : 0 }}元</td>

							<td>
								<div class="link-group">
									<a tabindex="2" href="javascript:;" role="button" data-toggle="popover" title="{{ module_list[upgradeInfo.name].title }}升级说明" data-container="#upgrade-info" data-placement="bottom" data-trigger="focus" data-html="true" data-content="{{ branch.version.description }}">升级说明</a>
									<a ng-href="{{ './index.php?c=cloud&a=process&m='+upgradeInfo.name+'&is_upgrade=1' }}" onclick="return confirm('确定要升级到此分之的最新版吗？')" ng-if="branch.id == upgradeInfo.site_branch.id">免费升级到【{{branch.name}}】最新版本</a>
									<a href="javascript:;" ng-click="upgrade(branch.upgrade_price, upgradeInfo.name, branch.id)" ng-if="branch.displayorder > upgradeInfo.site_branch.displayorder">付费升级到【{{branch.name}}】最新版本</a>
								</div>
							</td>
							<script>
								$('[data-toggle="popover"]').popover();
							</script>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	require(['fileUploader'], function() {
		angular.module('moduleApp').value('config', {
			'isFounder' : '<?php  if($_W['isfounder']) { ?>1<?php  } else { ?>2<?php  } ?>',
			'letters': <?php  echo json_encode($letters)?>,
			'module_list': <?php  echo json_encode($module_list)?>,
			'allModules': <?php  echo json_encode($all_modules)?>,
			'editModuleUrl': "<?php  echo url('module/manage-system/get_module_info')?>",
			'saveModuleUrl' :  "<?php  echo url('module/manage-system/save_module_info')?>",
			'checkUpgradeUrl' : "<?php  echo url('module/manage-system/check_upgrade')?>",
			'get_upgrade_info_url' : "<?php  echo url('module/manage-system/get_upgrade_info')?>",
			'pager' : '<?php  echo $pager;?>',
			'filterUrl' : "<?php  echo url('module/manage-system/filter')?>"
		});
		angular.bootstrap($('#js-system-module'), ['moduleApp']);
	});
</script>
<?php  } else if($do == 'not_installed') { ?>
<div id="js-system-module-not_installed" ng-controller="notInstalledCtrl" ng-cloak>
	<div class="we7-page-search clearfix">
		<form action="" method="get" class="row">
			<div class="form-group col-sm-4">
				<div class="input-group we7-margin-bottom">
					<input type="hidden" name="c" value="module">
					<input type="hidden" name="a" value="manage-system">
					<input type="hidden" name="do" value="not_installed">
					<input type="hidden" name="status" value="<?php  if($status == 'recycle') { ?>recycle<?php  } else { ?>uninstalled<?php  } ?>">
					<input type="hidden" name="letter" value="<?php  echo $letter;?>">
					<input class="form-control" name="title" value="<?php  echo $title;?>" type="text" placeholder="名称" >
					<span class="input-group-btn"><button id="search" class="btn btn-default"><i class="fa fa-search"></i></button></span>
				</div>
			</div>
		</form>
	</div>
	<div class="clearfix">	</div>

	<ul class="letters-list">
		<li ng-repeat="letter in letters"><a href="javascript:;" ng-click="searchLetter(letter)">{{ letter }}</a></li>
	</ul>

	<table class="table we7-table table-hover vertical-middle table-manage">
		<tr>
			<th colspan="2" class="text-left">APP应用名</th>
			<th class="text-right">操作</th>
		</tr>
		<tr ng-repeat="module in module_list">
			<td class="text-left module-img">
				<img ng-src="{{ module.logo }}" alt="" style="width:50px;height:50px;" ng-if="module.main_module == ''">
				<div class="img" ng-if="module.main_module != ''">
					<img ng-src="{{ module.logo }}" alt="子应用icon" class="plugin-img"/>
					<img ng-src="{{ module.main_module_logo }}" alt="主应用icon" class="module-img"/>
				</div>
			</td>
			<td class="text-left">
				<p>{{ module.title }}</p>
				<span>版本：{{ module.version }} </span>
			</td>
			<td class="text-right">
				<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
				<a href="<?php  echo url('module/manage-system/upgrade')?>&module_name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>" ng-if="module.upgrade_support == true" class="btn btn-primary">安装应用模块</a>
				<a href="<?php  echo url('module/manage-system/install')?>&module_name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>" ng-if="module.upgrade_support != true" class="btn btn-primary">安装应用模块</a>
				<?php  } ?>
			</td>
		</tr>
	</table>
	</form>
	<div class="text-right">
		<?php  echo $pager;?>
	</div>
</div>
<script>
	angular.module('moduleApp').value('config', {
		'letters' : <?php  echo json_encode($letters)?>,
		'module_list' : <?php  echo json_encode($uninstall_modules)?>
	});
	angular.bootstrap($('#js-system-module-not_installed'), ['moduleApp']);
</script>
<?php  } else if($do == 'module_detail') { ?>
<div class="js-system-module-detail" ng-controller="detailCtrl" ng-cloak>
	<ol class="breadcrumb we7-breadcrumb">
		<a href="<?php  echo referer()?>"><i class="wi wi-back-circle"></i> </a>
		<li>
			应用列表
		</li>
		<li>
			应用管理
		</li>

	</ol>
	<div class="user-head-info we7-padding-bottom">
		<span class="icon pull-left" ng-if="moduleinfo.app_support == 2"><i class="wi wi-wx-apply"></i></span>
		<span class="icon pull-left" ng-if="moduleinfo.wxapp_support == 2 && moduleinfo.app_support != 2"><i class="wi wi-wxapp-apply"></i></span>
		<div class="img pull-left" ng-if="moduleinfo.main_module != ''">
			<img alt="子应用icon" class="plugin-img" ng-src="{{ moduleinfo.logo }}"/>
			<img alt="主应用icon" class="module-img" ng-src="{{ moduleinfo.main_module_logo }}"/>
		</div>
		<img ng-src="{{ moduleinfo.logo }}" class="user-avatar img-rounded pull-left" ng-if="moduleinfo.main_module == ''">
		<h3 class="pull-left">{{ moduleinfo.title }}</h3>
		<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
		<a ng-if="isFounder == 1 && moduleinfo.cloud_mid != ''" ng-href="{{ 'http://s.we7.cc/module-' + moduleinfo.cloud_mid + '.html' }}" target="_blank" class="btn btn-primary pull-right">查看商城详情</a>
		<?php  } ?>
	</div>

	<div class="btn-group we7-btn-group we7-margin-bottom">
		<a href="javascript:;" ng-click="changeShow('base')" class="btn " ng-class="{'active' : show == 'base' || show == ''}">基本信息</a>
		<a href="javascript:;" ng-click="changeShow('plugin')" class="btn " ng-class="{'active' : show == 'plugin'}" ng-show="moduleinfo.main_module == '' && moduleinfo.plugin_list != undefined && moduleinfo.plugin_list != ''">模块子应用</a>
		<a href="javascript:;" ng-click="changeShow('group')" class="btn " ng-class="{'active' : show == 'group'}">应用权限组</a>
		<!--<a href="javascript:;" class="btn">公众号列表</a>-->
		<?php  if(!empty($module_subscribes)) { ?>
		<a href="javascript:;" ng-click="changeShow('subscribe')" class="btn " ng-class="{'active' : show == 'subscribe'}">订阅消息</a>
		<?php  } ?>
		<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
		<a  href="javascript:;" ng-click="changeShow('upgrade')" class="btn " ng-class="{'active' : show == 'upgrade'}" ng-show="checkupgrade == 1">升级</a>
		<?php  } ?>

	</div>

	<table class="table we7-table table-hover table-form" ng-show="show == 'base' || show == ''">
		<col width="140px">
		<col />
		<col width="100px">
		<tr>
			<th class="text-left" colspan="3">编辑模块基本信息</th>
		</tr>
		<tr>
			<td class="table-label">模块标题</td>
			<td>{{ moduleinfo.title }}</td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('title', moduleinfo.title)">修改</a></div>
			</td>
		</tr>
		<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
		<tr>
			<td class="table-label">模块作者</td>
			<td colspan="2">{{ moduleinfo.author }}</td>
		</tr>
		<tr>
			<td class="table-label">模块版本</td>
			<td colspan="2">{{ moduleinfo.version }}</td>
		</tr>
		<?php  } ?>
		<tr>
			<td class="table-label">模块简述</td>
			<td>{{ moduleinfo.ability }}</td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('ability', moduleinfo.ability)">修改</a></div>
			</td>
		</tr>
		<tr>
			<td class="table-label">模块介绍</td>
			<td>{{ moduleinfo.description }}</td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('description', moduleinfo.description)">修改</a></div>
			</td>
		</tr>
		<tr>
			<td class="table-label">模块缩略图</td>
			<td><img ng-src="{{ moduleinfo.logo }}" alt="" style="width:65px; height:65px;" class="img-rounded"/></td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('logo', moduleinfo.logo)">修改</a></div>
			</td>
		</tr>
		<tr>
			<td class="table-label">模块封面</td>
			<td><img ng-src="{{ moduleinfo.preview }}" alt="" style="width:65px; height:65px;" class="img-rounded"/></td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('preview', moduleinfo.preview)">修改</a></div>
			</td>
		</tr>
	</table>
	<?php  if(!empty($module_info['is_relation'])) { ?>
	<table class="table we7-table table-hover vertical-middle table-manage" ng-show="show != 'workorder'">
		<col width="150px"/>
		<col />
		<col />
		<tr>
			<th colspan="3" class="text-left">可关联</th>
		</tr>
		<tr>
			<td class="text-left">
				{{ moduleinfo.relation_name }}
			</td>
			<td class="text-left">
				<img ng-src="{{ moduleinfo.logo }}" class="img-responsive pull-left" style="width: 50px;height: 50px; margin-right: 10px;"/>
				<p>{{ moduleinfo.title }}</p>
				<span class="color-gray">版本：{{ moduleinfo.version }} </span>
			</td>
			<td class="text-right">
				<div class="link-group"><a href="<?php  echo url('module/manage-system/module_detail')?>name={{moduleinfo.name}}&account_type={{moduleinfo.account_type}}&type={{moduleinfo.type}}">查看</a></div>
			</td>
		</tr>
	</table>
	<?php  } ?>
	<div class="panel we7-panel" ng-show="show == 'plugin' && moduleinfo.main_module == ''">
		<div class="panel-heading">
			模块子应用
		</div>
		<div class="panel-body">
			<div class="plugin-list clearfix">
				<div class="item" ng-repeat="plugin in moduleinfo.plugin_list">
					<a href="<?php  echo url('module/manage-system/module_detail')?>name={{plugin.name}}" target="_blank">
						<div class="img">
							<img ng-src="{{ plugin.logo }}" alt="子应用icon" class="plugin-img"/>
							<img ng-src="{{ moduleinfo.logo }}" alt="主应用icon" class="module-img"/>
						</div>
						<div class="name">{{ plugin.title }}</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<table class="table we7-table table-hover vertical-middle" ng-show="show == 'upgrade'" ng-if="isFounder == 1 && upgradeInfo.from == 'local'">
		<col width="300px"/>
		<col />
		<col />
		<col />
		<col width="200px;"/>
		<tr>
			<th>目前版本</th>
			<th>最新版本</th>
			<th class="text-right">操作</th>
		</tr>
		<tr>
			<td>{{ moduleinfo.version }}</td>
			<td>{{ upgradeInfo.best_version }}</td>
			<td class="text-right">
				<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
				<a href="<?php  echo url('module/manage-system/upgrade')?>module_name={{ moduleinfo.name }}" class="btn btn-danger">升级</a>
				<?php  } ?>
			</td>
		</tr>
	</table>
	<table class="table we7-table table-hover vertical-middle" ng-show="show == 'upgrade'" ng-if="isFounder == 1 && upgradeInfo.from == 'cloud' && branch.displayorder >= upgradeInfo.site_branch.displayorder" ng-repeat="branch in upgradeInfo.branches">
		<col width="300px"/>
		<col />
		<col />
		<col />
		<col width="200px"/>
		<tr>
			<th class="text-left">分支名称</th>
			<th>分支价格</th>
			<th>目前版本</th>
			<th>最新版本</th>
			<th class="text-right">操作</th>
		</tr>
		<tbody>
		<tr>
			<td class="text-left">{{ branch.name }}</td>
			<td class="color-red">{{ branch.displayorder > upgradeInfo.site_branch.displayorder || (branch.displayorder == upgradeInfo.site_branch.displayorder && branch.id > upgradeInfo.site_branch.id) ? branch.upgrade_price : ''}}<span class="label label-success" ng-if="branch.id == upgradeInfo.site_branch.id">当前分支</span></td>
			<td>{{ upgradeInfo.site_branch.id == branch.id ? moduleinfo.version : ''}}</td>
			<td>{{ branch.version.version }}</td>
			<td class="text-right">
				<span class="text text-success" ng-if="branch.id == upgradeInfo.site_branch.id && branch.version.version ==  moduleinfo.version">无需升级</span>
				<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
				<a href="javascript:;" ng-click="notice(service_expire, upgradeInfo.id, upgradeInfo.name)" ng-if="branch.id == upgradeInfo.site_branch.id && branch.version.version !=  moduleinfo.version" class="btn btn-primary">升级</a>
				<?php  } ?>
				<a href="javascript:;" ng-click="upgrade(branch.upgrade_price, upgradeInfo.name, upgradeInfo.id)" ng-if="branch.displayorder > upgradeInfo.site_branch.displayorder || (branch.displayorder == upgradeInfo.site_branch.displayorder && branch.id > upgradeInfo.site_branch.id)" class="btn btn-danger">购买</a>
			</td>
		</tr>
		<tr>
			<td class="text-left">{{ branch.id == upgradeInfo.site_branch.id ? '版本更新内容' : ''}}</td>
			<td colspan="4" class="text-right">
				<a class="color-default view-detail" ng-if="branch.id == upgradeInfo.site_branch.id && branch.version.version !=  moduleinfo.version" href="javascript:;" data-id="{{ branch.id }}" onclick="change($(this))">查看详情 <i class="wi wi-angle-down"></i></a>
				<a href="http://s.we7.cc/module-{{upgradeInfo.id}}.html" ng-if="branch.displayorder > upgradeInfo.site_branch.displayorder || (branch.displayorder == upgradeInfo.site_branch.displayorder && branch.id > upgradeInfo.site_branch.id)" class="color-default view-detail" target="_blank">查看分支详情</a>
			</td>
		</tr>
		<tr id="version-detail-{{ branch.id }}" style="display:none">
			<td colspan="5" class="details-versions">
				<div class="js-version-lists">

					<div class="details-version">
						<div class="details-version-time">
							<p class="time-d">{{ branch.day }}</p>
							<p class="time-y-m">{{ branch.month }}</p>
						</div>
						<i class="fa fa-circle-o"></i>
						<div class="details-version-content">
							<div class="panel panel-version">
								<div class="panel-heading">
									版本号：{{ branch.version.version }} - {{ branch.name }}  <span class="time-h" ng-bind="branch.hour"></span>
								</div>
								<div class="panel-body" ng-bind-html="branch.version.description">
								</div>
							</div>
						</div>
					</div>

				</div>
				<?php  if($recent_versions['total'] > 10) { ?>
				<div class="text-center">
					<a href="javascript:;" class="btn c-blue js-versions-more">加载更多<i class="fa fa-angle-down"></i></a>
				</div>
				<?php  } ?>
			</td>
		</tr>
		</tbody>
	</table>
	<div class="module-group" ng-if="isFounder == 1">
		<table class="table we7-table table-hover" ng-show="show == 'group'">
			<col />
			<col width="100px" />
			<tr>
				<th class="text-left">
					应用权限组
				</th>
				<th class="text-right">
					<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
					<a href="<?php  echo url('module/group')?>" class="color-default">添加</a>
					<?php  } ?>
				</th>
			</tr>
			<tr>
				<td class="text-left">
					<span>所有服务</span>
				</td>
				<td>
				</td>
			</tr>
			<?php  if(is_array($module_group)) { foreach($module_group as $group) { ?>
			<tr>
				<td class="text-left">
					<span><?php  echo $group['name'];?></span>
				</td>
				<td class="text-right">
					<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
					<div class="link-group"><a href="<?php  echo url('module/group/post', array('id' => $group['id']))?>">设置</a></div>
					<?php  } ?>
				</td>
			</tr>
			<?php  } } ?>
		</table>
	</div>
	<?php  if(!empty($module_subscribes)) { ?>
	<div class="panel we7-panel module-subscription" ng-if="isFounder == 1" ng-show="show == 'subscribe'">
		<div class="panel-heading ">
			订阅详情
			<div class="pull-right subscription-switch">
				<span >启用订阅</span>
				<label>
					<input name="" id="" class="form-control" type="checkbox"  style="display: none;">
					<div class="switch" ng-class="{ 'switchOn' : receive_ban == 0}" ng-click="changeSwitch()"></div>
				</label>
			</div>
		</div>
		<div class="panel-body">
			<ul>
				<?php  if(is_array($module_subscribes)) { foreach($module_subscribes as $subscribe) { ?>
				<li><?php  echo $mtypes[$subscribe];?> <label ng-if="subscribe == 2" class="label label-danger">通讯失败</label>  </li>
				<?php  } } ?>
			</ul>
		</div>
	</div>
	<?php  } ?>
	<table class="table we7-table table-hover" ng-if="isFounder == 1">
		<col width="255px"/>
		<col width="130px"/>
		<col width="250px"/>
		<col width="122px"/>
		<col />
	</table>
	<div class="modal fade" id="module-info"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">编辑模块信息</h4>
				</div>
				<div class="modal-body">
					<div class="form-group" ng-show="editType == 'title'">
						<label class="col-sm-2 control-label"> 模块标题</label>
						<div class="col-sm-10">
							<input type="text" name="title" ng-model="moduleOriginal.title" class="form-control">
							<span class="help-block">模块的名称, 显示在用户的模块列表中. 不要超过10个字符</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'ability'">
						<label class="col-sm-2 control-label"> 模块简述</label>
						<div class="col-sm-10">
							<input type="text" name="ability" ng-model="moduleOriginal.ability" class="form-control">
							<span class="help-block">模块功能描述, 使用简单的语言描述模块的作用, 来吸引用户</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'description'">
						<label class="col-sm-2 control-label"> 模块介绍</label>
						<div class="col-sm-10">
							<textarea type="text" name="description" ng-model="moduleOriginal.description" class="form-control" rows="5">{{ moduleinfo.description }}</textarea>
							<span class="help-block">模块详细描述, 详细介绍模块的功能和使用方法</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'logo'">
						<label class="col-sm-2 control-label"> 模块缩略图</label>
						<div class="col-sm-10">
							<div class="we7-input-img" ng-class="{ 'active' : moduleOriginal.logo }" style="width: 100px;height: 100px;">
								<img ng-src="{{ moduleOriginal.logo }}" ng-if="moduleOriginal.logo">
								<a href="javascript:;" class="input-addon" ng-hide="moduleOriginal.logo" ng-click="changePicture('logo')"><span>+</span></a>
								<input type="hidden" name="thumb">
								<div class="cover-dark">
									<a href="javascript:;" class="cut" ng-click="changePicture('logo')">更换</a>
									<a href="javascript:;" class="del" ng-click="delPicture('logo')"><i class="fa fa-times text-danger"></i></a>
								</div>
							</div>
							<span class="help-block">用 48*48 的图片来让你的模块更吸引眼球吧。仅支持jpg格式</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'preview'">
						<label class="col-sm-2 control-label"> 模块封面</label>
						<div class="col-sm-10">
							<div class="we7-input-img" ng-class="{ 'active' : moduleOriginal.preview}"  style="width: 100px;height: 100px;">
								<img ng-src="{{ moduleOriginal.preview }}">
								<a href="javascript:;" class="input-addon" ng-click="changePicture('preview')"><span>+</span></a>
								<input type="hidden" name="thumb">
								<div class="cover-dark">
									<a href="javascript:;" class="cut" ng-click="changePicture('preview')">更换</a>
									<a href="javascript:;" class="del" ng-click="delPicture('preview')"><i class="fa fa-times text-danger"></i></a>
								</div>
							</div>
							<span class="help-block">模块封面, 大小为 600*350, 更好的设计将会获得官方推荐位置。仅支持jpg格式</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button  class="btn btn-primary" type="text" name="submit" ng-click="save()" data-dismiss="modal">保存</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<input type="hidden" name="token" value="c781f0df">
				</div>
			</div>
		</div>
	</div>

</div>

<script>
	require(['fileUploader'], function() {
		angular.module('moduleApp').value('config', {
			'isFounder' : "<?php  if($_W['isfounder']) { ?>1<?php  } else { ?>2<?php  } ?>",
			'receive_ban' : "<?php  echo $receive_ban;?>",
			'show' : "<?php  echo $_GPC['show'];?>",
			'moduleInfo' : <?php  echo json_encode($module_info)?>,
			'url' : "<?php  echo url('module/manage-system/change_receive_ban')?>",
			'modulename' : "<?php  echo $module_info['name'];?>",
			'editModuleUrl' : "<?php  echo url('module/manage-system/get_module_info')?>",
			'saveModuleUrl' : "<?php  echo url('module/manage-system/save_module_info')?>",
			'checkReceiveUrl' : "<?php  echo url('module/manage-system/check_subscribe')?>",
			'checkUpgradeUrl' : "<?php  echo url('module/manage-system/check_upgrade')?>",
			'get_upgrade_info_url' : "<?php  echo url('module/manage-system/get_upgrade_info')?>"
	});
	angular.bootstrap($('.js-system-module-detail'), ['moduleApp']);
	});

	if(window.addEventListener) {
		window.addEventListener('message', function(e){
			$('#workorderiframe').height(e.data.height+200); //选中图片导致高度又变高了
		});
	}
	$.getJSON("<?php  echo url('system/workorder/module')?>name=<?php  echo $module_info['name'];?>", function(data){
		if(data.errno == 0) {
			$('#workorderiframe').attr('src',data.data.url);
		}
	});
</script>
<?php  } else if($do == 'subscribe') { ?>
<div class="alert alert-info">
	如果模块测试订阅消息失败，为了不影响系统整体通知，请禁用这些通知失败的模块
</div>
<div class="js-system-module-subscribe" ng-controller="subscribeCtrl" ng-cloak>
 <div class="panel panel-default js-test" ng-repeat="(name, module) in subscribe_module track by name">
	<div class="panel-heading clearfix">
		<div class="pull-right" ng-click="change_ban(module.name)">
			<input class="form-control" type="checkbox"  style="display: none;">
			<div ng-class="module.receive_ban == 0 ? 'switch switchOn' : 'switch'"></div>
		</div>
		{{ module.title }}
	</div>
	<div class="panel-body clearfix">
		<div class="col-md-3 col-sm-4 col-xs-6 item" style="line-height: 30px; cursor:pointer;" ng-repeat="subscribe in module.subscribe">
			{{ types[subscribe] }}
			<p class="pull-right">
				<span class="label label-success" ng-if="module.subscribe_success == 1">正常</span>
				<span class="label label-danger" ng-if="module.subscribe_success == 2">失败</span>
			</p>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	angular.module('moduleApp').value('config', {
		'subscribe_module' : <?php  echo json_encode($subscribe_module)?>,
		'types' : <?php  echo json_encode($subscribe_type)?>,
		'change_ban_url' : "<?php  echo url('module/manage-system/change_receive_ban')?>",
		'check_receive_url' : "<?php  echo url('module/manage-system/check_subscribe')?>"
	});
	angular.bootstrap($('.js-system-module-subscribe'), ['moduleApp']);
</script>
<?php  } else if($do == 'install_success') { ?>
<div class="steps">
	<div class="steps-item steps-status-wait">
		<div class="steps-line"><span class="steps-num">1</span></div>
		<div class="steps-state">安装应用</div>
	</div>
	<div class="steps-item steps-status-wait">
		<div class="steps-line"><span class="steps-num">2</span></div>
		<div class="steps-state">分配应用权限</div>
	</div>
	<div class="steps-item steps-status-finish">
		<div class="steps-line"><span class="steps-num">3</span></div>
		<div class="steps-state">安装成功</div>
	</div>
</div>
<div class="distribution-steps">
	<div class="we7-margin-bottom-sm font-lg">应用分配到公众号使用的流程说明</div>
	<div class="steps-container">
		<div>
			<div class="num">1</div>
			<div class="title">
				<span class="wi wi-appjurisdiction"></span>添加应用权限组
			</div>
			<div class="content">
				设置应用权限组名称，选择需要添加的公众号应用、小程序应用、微站模板，保存提交。
				<div><a href="<?php  echo url('module/group/post')?>" class="color-default">去添加应用组 ></a></div>
			</div>
		</div>
		<div>
			<div class="num">2</div>
			<div class="title">
				<span class="wi wi-userjurisdiction"></span>添加用户权限组
			</div>
			<div class="content">
				设置用户权限组名称，选择可以添加的的公众号，小程序数量、有效期并选择应用权限组，然后保存提交。
				<div><a href="<?php  echo url('user/group/post')?>" class="color-default">去添加用户权限组 ></a></div>
			</div>
		</div>
		<div>
			<div class="num">3</div>
			<div class="title">
				<span class="wi wi-user-group"></span>分配用户权限组
			</div>
			<div class="content">
				改用户组权限，分配成功后此用户组即可使用该应用组的所有应用。
				<div><a href="<?php  echo url('user/group')?>" class="color-default">去分配用户组 ></a></div>
			</div>
		</div>
	</div>
</div>
<div class="we7-margin-bottom">
	<a class="btn btn-primary" href="<?php  echo url('module/manage-system/installed', array('account_type' => ACCOUNT_TYPE))?>">返回已安装应用列表</a>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>