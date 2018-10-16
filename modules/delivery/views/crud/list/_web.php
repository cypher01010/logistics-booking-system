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
				$driversList = \Yii::$app->controller->getDriversList();
				unset($driversList[0]);

				$html = '';
				$html .= '<select class="form-control deliverylist-driver_id" name="DeliveryList[driver_id]"  data-delivery-id="' . $data->id . '">';
					$html .= '<option value="">(not set)</option>';
					foreach ($driversList as $driverKey => $driverValue) {
						if($data->driver_id == $driverKey) {
							$html .= '<option value="' . $driverKey . '" selected>' . $driverValue . '</option>';
						} else {
							$html .= '<option value="' . $driverKey . '"">' . $driverValue . '</option>';
						}
					}
				$html .= '</select>';
				return $html;
			},
			'filter' => Html::dropDownList('DeliverySearch[driver_id]', $driverId, \Yii::$app->controller->getDriversList(), [
				'class' => 'form-control',
				'id' => 'deliverysearch-driver_id',
			]),
		],
		[
			'header' => "<a href='" . \Yii::$app->getUrlManager()->createUrl(['delivery/crud/index', 'sort' => $sortStatus]) . "'>Status</a>",
			'format' => 'raw',
			'value' => function($data, $drivers) {
				$statusList = \Yii::$app->controller->completeStatusList();

				$html = '';
				$html .= '<select id="delivery-status" class="form-control" name="Delivery[status]"  data-delivery-id="' . $data->id . '">';
					$html .= '<option value="">(not set)</option>';
					foreach ($statusList as $statusKey => $statusValue) {
						if($data->status == $statusKey) {
							$html .= '<option value="' . $statusKey . '" selected>' . $statusValue . '</option>';
						} else {
							$html .= '<option value="' . $statusKey . '">' . $statusValue . '</option>';
						}
					}
				$html .= '</select>';
				return $html;
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
				$links .= '&nbsp;&nbsp;&nbsp;';
				$links .=  Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $data->id], [
					'data' => [
						'confirm' => 'Are you sure you want to delete this delivery?',
						'method' => 'post',
					],
				]);

				return $links;
			}
		],
		//['class' => 'yii\grid\ActionColumn'],
	],
]); ?>

<p>
	<?= Html::a('Book Delivery', ['create'], ['class' => 'btn btn-success']) ?>
	<?php if($driverId != '') { ?>
		<a href="#modal-sort-delivery" data-toggle="modal" data-delivery-id="<?php echo $driverId; ?>" id="sort-delivery" name="sort-delivery" class="btn btn-primary">Sort Delivery</a>

		<div class="modal fade" id="modal-sort-delivery" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog modal-full">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Sort Delivery</h4>
					</div>
					<div class="modal-body">
						<span id="modal-sort-signature-display">
							<div id="container-sorting"></div>
						</span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn default" data-dismiss="modal">Close</button>
						<span id="save-sorting">
							<button type="button" class="btn btn-primary" id="modal-sort-delivery-button" name="modal-sort-delivery-button">Sort Delivery</button>
						</span>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</p>

<script type="text/javascript">
$(document).ready(function($) {
	$(document).on('change', '.deliverylist-driver_id', function() {
		var driverId = $(this).val();
		var deliveryId = $(this).attr('data-delivery-id');

		jQuery.ajax({
			type : "POST",
			url : "<?php echo \Yii::$app->getUrlManager()->createUrl('delivery/crud/updatedriver'); ?>",
			cache : true,
			data : {
				driverId : driverId,
				deliveryId : deliveryId,
				_csrf : $('meta[name="csrf-token"]').attr("content")
			},
			dataType:'json',
			success: function(response) {}
		});
	});
	$(document).on('change', '#delivery-status', function() {
		var status = $(this).val();
		var deliveryId = $(this).attr('data-delivery-id');

		jQuery.ajax({
			type : "POST",
			url : "<?php echo \Yii::$app->getUrlManager()->createUrl('delivery/crud/updatestatus'); ?>",
			cache : true,
			data : {
				status : status,
				deliveryId : deliveryId,
				_csrf : $('meta[name="csrf-token"]').attr("content")
			},
			dataType:'json',
			success: function(response) {}
		});
	});
	$(document).on('click', '#sort-delivery', function() {
		var date = $('#deliverysearch-date_delivery').val();
		var time = $('#deliverysearch-delivery_time').val();
		var driver = $('#deliverysearch-driver_id').val();
		var status = $('#deliverysearch-status').val();

		jQuery.ajax({
			type : "POST",
			url : "<?php echo \Yii::$app->getUrlManager()->createUrl('delivery/crud/recordsort'); ?>",
			cache : true,
			data : {
				date : date,
				time : time,
				driver : driver,
				status : status,
				_csrf : $('meta[name="csrf-token"]').attr("content")
			},
			dataType:'json',
			success: function(response) {
				if(response.success == true) {
					$('#container-sorting').empty().append(response.html);
					var list = document.getElementById("handle-delivery-sort");
					Sortable.create(list, {handle: '.drag-handle', animation: 150});
				}
			}
		});
	});
	$(document).on('click', '#modal-sort-delivery-button', function() {
		var children = $('#handle-delivery-sort').children();
		var sorting = new Array();

		$.each(children, function(i, obj) {
			var id = $(obj).attr('data-id');
			sorting.push(id);
		});

		jQuery.ajax({
			type : "POST",
			url : "<?php echo \Yii::$app->getUrlManager()->createUrl('delivery/crud/savesort'); ?>",
			cache : true,
			data : {
				sorting : sorting,
				_csrf : $('meta[name="csrf-token"]').attr("content")
			},
			dataType:'json',
			success: function(response) {
				if(response.success == true) {
					window.location.reload();
				}
			}
		});
	});
});
</script>