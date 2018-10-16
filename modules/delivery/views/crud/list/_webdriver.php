<?php
use yii\helpers\Html;
use yii\grid\GridView;

$statusList = array_merge(array('' => '(status)'), \Yii::$app->controller->completeStatusList());

$driverId = '';
if(isset($filtering['driver_id'])) {
	$driverId = $filtering['driver_id'];
}
$status = '';
if(isset($filtering['status'])) {
	$status = $filtering['status'];
}
$dateDelivery = '';
if(isset($filtering['date_delivery'])) {
	$dateDelivery = date(\Yii::$app->controller->dateFormatDisplay(), strtotime($filtering['date_delivery']));
}
$deliveryTime = '';
if(isset($filtering['delivery_time'])) {
	$deliveryTime = $filtering['delivery_time'];
}

$deliveryTimeList = array_merge(array('' => '(time)'), \Yii::$app->controller->deliveryTimeList());
?>
<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		//['class' => 'yii\grid\SerialColumn'],
		//'id',
		[
			'header' => "<a href='" . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index', 'sort' => $sortDateDelivery]) . "'>Delivery Date</a>",
			'format' => 'raw',
			'value' => function($data) {
				$date = '(not set)';
				if($data->date_delivery != '') {
					$date = date(\Yii::$app->controller->dateFormatDisplay(), strtotime($data->date_delivery));						
				}
				return $date;
			},
			'filter' => Html::textInput('DeliverySearch[date_delivery]', $dateDelivery, [
				'maxlength' => true,
				'class' => 'form-control form-control-inline date-picker',
				'data-date-format' => 'dd/mm/yyyy',
				'id' => 'deliverysearch-date_delivery',
			])
		],
		[
			'header' => "<a href='" . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index', 'sort' => $sortDateTime]) . "'>Delivery Timing</a>",
			'format' => 'raw',
			'value' => function($data) {
				return $data->delivery_time;
			},
			'filter' => Html::dropDownList('DeliverySearch[delivery_time]', $deliveryTime, $deliveryTimeList, [
				'class' => 'form-control',
				'id' => 'deliverysearch-delivery_time',
				'style' => 'width: 140px;',
			]),
		],
		'sender_company',
		'blk_street_name',
		'postal_code',
		'no_cartoons',
		[
			'header' => "<a href='" . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index', 'sort' => $sortDriver]) . "'>Driver's Name</a>",
			'format' => 'raw',
			'value' => function($data) {
				$driver = !isset($data->user->name) ? '(not set)' : '<a href="' . \Yii::$app->getUrlManager()->createUrl(['user/crud/view', 'id' => $data->user->id]) . '">' . $data->user->name . '</a>';
				return $driver;
			}
		],
		[
			'header' => "<a href='" . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index', 'sort' => $sortStatus]) . "'>Status</a>",
			'format' => 'raw',
			'value' => function($data) {
				$statusList = \Yii::$app->controller->completeStatusList();

				if(isset($statusList[$data->status]) && $data->status != '') {
					return $statusList[$data->status];
				} else {
					return 'No Status';
				}
			},
			'filter' => Html::dropDownList('DeliverySearch[status]', $status, $statusList, [
				'class' => 'form-control',
				'id' => 'deliverysearch-status',
			]),
		],
		[
			'header' => "<a href='" . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index', 'sort' => $sortImageSignature]) . "'>Signature</a>",
			'format' => 'raw',
			'value' => function($data) {
				return ($data->image_signature == '') ? '(not set)' : '<a href="#modal-signature" data-toggle="modal" data-image-url="' . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/signature', 'id' => $data->id]) . '" id="link-signature">view</a>';
			},
		],
		//'receiver_name',
		//'tracking_id',
		//'delivery_book_id',
		//'date_delivery',
		// 'delivery_time',
		// 'tel_no',
		// 'image_signature',
		// 'address1',
		// 'address2',
		// 'city',
		// 'province',
		// 'country_name',
		// 'zip_code',
		// 'customer_id',
		// 'vehicle_id',
		// 'package_type',
		[
			'header' => '',
			'format' => 'raw',
			'value' => function($data) {
				$links = '';

				$links .= '<a href="' . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/view', 'id' => $data->id]) . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
				$links .= '&nbsp;&nbsp;&nbsp;';
				$links .= '<a href="' . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/update', 'id' => $data->id]) . '"><span class="glyphicon glyphicon-pencil"></span></a>';

				return $links;
			}
		],
		//['class' => 'yii\grid\ActionColumn'],
	],
]); ?>