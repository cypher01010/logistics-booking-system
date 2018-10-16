<?php
$this->title = 'Dashboard';
?>
<h3 class="page-title">Dashboard</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="javascript:;">Dashboard</a>
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
<div class="row">
	<div id="portfolio" class="col-md-6">
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-green-sharp ">Calendar</span>
					<span class="caption-helper"></span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
					<p style="padding-left: 15px">
						<div id='calendar'></div>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div id="price-change" class="col-md-6">
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-green-sharp ">Deliveries : <span id="date-deliveries"><?php echo date(\Yii::$app->controller->dateFormatDisplay(), time()); ?></span></span>
					<span class="caption-helper"></span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Date</th>
								<th>Sender</th>
								<th>Recipient</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($recentDelivery as $recentDelivery) {?>
								<tr>
									<td><?php echo date('M d, Y', strtotime($recentDelivery['date_delivery'])) ?></td>
									<td><?php echo $recentDelivery['sender_name'] ?></td>
									<td><?php echo $recentDelivery['receiver_name'] ?></td>
									<td><span class="label label-sm label-<?php echo $recentDelivery['status'] ?>"><?php echo ucfirst($recentDelivery['status']) ?></span></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<a href="<?php echo \Yii::$app->getUrlManager()->createUrl(["delivery/crud/index", "sort" => "-date_delivery"]); ?>" style="float:right" class="btn btn-success align-right">View all</a>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#calendar').fullCalendar({
		theme: true,
		header: {
			right: 'today,prev,next',
			center: '',
			left: 'title'
		},
		editable: true,
		eventLimit: true,
		events: function(start, end, timezone, callback) {
			$.ajax({
				type : "POST",
				url : '<?php echo \Yii::$app->getUrlManager()->createUrl("delivery/default/calendar"); ?>',
				cache : true,
				data : {
					start : start.unix(),
					end : end.unix(),
					_csrf : $('meta[name="csrf-token"]').attr("content")
				},
				dataType:'json',
				success: function(response) {
					var events = [];
					$(response).each(function() {
						events.push({
							title : $(this).attr('title'),
							start : $(this).attr('start')
						});
					});
					callback(events);
				}
			});
		},
		eventClick: function(event, jsEvent, view) {
			redirectDelivery(event.start._i);
		},
		dayClick: function(date, jsEvent, view) {
			redirectDelivery(date.format());
		}
	});
});
function redirectDelivery(day) {
	$.ajax({
		type : "POST",
		url : '<?php echo \Yii::$app->getUrlManager()->createUrl('user/list/dateurl'); ?>',
		cache : true,
		data : {
			date : day,
			_csrf : $('meta[name="csrf-token"]').attr("content")
		},
		dataType:'json',
		success: function(response) {
			if(response.status == true) {
				window.location.href = response.url;
			}
		}
	});
}
</script>