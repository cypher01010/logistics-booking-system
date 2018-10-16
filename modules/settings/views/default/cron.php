<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h3 class="page-title">Cron</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo \Yii::$app->getUrlManager()->createUrl('user/crud/dashboard'); ?>">SMTP Settings</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="javascript:;">System Settings</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="javascript:;">Cron</a>
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

					<h4>Cron</h4><br />
					<?php echo $form->field($settingsForm, 'time')->input('time'); ?>
					<?php echo $form->field($settingsForm, 'receiver'); ?>
					<hr />

					<div class="form-group">
						<?= Html::submitButton('Update Settings', ['class' => 'btn btn-success']) ?>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>