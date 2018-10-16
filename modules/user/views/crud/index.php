<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			//'id',
			'type',
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
			// 'status',
			// 'type',
			[
				'header' => '',
				'format' => 'raw',
				'value' => function($data) {
					$links = '';

					$links .= '<a href="' . \Yii::$app->getUrlManager()->createUrl(['user/crud/view', 'id' => $data->id]) . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
					$links .= '&nbsp;&nbsp;&nbsp;';
					$links .= '<a href="' . \Yii::$app->getUrlManager()->createUrl(['user/crud/update', 'id' => $data->id]) . '"><span class="glyphicon glyphicon-pencil"></span></a>';

					return $links;
				}
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

	<p>
		<?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
</div>
