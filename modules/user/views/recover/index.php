<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<article class="panel">
	<header>
		<h2>Recover Account</h2>
	</header>
	<div>
		<?php
			$form = ActiveForm::begin([
				'id' => 'register-form-customer',
				'options' => ['class' => 'form-horizontal rrl-form'],
				'fieldConfig' => [
					'labelOptions' => ['class' => 'control-label'],
				],
			]); 
		?>
			<div class="row">
				<div class="12u 12u$(mobile)">
					<?php 
						echo $form->field($recoverForm, 'email', [
							'inputOptions' => [
								'placeholder' => $recoverForm->getAttributeLabel('email'),
							],
						])->label(false);
					?>
				</div>
				<div class="12u 12u$(mobile)">
					<div style="float:left;">
						<input type="submit" class="button-submit-front" value="Submit" />
					</div>
					<div style="padding-left: 20px; float:left; ">
						<div class="register-container-link">Click <a href="<?php echo \Yii::$app->getUrlManager()->createUrl('user/login/index'); ?>">here</a> to login.</div>
					</div>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</article>
<script type="text/javascript">
$(document).ready(function($) {
	$('#wrapper').css('padding-top', '10px');
});
</script>