<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Addshuche_EweiShopV2Page extends MobileLoginPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		
		include $this->template();
	}
}

?>
