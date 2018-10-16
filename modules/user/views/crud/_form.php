<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'address2')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'country_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'hash')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'password_updated')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>

	<?= $form->field($model, 'date_created')->textInput() ?>

	<?= $form->field($model, 'date_updated')->textInput() ?>

	<?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', 'delete' => 'Delete', 'spam' => 'Spam', ], ['prompt' => '']) ?>

	<?= $form->field($model, 'type')->dropDownList([ 'customer' => 'Customer', 'driver' => 'Driver', 'admin' => 'Admin', 'superadmin' => 'Superadmin', ], ['prompt' => '']) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
