<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
	<?php $form = ActiveForm::begin([
		'id' => 'delivery-form',
        'options' => ['enctype' => 'multipart/form-data']
	]); ?>
		<div class="col-md-7">
			<div class="portlet light bg-inverse" >
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Sender’s Details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<p>Please fill in sender's details below</p>
					<br />
					<div class="form-body">
						<?php if (Yii::$app->session->get('type') != \app\models\User::USERTYPE_CUSTOMER) { ?>
							<div class="form-group" >
								<label class="col-md-3 control-label">Customer</label>
								<div class="col-md-9">
									<?= $form->field($model, 'customer_id')->dropDownList($modelCustomer)->label('Driver')->label(false); ?>
								</div>
							</div>
							<hr /> <br />
						<?php } ?>

						<div class="form-group" style="padding-top: 10px">
							<label class="col-md-3 control-label">Sender's name</label>
							<div class="col-md-9">
								<?= $form->field($model, 'sender_name')->textInput(['maxlength' => true])->label(false); ?>
							</div>
						</div>

						<div class="form-group" style="padding-top: 10px">
							<label class="col-md-3 control-label">Sender’s company name</label>
							<div class="col-md-9">
								<?= $form->field($model, 'sender_company')->textInput(['maxlength' => true])->label(false); ?>
							</div>
						</div>

						<div class="form-group" style="padding-top: 10px">
							<label class="col-md-3 control-label">Contact No.</label>
							<div class="col-md-9">
								<?= $form->field($model, 'sender_contact')->textInput(['maxlength' => true])->label(false); ?>
							</div>
						</div>

						<div class="form-group" style="padding-top: 10px">
                            <label class="col-md-3 control-label">Same as registered address</label> 
                            &nbsp;&nbsp;
                            <input type="checkbox" name="registeredaddress" id="isRegSelected">	
                        </div>

                        <div class="form-group" style="padding-top: 10px">
                            <label class="col-md-3 control-label">Postal Code <?php echo ($model->isAttributeRequired('postal_code') == true) ? '<span class="required">*</span>' : NULL; ?></label>
                            <div class="col-md-9">
                                <?= $form->field($model, 'sender_postal_code')->textInput(['maxlength' => true])->label(false); ?>
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 10px">
                            <label class="col-md-3 control-label">Blk and Street Name <?php echo ($model->isAttributeRequired('blk_street_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
                            <div class="col-md-9">
                                <?= $form->field($model, 'sender_blk_street_name')->textInput(['maxlength' => true])->label(false); ?>
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 10px">
                            <label class="col-md-3 control-label">Building Name <?php echo ($model->isAttributeRequired('bldg_name') == true) ? '<span class="required">*</span>' : NULL; ?></label>
                            <div class="col-md-9">
                                <?= $form->field($model, 'sender_bldg_name')->textInput(['maxlength' => true])->label(false); ?>
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 10px">
                            <label class="col-md-3 control-label">Unit Number <?php echo ($model->isAttributeRequired('unit_no') == true) ? '<span class="required">*</span>' : NULL; ?></label>
                            <div class="col-md-9">
                                <?= $form->field($model, 'sender_unit_no')->textInput(['maxlength' => true])->label(false); ?>
                            </div>
                        </div>

						<hr />
						<div class="clearfix"></div>
					</div>
				</div>

				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Recipient’s details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<p>Please fill in recipient's details below</p>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Recipient’s Name</label>
					<div class="col-md-9">
						<?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>
				
				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Recipient’s Company Name</label>
					<div class="col-md-9">
						<?= $form->field($model, 'receiver_company')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Tracking ID</label>
					<div class="col-md-9">
						<?= $form->field($model, 'tracking_id')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Booking ID</label>
					<div class="col-md-9">
					 <?= $form->field($model, 'delivery_book_id')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Delivery Date</label>
					<div class="col-md-9">
					 <?= $form->field($model, 'date_delivery')->textInput(['maxlength' => true, 'class' => 'form-control form-control-inline input-medium date-picker', 'data-date-format' => 'dd/mm/yyyy' ])->label(false); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Delivery Time</label>
					<div class="col-md-9">
						 <?= $form->field($model, 'status')->dropDownList([ '09:30- 13:00' => '09:30- 13:00', '13:30- 17:30' => '13:30- 17:30', '18:00- 20:30' => '18:00- 20:30', ], ['prompt' => ''])->label(false) ?>
					</div>
				</div>
				
				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Remarks</label>
					<div class="col-md-9">
						<?= $form->field($model, 'remarks')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Contact No.</label>
					<div class="col-md-9">
						<?= $form->field($model, 'receiver_contact')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Postal Code</label>
					<div class="col-md-9">
						<?= $form->field($model, 'postal_code')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Blk and Street Name</label>
					<div class="col-md-9">
						<?= $form->field($model, 'blk_street_name')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Building Name</label>
					<div class="col-md-9">
						<?= $form->field($model, 'bldg_name')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Unit Number</label>
					<div class="col-md-9">
						<?= $form->field($model, 'unit_no')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Type of product(s)</label>
					<div class="col-md-9">
						<?= $form->field($model, 'type_products')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Carton size (LxWxH)</label>
					<div class="col-md-9">
						<?= $form->field($model, 'cartoon_size')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>

				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">Carton weight (in kg)</label>
					<div class="col-md-9">
						<?= $form->field($model, 'cartoon_weight')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>
				
				<div class="form-group" style="padding-top: 10px">
					<label class="col-md-3 control-label">No. of carton(s)</label>
					<div class="col-md-9">
						<?= $form->field($model, 'no_cartoons')->textInput(['maxlength' => true])->label(false); ?>
					</div>
				</div>
				<div class="form-group" style="padding-top: 10px">
                   <label class="col-md-3 control-label">Attach Document</label>
					<div class="col-md-9">
                    <?= $form->field($modelUploadForm, 'imageFile')->fileInput()->label(false); ?>
                    </div>
                </div>   
				&nbsp;
			</div>
			<br />
		</div>

		<?php if($signature == true) { ?>
			<div id="price-change" class="col-md-5">
				<div class="portlet light bg-inverse">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject font-green-sharp ">Signature</span>
							<span class="caption-helper"></span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-body">
									<canvas class="pad customer-signature-container"></canvas>
									<ul class="sigNav">
										<li class="clearButton"><a href="#clear">Clear</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?= $form->field($model, 'signaturePad')->hiddenInput()->label(false); ?>
		<?php } ?>

		<div id="price-change" class="col-md-5">
			<div class="portlet light bg-inverse">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Admin Details</span>
						<span class="caption-helper"></span>
					</div>
				</div>
				<div class="portlet-body">
					<p>Select the availabe drivers</p>
					<br />
					<div class="row">
						<div class="col-md-12">
							<div class="form-body">
								<!-- transfer to -->
								<div class="form-group">
									<label class="col-md-3 control-label">Driver</label>
									<div class="col-md-9">
										<?= $form->field($model, 'driver_id')->dropDownList($modelDriver)->label('Driver')->label(false); ?>
									</div>
								</div>

								<hr />

								<?php if (Yii::$app->session->get('type') != \app\models\User::USERTYPE_CUSTOMER){ ?>
									<div class="form-group">
										<label class="col-md-3 control-label">Status</label>
										<div class="col-md-9">
											<?= $form->field($model, 'status')->dropDownList($statusList)->label(false) ?>
										</div>
									</div>
								<?php } ?>

								<div class="clearfix"></div>
								<div class="form-group">
									<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php ActiveForm::end(); ?>
</div>
<?php if($signature == true) { ?>
<script type="text/javascript">
$(document).ready(function() {
	var deliverySignature = $('#delivery-form').signaturePad({
		drawOnly: true,
		defaultAction: 'drawIt',
		validateFields: false,
		lineWidth: 0,
		output: null,
		sigNav: null,
		name: null,
		typed: null,
		typeIt: null,
		drawIt: null,
		typeItDesc: null,
		drawItDesc: null,
		onDrawEnd : function() {
			console.log(deliverySignature.getSignatureImage());
			$('#delivery-signaturepad').val(deliverySignature.getSignatureImage());
		}
	});
});
</script>
<?php } ?>