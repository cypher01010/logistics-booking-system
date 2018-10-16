<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- BEGIN PAGE HEADER-->
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
			<a href="index.html"><?= Html::encode($this->title) ?></a>
		</li>
	</ul>
</div>

<div class="row"> 
    <!-- left-->
    <div class="col-md-6">
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-sharp ">Fill in vehicle details</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body form">

            <?php $form = ActiveForm::begin(); ?>
                <div class="form-body">

                  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code</label>
                        <div class="col-md-9">
                            <?= $form->field($model, 'code')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                    </div>

                   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Vehicle Number</label>
                        <div class="col-md-9">
                           <?= $form->field($model, 'vehicle_no')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Speed Limit</label>
                        <div class="col-md-9">
                           <?= $form->field($model, 'speed_limit')->textInput()->label(false) ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Stationary Limit</label>
                        <div class="col-md-9">
                           <?=  $form->field($model, 'stationary_limit')->textInput()->label(false) ?>
                        </div>
                    </div>

                    <hr>
                   
                      <div class="form-group">
						<?= Html::submitButton('Add Vehicle', ['class' => 'btn btn-success']) ?>
					</div>
                    <div class="clearfix"></div>
                </div>
            <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>

    <!-- right -->
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
                        <p>Total Number of Vehicles</p>
                    </div>
                    <div class="col-xs-6">
                        <p class="text-right">5</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>