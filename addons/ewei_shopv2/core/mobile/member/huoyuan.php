<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Huoyuan_EweiShopV2Page extends MobilePage
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
	public function submit(){
		global $_W;
		global $_GPC;
		if(empty($_GPC['uid']) || empty($_GPC['token'])){
			show_json(0, '未知错误');
		}
		$ress = pdo_fetch('SELECT * FROM' . tablename('ewei_shop_member') . 'WHERE id=:id AND pwd=:pwd', array(':id' => $_GPC['uid'], ':pwd' =>$_GPC['token']));
		if($ress){
			$openid=$ress['openid'];
		}else{
			show_json(0, '用户id或token错误');
		}
		$data['zhaddr']=$_GPC['areas'].$_GPC['areaszhuang'];
		$data['hwxx']=$_GPC['huoxianxi'];
		$data['cxcc']=$_GPC['chexingval'];
		$data['isvirtual']=0;
        $data['isvirtualsend']=0;
		$data['jzjx']=$_GPC['zhaungxie'];
		$data['zhtime']=$_GPC['areas5'];
		$data['remark']=$_GPC['fuwu'];
		$data['price']=intval($_GPC['yunfeiqi']);
		$data['grprice']=intval($_GPC['yunfeiqi']);
		$data['paytype']=0;
        $data['coupongoodprice']=0.00;
		$data['status']=10;
		$data['goodsprice']=intval($_GPC['yunfeiqi']);
		$data['openid']=$openid;
		$data['createtime']=time();
		$data['uniacid']=$_W['uniacid'];
		$data['ordersn']=m('common')->createNO('order', 'ordersn', 'SH');
		$data1['uniacid']=$_W['uniacid'];
		$data1['openid']=$openid;
		$addr=explode(' ', $_GPC['areas3']);
		$data1['province']=$addr[0];
		$data1['city']=$addr[1];
		$data1['area']=$addr[2];
		$data1['address']=$_GPC['areasxie'];
		pdo_insert('ewei_shop_member_address', $data1);
		$id = pdo_insertid();
		$data['addressid']=$id;
	//	var_dump($data);die;
		pdo_insert('ewei_shop_order', $data);
		$orid = pdo_insertid();
		$data2['uniacid']=$_W['uniacid'];
		$data2['goodsid']=198;
		$data2['price']=intval($_GPC['yunfeiqi']);
		$data2['total']=1;
		$data2['createtime']=time();
		$data2['realprice']=intval($_GPC['yunfeiqi']);
		$data2['oldprice']=intval($_GPC['yunfeiqi']);
		$data2['openid']=$openid;
		$data2['orderid']=$orid;
		pdo_insert('ewei_shop_order_goods', $data2);
		show_json(1, '信息发布成功等待快递人员联系');
	}
}

?>
