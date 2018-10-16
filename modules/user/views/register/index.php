<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<article class="panel">
	<header>
		<h2>Customer Register</h2>
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
						echo $form->field($model, 'companyName', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('companyName'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'companyPhone', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('companyPhone'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'postalCode', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('postalCode'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'street', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('street'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'buildingName', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('buildingName'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'unitNumber', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('unitNumber'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'contactPerson', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('contactPerson'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'contactNumber', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('contactNumber'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($model, 'email', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('email'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u 12u$(mobile)">
					 <?php 
						echo $form->field($model, 'password', [
							'inputOptions' => [
								'placeholder' => $model->getAttributeLabel('password'),
							],
						])->label(false)->passwordInput();
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
jQuery(document).ready(function($) {
	jQuery('#wrapper').css('margin-top', '50px');
});
</script>