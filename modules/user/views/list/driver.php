<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<h3 class="page-title">Driver</h3>
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
			<a href="javascript:;">Driver</a>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="<?php echo date("M d, Y")?>">
			<i class="fa fa-calendar"></i>
			<span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
		</div>
	</div>
</div>
<div class="user-index">
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'columns' => [
			//['class' => 'yii\grid\SerialColumn'],
			'id',
			//'type',
			//'username',
			'name',
			//'address1',
			//'address2',
			// 'city',
			// 'province',
			// 'country_name',
			// 'zip_code',
			'email:email',
			// 'password',
			// 'hash',
			// 'password_updated',
			// 'date_created',
			// 'date_updated',
			 'status',
			// 'type',
			[
				'header' => '',
				'format' => 'raw',
				'value' => function($data) {
					$links = '';

					$links .= '<a href="' . \Yii::$app->getUrlManager()->createUrl(['user/crud/view', 'id' => $data->id]) . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
					$links .= '&nbsp;&nbsp;&nbsp;';
					$links .= '<a href="' . \Yii::$app->getUrlManager()->createUrl(['user/crud/update', 'id' => $data->id]) . '"><span class="glyphicon glyphicon-pencil"></span></a>';
					$links .= '&nbsp;&nbsp;&nbsp;';
					$links .=  Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $data->id], [
						'data' => [
							'confirm' => 'Are you sure you want to delete this user?',
							'method' => 'post',
						],
					]);

					return $links;
				}
			],
			//['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<p><?= Html::a('Create Driver', \Yii::$app->getUrlManager()->createUrl(['user/crud/create', 'tab' => 'driver']), ['class' => 'btn btn-success']) ?></p>
</div>