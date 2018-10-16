<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'All Delivery';
?>
<h3 class="page-title"><?= Html::encode($this->title) ?></h3>
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
		<div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="<?php echo date("M d, Y")?>">
			<i class="fa fa-calendar"></i>
			<span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
		</div>
	</div>
</div>
<div class="delivery-index">
	<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="row">
		<div id="portfolio" class="col-md-12">
			<?php
				switch (\Yii::$app->session->get('type')) {
					case \app\models\User::USERTYPE_SUPER_ADMIN:
					case \app\models\User::USERTYPE_ADMIN:
						if($isMobile == true) {
							echo $this->render('/crud/list/_mobile', [
								'searchModel' => $searchModel,
								'dataProvider' => $dataProvider,
								'sortId' => $sortId,
								'sortDateDelivery' => $sortDateDelivery,
								'sortDateTime' => $sortDateTime,
								'sortImageSignature' => $sortImageSignature,
								'sortStatus' => $sortStatus,
								'sortDriver' => $sortDriver,
								'filtering' => $filtering,
							]);
						} else {
							echo $this->render('/crud/list/_web', [
								'searchModel' => $searchModel,
								'dataProvider' => $dataProvider,
								'sortId' => $sortId,
								'sortDateDelivery' => $sortDateDelivery,
								'sortDateTime' => $sortDateTime,
								'sortImageSignature' => $sortImageSignature,
								'sortStatus' => $sortStatus,
								'sortDriver' => $sortDriver,
								'filtering' => $filtering,
								'sortPostal' => $sortPostal,
							]);
						}
						break;
					case \app\models\User::USERTYPE_CUSTOMER:
						if($isMobile == true) {
							echo $this->render('/crud/list/_mobilecustomer', [
								'searchModel' => $searchModel,
								'dataProvider' => $dataProvider,
								'sortId' => $sortId,
								'sortDateDelivery' => $sortDateDelivery,
								'sortDateTime' => $sortDateTime,
								'sortImageSignature' => $sortImageSignature,
								'sortStatus' => $sortStatus,
								'sortDriver' => $sortDriver,
								'filtering' => $filtering,
							]);
						} else {
							echo $this->render('/crud/list/_webcustomer', [
								'searchModel' => $searchModel,
								'dataProvider' => $dataProvider,
								'sortId' => $sortId,
								'sortDateDelivery' => $sortDateDelivery,
								'sortDateTime' => $sortDateTime,
								'sortImageSignature' => $sortImageSignature,
								'sortStatus' => $sortStatus,
								'sortDriver' => $sortDriver,
								'filtering' => $filtering,
								'sortPostal' => $sortPostal,
							]);
						}
						break;
					case \app\models\User::USERTYPE_DRIVER:
						if($isMobile == true) {
							echo $this->render('/crud/list/_mobiledriver', [
								'searchModel' => $searchModel,
								'dataProvider' => $dataProvider,
								'sortId' => $sortId,
								'sortDateDelivery' => $sortDateDelivery,
								'sortDateTime' => $sortDateTime,
								'sortImageSignature' => $sortImageSignature,
								'sortStatus' => $sortStatus,
								'sortDriver' => $sortDriver,
								'filtering' => $filtering,
							]);
						} else {
							echo $this->render('/crud/list/_webdriver', [
								'searchModel' => $searchModel,
								'dataProvider' => $dataProvider,
								'sortId' => $sortId,
								'sortDateDelivery' => $sortDateDelivery,
								'sortDateTime' => $sortDateTime,
								'sortImageSignature' => $sortImageSignature,
								'sortStatus' => $sortStatus,
								'sortDriver' => $sortDriver,
								'filtering' => $filtering,
								'sortPostal' => $sortPostal,
							]);
						}
						break;
				}
			?>
		</div>
	</div>
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