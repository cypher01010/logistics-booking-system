<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h3 class="page-title">SMTP Settings</h3>
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
			<a href="javascript:;">SMTP Settings</a>
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

					<h4>Global Sender</h4><br />
					<?php echo $form->field($settingsForm, 'sender'); ?>
					<hr />

					<h4>SMTP Settings</h4><br />
					<?php echo $form->field($settingsForm, 'host'); ?>
					<?php echo $form->field($settingsForm, 'port'); ?>
					<?php echo $form->field($settingsForm, 'username'); ?>
					<?php echo $form->field($settingsForm, 'password'); ?>
					<?php echo $form->field($settingsForm, 'encryption'); ?>
					<hr />

					<h4>Test Email Receiver</h4><br />
					<?php echo $form->field($settingsForm, 'testReceiver'); ?>
					<hr />

					<div class="form-group">
						<p>NOTE: Before you hit the button <strong>'Update'</strong> test the new settings first!</p>
					</div>

					<div class="form-group">
						<?= Html::submitButton('Update Settings', ['class' => 'btn btn-success']) ?>
						<span style="padding-right: 30px;"></span>
						<a href="javascript:;" class="test-smtp-settings">Test SMTP Settings</a>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on('click', 'a.test-smtp-settings', function() {
			var host = $('#smtpform-host').val();
			var port = $('#smtpform-port').val();
			var username = $('#smtpform-username').val();
			var password = $('#smtpform-password').val();
			var encryption = $('#smtpform-encryption').val();
			var testreceiver = $('#smtpform-testreceiver').val();
			var sender = $('#smtpform-sender').val();

			jQuery.ajax({
				type : "POST",
				url : '<?php echo \Yii::$app->getUrlManager()->createUrl('settings/default/testsmtpsettings'); ?>',
				cache : true,
				data : {
					host : host,
					port : port,
					username : username,
					password : password,
					encryption : encryption,
					testreceiver : testreceiver,
					sender : sender,
					_csrf : $('meta[name="csrf-token"]').attr("content")
				},
				dataType:'json',
				success: function(response) {
					if(response.success == true) {
						alert('test is done!');
					}
				}
			});
		});
	});
</script>