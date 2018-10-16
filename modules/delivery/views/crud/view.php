<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$statusList = $model->statusList();

$this->title = $model->id;
$deliveryStatus = $model->status;
if(isset($statusList[$model->status])) {
	$model->status = $statusList[$model->status];
}
?>
<h3 class="page-title">Delivery Information : <?= Html::encode($this->title) ?></h3>
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
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="<?php echo date("M d, Y")?>">
			<i class="fa fa-calendar"></i>
			<span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
		</div>
	</div>
</div>
<div class="delivery-view">
	<p>
		<?php
			if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER &&  $deliveryStatus != 'cancelled' && $deliveryStatus != 'delivered') {
				echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
			} else if(\Yii::$app->session->get('type') != \app\models\User::USERTYPE_CUSTOMER) {
				echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
			}
		?>
		<?= Html::a('Pdf', ['pdf', 'id' => $model->id], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
		<?php
			switch (\Yii::$app->session->get('type')) {
				case \app\models\User::USERTYPE_SUPER_ADMIN:
                case \app\models\User::USERTYPE_ADMIN:
					echo Html::a('Delete', ['delete', 'id' => $model->id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => 'Are you sure you want to delete this delivery?',
							'method' => 'post',
						],
					]);
					break;
				case \app\models\User::USERTYPE_CUSTOMER:
					if($deliveryStatus == 'requested' || $deliveryStatus == 'allocated' || $deliveryStatus == 'failed') {
						echo Html::a('Cancel Delivery', ['cancel', 'id' => $model->id], [
							'class' => 'btn btn-danger',
							'data' => [
								'confirm' => 'Are you sure you want to cancel this delivery?',
								'method' => 'post',
							],
						]);
					}
					break;
			}
		?>
	</p>
	<div class="row">
		<div id="portfolio" class="col-md-12">
			<?php
				switch (\Yii::$app->session->get('type')) {
					case \app\models\User::USERTYPE_SUPER_ADMIN:
					case \app\models\User::USERTYPE_ADMIN:
						echo $this->render('/crud/info/_admin', [
							'model' => $model,
							'userObject' => $userObject,
						]);
						break;
					case \app\models\User::USERTYPE_CUSTOMER:
						echo $this->render('/crud/info/_customer', [
							'model' => $model,
						]);
						break;
					case \app\models\User::USERTYPE_DRIVER:
						echo $this->render('/crud/info/_driver', [
							'model' => $model,
						]);
						break;
				}
			?>
		</div>
	</div>
	<p>
		<?php
			if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER &&  $deliveryStatus != 'cancelled' && $deliveryStatus != 'delivered') {
				echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
			} else if(\Yii::$app->session->get('type') != \app\models\User::USERTYPE_CUSTOMER) {
				echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
			}
		?>
		<?= Html::a('Pdf', ['pdf', 'id' => $model->id], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
		<?php
			switch (\Yii::$app->session->get('type')) {
				case \app\models\User::USERTYPE_SUPER_ADMIN:
                case \app\models\User::USERTYPE_ADMIN:
					echo Html::a('Delete', ['delete', 'id' => $model->id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => 'Are you sure you want to delete this delivery?',
							'method' => 'post',
						],
					]);
					break;
				case \app\models\User::USERTYPE_CUSTOMER:
					if($deliveryStatus == 'requested' || $deliveryStatus == 'allocated' || $deliveryStatus == 'failed') {
						echo Html::a('Cancel Delivery', ['cancel', 'id' => $model->id], [
							'class' => 'btn btn-danger',
							'data' => [
								'confirm' => 'Are you sure you want to cancel this delivery?',
								'method' => 'post',
							],
						]);
					}
					break;
			}
		?>
	</p>
</div>

<div class="modal fade" id="modal-signature" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Signature</h4>
			</div>
			<div class="modal-body"><span id="modal-signature-display"></span></div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function($) {
	$(document).on('click', '#link-signature', function() {
		var url = $(this).attr('data-image-url');
		$('#modal-signature-display').empty().append('<img src="' + url + '" />');
	});
});
</script>