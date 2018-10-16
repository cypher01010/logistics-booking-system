<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h3 class="page-title">Password</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo \Yii::$app->getUrlManager()->createUrl('user/crud/dashboard'); ?>">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="javascript:;">Settings</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="javascript:;">Password
			</a>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="<?php echo date("M d, Y")?>">
			<i class="fa fa-calendar"></i>
			<span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
		</div>
	</div>
</div>
<?php if($message != '') { ?>
	<div class="alert alert-success">
		<strong><?php echo $message; ?></strong>
	</div>
<?php } ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bg-inverse">
			<div class="portlet-body form">
				<?php $form = ActiveForm::begin(); ?>
					<div class="form-body">
						<div class="form-group">
							<div class="form-group">
								<div class="col-md-12">
									<?= $form->field($model, 'old')->passwordInput() ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<?= $form->field($model, 'new')->passwordInput() ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'confirm')->passwordInput() ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<?= Html::submitButton('Update Password', ['class' => 'btn btn-success']) ?>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>