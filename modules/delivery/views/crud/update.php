<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->id;
$signature = true;
if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
	$signature = false;
}
?>
<h3 class="page-title">Update Delivery : <?= Html::encode($this->title) ?></h3>
<div class="delivery-update">
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="<?php echo \Yii::$app->getUrlManager()->createUrl('user/crud/dashboard'); ?>">Dashboard</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="javascript:;">Delivery</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="javascript:;"><?= Html::encode($this->title) ?></a>
			</li>
		</ul>
		<div class="page-toolbar">
			<div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="December 1, 2014">
				<i class="fa fa-calendar"></i>
				<span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
			</div>
		</div>
	</div>
	<?= $this->render('_updateform', [
		'model' => $model,
		'modelVehicle' => $modelVehicle,
		'modelDriver' => $modelDriver,
		'modelCustomer' => $modelCustomer,
		'statusList' => $statusList,
		'signature' => $signature,
	]) ?>
</div>