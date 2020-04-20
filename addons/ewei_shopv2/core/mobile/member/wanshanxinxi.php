<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Wanshanxinxi_EweiShopV2Page extends MobileLoginPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$area_set = m('util')->get_area_config_set();
		$new_area = intval($area_set['new_area']);
		$address_street = intval($area_set['address_street']);
		include $this->template();
	}
	
}

?>
