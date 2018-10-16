<?php
$activeNavigation = \Yii::$app->controller->activeNavigation;
$menus = array(
	array(
		'text' => '<li class="sidebar-toggler-wrapper"><div class="sidebar-toggler"></div></li>',
	),
	array(
		'url' => \Yii::$app->getUrlManager()->createUrl('user/crud/dashboard'),
		'icon' => 'fa fa-home',
		'text' => 'Dashboard',
		'key' => 'dashboard',
		'child' => array(),
	),
	array(
		'url' => 'javascript:;',
		'icon' => 'fa fa-user',
		'text' => 'User',
		'key' => 'user-superadmin',
		'child' => array(
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl(['user/crud/list', 'type' => 'customer']),
				'text' => 'List of Customers',
			),
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl(['user/crud/list', 'type' => 'driver']),
				'text' => 'List of Drivers',
			),
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl(['user/crud/list', 'type' => 'all']),
				'text' => 'List All',
			),
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl('user/crud/create'),
				'text' => 'Create User',
			),
		),
	),
	
	array(
		'url' => 'javascript:;',
		'icon' => 'fa fa-truck',
		'text' => 'Delivery',
		'key' => 'delivery-page',
		'child' => array(
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl('delivery/crud/create'),
				'text' => 'Book Delivery',
			),
            array(
                'url' => \Yii::$app->getUrlManager()->createUrl('delivery/crud/import'),
				'text' => 'Import Delivery',
			),
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index','sort' => '-date_delivery']),
				'text' => 'All Delivery',
			),
		),
	),
	array(
		'url' => 'javascript:;',
		'icon' => 'fa fa-gears',
		'text' => 'Settings',
		'key' => 'settings',
		'child' => array(
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl('user/info/index'),
				'text' => 'Personal Info',
			),
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl('user/info/password'),
				'text' => 'Password',
			),
		),
	),
	array(
		'url' => 'javascript:;',
		'icon' => 'fa fa-gears',
		'text' => 'System Settings',
		'key' => 'system-settings',
		'child' => array(
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl('settings/default/smtp'),
				'text' => 'SMTP Settings',
			),
			array(
				'url' => \Yii::$app->getUrlManager()->createUrl('settings/default/cron'),
				'text' => 'Cron',
			),
		),
	),
);
?>
<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<?php
				foreach ($menus as $key => $value) {
					if(isset($value['child'])) {
						$class = ($value['key'] == $activeNavigation) ? 'start active open' : NULL;
						$childArrow =  (count($value['child']) > 0) ? '<span class="arrow"></span>' : NULL;
						$child = NULL;
						if(!empty($childArrow)) {
							$child .= '<ul class="sub-menu">';
								foreach ($value['child'] as $childKey => $childValue) {
									$child .= '<li><a href="' . $childValue['url'] . '">' . $childValue['text'] . '</a></li>';
								}
							$child .= '</ul>';
						}
						echo '<li class="' . $class . '">';
							echo 	'<a href="' . $value['url'] . '"><i class="' . $value['icon'] . '"></i><span class="title">' . $value['text'] . '</span>' . $childArrow . '</a>' . $child;
						echo '</li>';
					} else {
						echo $value['text'];
					}
				}
			?>
		</ul>
	</div>
</div>