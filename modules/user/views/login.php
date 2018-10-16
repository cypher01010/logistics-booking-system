<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<article id="customer" class="panel">
	<?php if($message != '') { ?>
		<div class="alert alert-success">
			<strong><?php echo $message; ?></strong>
		</div>
	<?php } ?>
	<header>
		<h2>Customer Login</h2>
	</header>
	<div>
		<?php
			$form = ActiveForm::begin([
				'id' => 'login-form-customer',
				'options' => ['class' => 'form-horizontal rrl-form'],
				'fieldConfig' => [
					'labelOptions' => ['class' => 'control-label'],
				],
				'action' => \Yii::$app->urlManager->createUrl(['user/login/index', '#' => 'customer']),
			]); 
		?>
			<div class="row">
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($customerLoginForm, 'email', [
							'inputOptions' => [
								'placeholder' => $customerLoginForm->getAttributeLabel('email'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u$ 12u$(mobile)">
					 <?php 
						echo $form->field($customerLoginForm, 'password', [
							'inputOptions' => [
								'placeholder' => $customerLoginForm->getAttributeLabel('password'),
							],
						])->label(false)->passwordInput();
					?>
				</div>
				<div>
					<div style="float:left;">
						<input type="submit" class="button-submit-front" value="Submit" />
					</div>
					<div style="padding-left: 20px; float:right; ">
						<input type="submit" class="forgot-password-btn button-submit-front" value="Forgot Password" />
					</div>
				</div>
				<div style="">
					<div class="register-container-link">Click <a href="<?php echo \Yii::$app->getUrlManager()->createUrl('user/register/index'); ?>">here</a> to register.</div>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</article>

<article id="driver" class="panel">
	<header>
		<h2>Driver Login</h2>
	</header>
	<div>
		<?php
			$form = ActiveForm::begin([
				'id' => 'login-form-driver',
				'options' => ['class' => 'form-horizontal rrl-form'],
				'fieldConfig' => [
					'labelOptions' => ['class' => 'control-label'],
				],
				'action' => \Yii::$app->urlManager->createUrl(['user/login/index', '#' => 'driver']),
			]);
		?>
			<div class="row">
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($driverLoginForm, 'username', [
							'inputOptions' => [
								'placeholder' => $driverLoginForm->getAttributeLabel('username'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u$ 12u$(mobile)">
					<?php 
						echo $form->field($driverLoginForm, 'password', [
							'inputOptions' => [
								'placeholder' => $driverLoginForm->getAttributeLabel('password'),
							],
						])->label(false)->passwordInput();
					?>
				</div>
				<div>
					<div style="float:left;">
						<input type="submit" class="button-submit-front" value="Submit" />
					</div>
					<div style="padding-left: 20px; float:right; ">
						<input type="submit" class="forgot-password-btn button-submit-front" value="Forgot Password" />
					</div>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</article>

<article id="admin" class="panel">
	<header>
		<h2>Admin Login</h2>
	</header>
	<div>
		<?php
			$form = ActiveForm::begin([
				'id' => 'login-form-admin',
				'options' => ['class' => 'form-horizontal rrl-form'],
				'fieldConfig' => [
					'labelOptions' => ['class' => 'control-label'],
				],
				'action' => \Yii::$app->urlManager->createUrl(['user/login/index', '#' => 'admin']),
			]); 
		?>
			<div class="row">
				<div class="6u 12u$(mobile)">
					<?php 
						echo $form->field($adminLoginForm, 'username', [
							'inputOptions' => [
								'placeholder' => $adminLoginForm->getAttributeLabel('username'),
							],
						])->label(false);
					?>
				</div>
				<div class="6u$ 12u$(mobile)">
					<?php 
						echo $form->field($adminLoginForm, 'password', [
							'inputOptions' => [
								'placeholder' => $adminLoginForm->getAttributeLabel('password'),
							],
						])->label(false)->passwordInput();
					?>
				</div>
				<div>
					<div style="float:left;">
						<input type="submit" class="button-submit-front" value="Submit" />
					</div>
					<div style="padding-left: 20px; float:right; ">
						<input type="submit" class="forgot-password-btn button-submit-front" value="Forgot Password" />
					</div>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</article>

<script type="text/javascript">
	$(document).ready(function($) {
		$(document).on('click', '.forgot-password-btn', function() {
			$("form").submit(function (e) {
				e.preventDefault();
				window.location.href = "<?php echo \Yii::$app->getUrlManager()->createUrl('user/recover/index'); ?>";
			});
		});
	});
</script>