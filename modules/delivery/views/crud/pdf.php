<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$statusList = $model->statusList();

$this->title = $model->id;

if(isset($statusList[$model->status])) {
	$model->status = $statusList[$model->status];
}
?>
<h3 class="page-title">Delivery Information : <?= Html::encode($this->title) ?></h3>
<?php
switch (\Yii::$app->session->get('type')) {
	case \app\models\User::USERTYPE_SUPER_ADMIN:
	case \app\models\User::USERTYPE_ADMIN:
		echo $this->render('/crud/pdfdisplay/_admin', [
			'model' => $model,
			'userObject' => $userObject,
		]);
		break;
	case \app\models\User::USERTYPE_CUSTOMER:
		echo $this->render('/crud/pdfdisplay/_customer', [
			'model' => $model,
		]);
		break;
	case \app\models\User::USERTYPE_DRIVER:
		echo $this->render('/crud/pdfdisplay/_driver', [
			'model' => $model,
		]);
		break;
}
?>