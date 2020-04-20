<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Yijian_EweiShopV2Page extends MobileLoginPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		
		include $this->template();
	}
  public function submit()
	{
		global $_W;
		global $_GPC;
    	$member = m('member')->getMember($_W['openid'], true);
      	$arr['kf_img']=$_GPC['img'];
    $arr['kf_img1']=$_GPC['img1'];
    $arr['kf_img2']=$_GPC['img2'];
      	$arr['kf_name']=$_GPC['name'];
      	$arr['kf_text']=$_GPC['text'];
      	$arr['kf_mobile']=$_GPC['mobile'];
      	$arr['kf_openid']=$member['openid'];
      	$arr['kf_id']=$member['id'];
      	$arr['kf_mname']=$member['nickname'];	
    	$arr['kf_time']=time();
		pdo_insert('ewei_shop_member_kefu', $arr);
    	show_json(1);

	}
}

?>
