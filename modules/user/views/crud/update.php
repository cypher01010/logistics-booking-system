<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $name;
?>
<h3 class="page-title">Update User : <?= Html::encode($this->title) ?></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo \Yii::$app->getUrlManager()->createUrl('user/crud/dashboard'); ?>">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="javascript:;">User</a>
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

<?php if($model->type == \app\models\User::USERTYPE_CUSTOMER) { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bg-inverse">
				<div class="portlet-body form">
					<?php $form = ActiveForm::begin(); ?>
						<div class="form-body">
							<div class="form-group">
								<div class="form-group">
									<div class="col-md-6">
										<?= $form->field($model, 'companyName')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6">
										<?= $form->field($model, 'companyPhone')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										<?= $form->field($model, 'postalCode')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6">
										<?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
								<div class="form-group">
									
								</div>
								<div class="form-group">
									<div class="col-md-6">
										<?= $form->field($model, 'buildingName')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6">
										<?= $form->field($model, 'unitNumber')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										<?= $form->field($model, 'contactPerson')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6">
										<?= $form->field($model, 'contactNumber')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6">
										<?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', 'delete' => 'Delete', 'spam' => 'Spam', ], ['prompt' => '']) ?>
									</div>
								</div>
								<div class="form-group">
									<?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
								</div>
							</div>
						</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bg-inverse">
				<div class="portlet-body form">
					<?php $form = ActiveForm::begin(); ?>
						<div class="form-body">
							<div class="form-group">
								<div class="form-group">
									<div class="col-md-6">
										<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6">
										<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6">
										<?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', 'delete' => 'Delete', 'spam' => 'Spam', ], ['prompt' => '']) ?>
									</div>
								</div>
								<div class="form-group">
									<?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
								</div>
							</div>
						</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>