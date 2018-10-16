<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-9">
		<h3 class="page-title">
			<?= Html::encode($this->title) ?>
		</h3>
	</div>
</div>
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
			<a href="javascript:;">Create User</a>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="<?php echo date("M d, Y")?>">
			<i class="fa fa-calendar"></i>
			<span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">Create User</div>
			</div>
			<div class="portlet-body">
				<ul class="nav nav-tabs">
					<li class="<?php echo ($activeTabCustomer == 'active') ? 'active' : ''; ?>">
						<a href="#customerusers" data-toggle="tab" aria-expanded="true">Customer</a>
					</li>
					<li class="<?php echo ($activeTabAdmin == 'active') ? 'active' : ''; ?>">
						<?php if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) { ?>
							<a href="#adminusers" data-toggle="tab" aria-expanded="false">Driver / Admin</a>
						<?php } else { ?>
							<a href="#adminusers" data-toggle="tab" aria-expanded="false">Driver</a>
						<?php } ?>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade <?php echo ($activeTabCustomer == 'active') ? 'active in' : ''; ?>" id="customerusers">
						<p>
							<?php $form = ActiveForm::begin(); ?>
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-4 control-label">Company Name</label>
										<div class="col-md-8">
											<?= $form->field($createCustomerFormObject, 'companyName')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Company Phone</label>
										<div class="col-md-8">
										   <?= $form->field($createCustomerFormObject, 'companyPhone')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Postal Code</label>
										<div class="col-md-8">
										   <?= $form->field($createCustomerFormObject, 'postalCode')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Street</label>
										<div class="col-md-8">
										   <?= $form->field($createCustomerFormObject, 'street')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<hr />
									<div class="form-group">
										<label class="col-md-4 control-label">Building Name</label>
										<div class="col-md-8">
											<?= $form->field($createCustomerFormObject, 'buildingName')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Unit Number</label>
										<div class="col-md-8">
											<?= $form->field($createCustomerFormObject, 'unitNumber')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Contact Person</label>
										<div class="col-md-8">
											<?= $form->field($createCustomerFormObject, 'contactPerson')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Contact Number</label>
										<div class="col-md-8">
											<?= $form->field($createCustomerFormObject, 'contactNumber')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Email</label>
										<div class="col-md-8">
											<?= $form->field($createCustomerFormObject, 'email')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Password</label>
										<div class="col-md-8">
											<?= $form->field($createCustomerFormObject, 'password')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<?= Html::submitButton('Create Customer', ['class' => 'btn btn-success']) ?>
									</div>
									<div class="clearfix"></div>
								</div>
							<?php ActiveForm::end(); ?>
						</p>
					</div>
					<div class="tab-pane fade <?php echo ($activeTabAdmin == 'active') ? 'active in' : ''; ?>" id="adminusers">
						<p>
							<?php $form = ActiveForm::begin(); ?>
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Name</label>
										<div class="col-md-9">
											<?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Email Adress</label>
										<div class="col-md-9">
										   <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Username</label>
										<div class="col-md-9">
										   <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Password</label>
										<div class="col-md-9">
										   <?= $form->field($model, 'password')->textInput(['maxlength' => true])->label(false) ?>
										</div>
									</div>
									<hr />
									<?php if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) { ?>
										<div class="form-group">
											<label class="col-md-3 control-label">Role</label>
											<div class="col-md-9">
												<?= $form->field($model, 'type')->dropDownList($types, ['prompt' => ''])->label(false) ?>
											</div>
										</div>
									<?php } ?>
									<div class="form-group">
										<?= Html::submitButton('Create User', ['class' => 'btn btn-success']) ?>
									</div>
									<div class="clearfix"></div>
								</div>
							<?php ActiveForm::end(); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) { ?>
		<div class="col-md-6">
			<div class="portlet light bg-inverse">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Other Details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-xs-6">
							<p>Total Number of Users</p>
						</div>
						<div class="col-xs-6">
							<p class="text-right"><?php echo $numusers['total'] ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<p>Number of Super Admins</p>
						</div>
						<div class="col-xs-6">
							<p class="text-right"><?php echo $numusers['superadmin'] ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<p>Number of Admins</p>
						</div>
						<div class="col-xs-6">
							<p class="text-right"><?php echo $numusers['admin'] ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<p>Number of Drivers</p>
						</div>
						<div class="col-xs-6">
							<p class="text-right"><?php echo $numusers['driver'] ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<p>Number of Customers</p>
						</div>
						<div class="col-xs-6">
							<p class="text-right"><?php echo $numusers['customer'] ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="col-md-6">
			<div class="portlet light bg-inverse">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Other Details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-xs-6">
							<p>Number of Drivers</p>
						</div>
						<div class="col-xs-6">
							<p class="text-right"><?php echo $numusers['driver'] ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<p>Number of Customers</p>
						</div>
						<div class="col-xs-6">
							<p class="text-right"><?php echo $numusers['customer'] ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>