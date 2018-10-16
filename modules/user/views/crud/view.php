<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
?>
<h3 class="page-title">User Information : <?= Html::encode($this->title) ?></h3>
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
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="<?php echo date("M d, Y")?>">
			<i class="fa fa-calendar"></i>
			<span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
		</div>
	</div>
</div>
<div class="user-view">
	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php
			$sessionId = \Yii::$app->session->get('id');
			if($sessionId != $model->id) {
				switch (\Yii::$app->session->get('type')) {
					case \app\models\User::USERTYPE_SUPER_ADMIN:
						echo Html::a('Delete', ['delete', 'id' => $model->id], [
							'class' => 'btn btn-danger',
							'data' => [
								'confirm' => 'Are you sure you want to delete this user?',
								'method' => 'post',
							],
						]);
						break;
				}
			}
		?>
	</p>
	<?php if($model->type == \app\models\User::USERTYPE_CUSTOMER) { ?>
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				[
					'attribute' => 'id',
					'label' => 'Customer ID',
					'format' => 'raw',
					'value' => $model->id,
				],
				[
					'attribute'=>'name',
					'label' => 'Company Name',
					'format' => 'raw',
					'value' => ($model->name == '') ? '(not set)' : $model->name,
				],
				'company_phone',
				[
					'attribute'=>'zip_code',
					'label' => 'Postal Code',
					'format' => 'raw',
					'value' => ($model->zip_code == '') ? '(not set)' : $model->zip_code,
				],
				[
					'attribute'=>'address1',
					'label' => 'Street',
					'format' => 'raw',
					'value' => ($model->address1 == '') ? '(not set)' : $model->address1,
				],
				'building_name',
				'unit_number',
				'contact_person',
				'contact_number',
				'email:email',
				[
					'attribute'=>'status',
					'label' => 'Status',
					'format' => 'raw',
					'value' => ucfirst($model->status),
				],
				[
					'attribute'=>'date_created',
					'label' => 'Date Created',
					'format' => 'raw',
					'value' => ($model->date_created == '') ? '(not set)' : date(\Yii::$app->controller->dateFormatDisplay(), strtotime($model->date_created)),
				],
				[
					'attribute'=>'date_updated',
					'label' => 'Date Updated',
					'format' => 'raw',
					'value' => ($model->date_updated == '') ? '(not set)' : date(\Yii::$app->controller->dateFormatDisplay(), strtotime($model->date_updated)),
				],
				[
					'attribute'=>'password_updated',
					'label' => 'Password Updated',
					'format' => 'raw',
					'value' => ucfirst($model->password_updated),
				],
				[
					'attribute'=>'type',
					'label' => 'User Type',
					'format' => 'raw',
					'value' => ucfirst($model->type),
				],
			],
		]) ?>
	<?php } else if($model->type == \app\models\User::USERTYPE_DRIVER) { ?>
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				[
					'attribute' => 'id',
					'label' => 'Driver ID',
					'format' => 'raw',
					'value' => $model->id,
				],
				[
					'attribute'=>'name',
					'label' => 'Name',
					'format' => 'raw',
					'value' => ($model->name == '') ? '(not set)' : $model->name,
				],
				'email:email',
				'username',
				[
					'attribute'=>'status',
					'label' => 'Status',
					'format' => 'raw',
					'value' => ucfirst($model->status),
				],
				[
					'attribute'=>'date_created',
					'label' => 'Date Created',
					'format' => 'raw',
					'value' => ($model->date_created == '') ? '(not set)' : date(\Yii::$app->controller->dateFormatDisplay(), strtotime($model->date_created)),
				],
				[
					'attribute'=>'date_updated',
					'label' => 'Date Updated',
					'format' => 'raw',
					'value' => ($model->date_updated == '') ? '(not set)' : date(\Yii::$app->controller->dateFormatDisplay(), strtotime($model->date_updated)),
				],
				[
					'attribute'=>'password_updated',
					'label' => 'Password Updated',
					'format' => 'raw',
					'value' => ucfirst($model->password_updated),
				],
				[
					'attribute'=>'type',
					'label' => 'User Type',
					'format' => 'raw',
					'value' => ucfirst($model->type),
				],
			],
		]) ?>
	<?php } else { ?>
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				[
					'attribute' => 'id',
					'label' => 'Admin ID',
					'format' => 'raw',
					'value' => $model->id,
				],
				[
					'attribute'=>'name',
					'label' => 'Name',
					'format' => 'raw',
					'value' => ($model->name == '') ? '(not set)' : $model->name,
				],
				'email:email',
				'username',
				[
					'attribute'=>'status',
					'label' => 'Status',
					'format' => 'raw',
					'value' => ucfirst($model->status),
				],
				[
					'attribute'=>'date_created',
					'label' => 'Date Created',
					'format' => 'raw',
					'value' => ($model->date_created == '') ? '(not set)' : date(\Yii::$app->controller->dateFormatDisplay(), strtotime($model->date_created)),
				],
				[
					'attribute'=>'date_updated',
					'label' => 'Date Updated',
					'format' => 'raw',
					'value' => ($model->date_updated == '') ? '(not set)' : date(\Yii::$app->controller->dateFormatDisplay(), strtotime($model->date_updated)),
				],
				[
					'attribute'=>'password_updated',
					'label' => 'Password Updated',
					'format' => 'raw',
					'value' => ucfirst($model->password_updated),
				],
				[
					'attribute'=>'type',
					'label' => 'User Type',
					'format' => 'raw',
					'value' => ucfirst($model->type),
				],
			],
		]) ?>
	<?php } ?>
</div>