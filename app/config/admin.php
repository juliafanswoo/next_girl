<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//會員群組權限管理，紀錄每個groupid的會員能夠使用那些功能
$config['group_purview_Arr'] = array(
	'0' => array(//超級管理員
	),
	'1' => array(//總管理員
		array('base', 'global', 'global'),
		array('base', 'pic', 'pic'),
		array('base', 'pic', 'album'),
		array('base', 'note', 'note'),
		array('base', 'note', 'classmeta'),
		array('base', 'user', 'user'),
		array('base', 'user', 'classmeta'),
		array('shop', 'store', 'product'),
		array('shop', 'store', 'showpiece'),
		array('shop', 'product', 'product'),
		array('shop', 'product', 'classmeta'),
		array('shop', 'product', 'classmeta2'),
		array('shop', 'product', 'classmeta3'),
		array('shop', 'showpiece', 'showpiece'),
		array('shop', 'showpiece', 'classmeta'),
		array('shop', 'showpiece', 'classmeta2'),
		array('shop', 'order_shop', 'order_shop'),
		array('user', 'global', 'global')
	),
	'2' => array(//管理員
	),
	'100' => array(//一般會員
		array('user', 'global', 'global'),
		array('user', 'order', 'order')
	),
	'101' => array(//進階會員
	)
);

//後台架構
$config['admin_sidebox'] = array(
		'base' => array(
			'title' => '基本管理',
			'child2' => array(
				'global' => array(
					'title' => '全域管理',
					'child3' => array(
						'global' => array(
							'title' => '全域',
							'child4' => array(
								'common' => array('title' => '基本設置'),
								'seo' => array('title' => 'SEO標籤'),
								'plugin' =>array('title' => '第三方外掛')
							)
						),
					)
				),
				// 'webcontent' => array(
				// 	'title' => '內容管理',
				// 	'child3' => array(
				// 		'webcontent' => array(
				// 			'title' => '內容',
				// 			'child4' => array(
				// 				'edit' => array('title' => '首頁內容')
				// 			)
				// 		)
				// 	)
				// ),
				'advertising' => array(
					'title' => '廣告管理',
					'child3' => array(
						'advertising' => array(
							'title' => '廣告',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '廣告分類',
							'child4' => array(
								// 'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'note' => array(
					'title' => '文章管理',
					'child3' => array(
						'note' => array(
							'title' => '文章',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '分類標籤',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'pic' => array(
					'title' => '照片管理',
					'child3' => array(
						'pic' => array(
							'title' => '照片',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'album' => array(
							'title' => '相簿',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'user' => array(
					'title' => '會員管理',
					'child3' => array(
						'user' => array(
							'title' => '會員',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '會員群組',
							'child4' => array(
								// 'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				)
				// 'page' => array(
				// 	'title' => '動態頁面',
				// 	'child3' => array(
				// 		'page' => array(
				// 			'title' => '頁面',
				// 			'child4' => array(
				// 				'edit' => array('title' => '編輯'),
				// 				'tablelist' => array('title' => '列表')
				// 			)
				// 		),
				// 		'set' => array(
				// 			'title' => '設置',
				// 			'child4' => array(
				// 				'common' => array('title' => '一般')
				// 			)
				// 		)
				// 	)
				// )
			)
		),
		'shop' => array(
			'title' => '購物系統',
			'child2' => array(
				'store' => array(
					'title' => '商店設定',
					'child3' => array(
						'product' => array(
							'title' => '銷售',
							'child4' => array(
								'hot' => array('title' => '設置')
							)
						),
						'showpiece' => array(
							'title' => '租賃',
							'child4' => array(
								'hot' => array('title' => '設置')
							)
						)
					)
				),
				'product' => array(
					'title' => '銷售產品',
					'child3' => array(
						'product' => array(
							'title' => '產品',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '產品分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta2' => array(
							'title' => '二級分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'showpiece' => array(
					'title' => '租賃產品',
					'child3' => array(
						'showpiece' => array(
							'title' => '產品',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '產品分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta2' => array(
							'title' => '二級分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'order_shop' => array(
					'title' => '訂單管理',
					'child3' => array(
						'order_shop' => array(
							'title' => '訂單',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				)
			)
		),
		'user' => array(
			'title' => '會員功能',
			'child2' => array(
				'global' => array(
					'title' => '基本資料',
					'child3' => array(
						'global' => array(
							'title' => '全域',
							'child4' => array(
								'user' => array('title' => '會員資料')
							)
						)
					)
				),
				'order' => array(
					'title' => '我的訂單',
					'child3' => array(
						'order' => array(
							'title' => '訂單',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				)
			)
		)
	);