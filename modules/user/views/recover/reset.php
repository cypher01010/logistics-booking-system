<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<article class="panel">
	<header>
		<h2>Reset Password</h2>
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
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($resetForm, 'new_password', [
							'inputOptions' => [
								'placeholder' => $resetForm->getAttributeLabel('new_password'),
							],
						])->label(false)->passwordInput();
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($resetForm, 'retype_password', [
							'inputOptions' => [
								'placeholder' => $resetForm->getAttributeLabel('retype_password'),
							],
						])->label(false)->passwordInput();
					?>
				</div>
				<div class="12u 12u$(mobile)">
					<div style="float:left;">
						<input type="submit" class="button-submit-front" value="Submit" />
					</div>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</article>