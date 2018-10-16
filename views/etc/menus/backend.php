<?php
switch (\Yii::$app->session->get('type')) {
	case \app\models\User::USERTYPE_SUPER_ADMIN:
		echo $this->render('//etc/menus/superadmin');
		break;
	case \app\models\User::USERTYPE_ADMIN:
		echo $this->render('//etc/menus/admin');
		break;
	case \app\models\User::USERTYPE_CUSTOMER:
		echo $this->render('//etc/menus/customer');
		break;
	case \app\models\User::USERTYPE_DRIVER:
		echo $this->render('//etc/menus/driver');
		break;
}
?>