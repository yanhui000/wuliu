<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

return array(
	'version'     => '1.0',
	'id'          => 'merch',
	'name'        => '多商户',
	'v3'          => true,
	'menu'        => array(
		'title'     => '页面',
		'plugincom' => 1,
		'icon'      => 'page',
		'items'     => array(
			array(
				'title'   => '入驻申请',
				'route'   => 'reg',
				'extends' => array('merch.reg.detail'),
				'items'   => array(
					array(
						'title' => '申请中',
						'param' => array('status' => 0)
						),
					array(
						'title' => '驳回',
						'param' => array('status' => -1)
						)
					)
				),
			array(
				'title' => '商户管理',
				'route' => 'user',
				'items' => array(
					array(
						'title' => '待入驻',
						'param' => array('status' => 0)
						),
					array(
						'title' => '入驻中',
						'param' => array('status' => 1)
						),
					array(
						'title' => '暂停中',
						'param' => array('status' => 2)
						),
					array(
						'title' => '即将到期',
						'param' => array('status' => 3)
						),
					array('title' => '商户分组', 'route' => 'group', 'route_ns' => true),
					array('title' => '商户分类', 'route' => 'category', 'route_ns' => true)
					)
				),
			array(
				'title' => '数据统计',
				'route' => 'statistics',
				'items' => array(
					array('title' => '订单统计', 'route' => 'order'),
					array('title' => '商户统计', 'route' => 'merch')
					)
				),
			array(
				'title'   => '提现申请',
				'route'   => 'check',
				'items'   => array(
					array('title' => '待确认申请', 'route' => 'status1'),
					array('title' => '待打款申请', 'route' => 'status2'),
					array('title' => '已打款申请', 'route' => 'status3'),
					array('title' => '无效申请', 'route' => 'status_1')
					),
				'extends' => array('merch.check.detail')
				),
			array(
				'title' => '其他设置',
				'items' => array(
					array('title' => '基础设置', 'route' => 'set'),
					array('title' => '通知设置', 'route' => 'notice'),
					array(
						'title'   => '入口设置',
						'route'   => 'cover.register',
						'extends' => array('merch.cover.merchlist', 'merch.cover.merchuser')
						),
					array('title' => '商户分类幻灯', 'route' => 'category.swipe', 'extend' => 'merch.category.edit_swipe')
					)
				)
			)
		),
	'manage_menu' => array(
	
		'order'      => array(
			'title'    => '订单',
			'subtitle' => '订单管理',
			'icon'     => 'order',
			'main'     => true,
			'items'    => array(
				array('title' => '待发货', 'route' => 'list.status1', 'desc' => '待发货订单管理'),
				array('title' => '待收货', 'route' => 'list.status2', 'desc' => '待收货订单管理'),
				array('title' => '待付款', 'route' => 'list.status0', 'desc' => '待付款订单管理'),
				array('title' => '已完成', 'route' => 'list.status3', 'desc' => '已完成订单管理'),
				array('title' => '待领取', 'route' => 'list.status10', 'desc' => '待领取订单管理'),
				array('title' => '已关闭', 'route' => 'list.status_1', 'desc' => '已关闭订单管理'),
				array('title' => '全部订单', 'route' => 'list', 'desc' => '全部订单列表'),
				array(
					'title' => '维权',
					'route' => 'list',
					'items' => array(
						array('title' => '维权申请', 'route' => 'status4', 'desc' => '维权申请管理'),
						array('title' => '维权完成', 'route' => 'status5', 'desc' => '维权完成管理')
						)
					),
				array(
					'title' => '工具',
					'items' => array(
						array('title' => '自定义导出', 'route' => 'export', 'desc' => '订单自定义导出'),
						array('title' => '批量发货', 'route' => 'batchsend', 'desc' => '订单批量发货')
						)
					)
				)
			),

		'apply'      => array(
			'title'    => '结算',
			'subtitle' => '结算',
			'icon'     => '31',
			'main'     => true,
			'items'    => array(
				array('title' => '待审核申请', 'route' => 'list.status1'),
				array('title' => '待结算申请', 'route' => 'list.status2'),
				array('title' => '已结算申请', 'route' => 'list.status3'),
				array('title' => '已无效申请', 'route' => 'list.status_1'),
				array('title' => '申请提现', 'route' => 'list.add')
				)
			),
	
		)
	);

?>
