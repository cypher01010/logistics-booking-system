<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
	<?php $form = ActiveForm::begin([
		'id' => 'delivery-form',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
	]); ?>
		<?php if (\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) { ?>
			<div id="price-change" class="col-md-12">
				<div class="portlet light bg-inverse">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject font-green-sharp ">Admin Details</span>
							<span class="caption-helper"></span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-body">
									<div class="form-group" >
										<label class="col-md-3 control-label">Customer <?php echo ($model->isAttributeRequired('customer_id') == true) ? '<span class="required">*</span>' : NULL; ?></label>
										<div class="col-md-9">
											<?= $form->field($model, 'customer_id')->dropDownList($modelCustomer)->label('Customer')->label(false); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Driver <?php echo ($model->isAttributeRequired('driver_id') == true) ? '<span class="required">*</span>' : NULL; ?></label>
										<div class="col-md-9">
											<?= $form->field($model, 'driver_id')->dropDownList($modelDriver)->label('Driver')->label(false); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="col-md-12">
			<div class="portlet light bg-inverse">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Sender's Details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<p>Please fill in sender's details below</p>
					<p>Fields with <span class="required">*</span> are required</p>
					<br />
					<div class="row">
						<div class="col-md-12">
							<div class="form-body">
								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Sender's Name <?php echo ($model->isAttributeRequired('sender_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'sender_name')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Sender’s Company <?php echo ($model->isAttributeRequired('sender_company') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'sender_company')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Contact Number <?php echo ($model->isAttributeRequired('sender_contact') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'sender_contact')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>
								
								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Postal Code <?php echo ($model->isAttributeRequired('sender_postal_code') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'sender_postal_code')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Blk and Street Name <?php echo ($model->isAttributeRequired('sender_blk_street_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'sender_blk_street_name')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Building Name <?php echo ($model->isAttributeRequired('sender_bldg_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'sender_bldg_name')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Unit Number <?php echo ($model->isAttributeRequired('sender_unit_no') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'sender_unit_no')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<hr />
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="portlet light bg-inverse" >
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Recipient's Details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<p>Please fill in recipient's details below</p>
					<p>Fields with <span class="required">*</span> are required</p>
					<br />
					<div class="row">
						<div class="col-md-12">
							<div class="form-body">
								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Recipient’s Name <?php echo ($model->isAttributeRequired('receiver_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Recipient’s Company <?php echo ($model->isAttributeRequired('receiver_company') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'receiver_company')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Contact Number <?php echo ($model->isAttributeRequired('receiver_contact') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'receiver_contact')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Postal Code <?php echo ($model->isAttributeRequired('postal_code') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'postal_code')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Blk and Street Name <?php echo ($model->isAttributeRequired('blk_street_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'blk_street_name')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Building Name <?php echo ($model->isAttributeRequired('bldg_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'bldg_name')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Unit Number <?php echo ($model->isAttributeRequired('unit_no') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'unit_no')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="portlet light bg-inverse" >
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Package Details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<p>Please fill in recipient's details below</p>
					<p>Fields with <span class="required">*</span> are required</p>
					<br />
					<div class="row">
						<div class="col-md-12">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Delivery Date <?php echo ($model->isAttributeRequired('date_delivery') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
									 <?= $form->field($model, 'date_delivery')->textInput(['maxlength' => true, 'class' => 'form-control form-control-inline input-medium date-picker', 'data-date-format' => 'dd/mm/yyyy' ])->label(false); ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Delivery Time <?php echo ($model->isAttributeRequired('delivery_time') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										 <?= $form->field($model, 'delivery_time')->dropDownList(\Yii::$app->controller->deliveryTimeList(), ['prompt' => ''])->label(false) ?>
									</div>
								</div>
								
								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Remarks <?php echo ($model->isAttributeRequired('remarks') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'remarks')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Type of product(s) <?php echo ($model->isAttributeRequired('type_products') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'type_products')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Carton size (LxWxH) <?php echo ($model->isAttributeRequired('cartoon_size') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'cartoon_size')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Carton weight (in kg) <?php echo ($model->isAttributeRequired('cartoon_weight') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'cartoon_weight')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>
								
								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">No. of carton(s) <?php echo ($model->isAttributeRequired('no_cartoons') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'no_cartoons')->textInput(['maxlength' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group" style="padding-top: 10px">
									<label class="col-md-3 control-label">Attach Document <?php echo ($model->isAttributeRequired('document') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'document')->fileInput()->label(false); ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Tracking ID <?php echo ($model->isAttributeRequired('tracking_id') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
										<?= $form->field($model, 'tracking_id')->textInput(['maxlength' => true, 'readOnly' => true])->label(false); ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Booking ID <?php echo ($model->isAttributeRequired('delivery_book_id') == true) ? '<span class="required">*</span>' : NULL; ?></label>
									<div class="col-md-9">
									 <?= $form->field($model, 'delivery_book_id')->textInput(['maxlength' => true, 'readOnly' => true])->label(false); ?>
									</div>
								</div>

								<hr />
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php if (Yii::$app->session->get('type') != \app\models\User::USERTYPE_CUSTOMER){ ?>
			<div id="price-change" class="col-md-12">
				<div class="portlet light bg-inverse">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject font-green-sharp ">Delivery Status</span>
							<span class="caption-helper"></span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Status <?php echo ($model->isAttributeRequired('status') == true) ? '<span class="required">*</span>' : NULL; ?></label>
										<div class="col-md-9">
											<?= $form->field($model, 'status')->dropDownList($statusList)->label(false) ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<div id="price-change" class="col-md-12">
			<div class="portlet light bg-inverse">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Book Delivery</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<p>Click the button below to book delivery</p>
					<br />
					<div class="row">
						<div class="col-md-12">
							<div class="form-body">
								<div class="form-group">
									<?= Html::submitButton('Book Delivery', ['class' => 'btn btn-success']) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
$(document).ready(function() {
    var id;
    
    <?php if (\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) { ?>
	$('#deliveryform-customer_id').change(function () {
        id = $('#deliveryform-customer_id').val();
        getAddress(id);
    });
    <?php } else { ?>
            id = '';
            getAddress(id); 
    <?php } ?>
    
    function getAddress(id){ 
        $.ajax({
            url : '<?php echo \Yii::$app->getUrlManager()->createUrl('delivery/default/registeredaddress'); ?>',
            type: 'post',
            dataType:'json',
            data: {
                id: id
            },
            success: function (data) {
                $('#deliveryform-sender_postal_code').val(data.zip_code);
                $('#deliveryform-sender_blk_street_name').val(data.address1);
                $('#deliveryform-sender_bldg_name').val(data.building_name);
                $('#deliveryform-sender_unit_no').val(data.unit_number);
                $('#deliveryform-sender_name').val(data.sender);
                $('#deliveryform-sender_company').val(data.company);
                $('#deliveryform-sender_contact').val(data.contact);
            }
        });
    }
});
</script>