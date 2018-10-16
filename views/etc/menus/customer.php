<?php
$activeNavigation = \Yii::$app->controller->activeNavigation;
$type = Yii::$app->session->get('type');

$menus = array();
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
		'icon' => 'fa fa-truck',
		'text' => 'Delivery',
		'key' => 'delivery-page',
		'child' => array(
            array(
				'url' => \Yii::$app->getUrlManager()->createUrl('delivery/crud/create'),
				'text' => 'Book Delivery',
			),
			array(
                'url' => \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index','sort' => '-date_delivery']),
				'text' => 'All Delivery',
			),
		),
	),
	array(
		'url' => 'javascript:;',
		'icon' => 'fa fa-gear',
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