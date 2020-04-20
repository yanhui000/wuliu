<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Callrecords_EweiShopV2Page extends MobileLoginPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		
		include $this->template();
	}
}

?>
