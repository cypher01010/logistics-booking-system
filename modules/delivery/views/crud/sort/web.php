<?php 
$dateFormatDisplay = \Yii::$app->controller->dateFormatDisplay();
?>
<table class="table-sorting table table-striped table-bordered">
	<tr>
		<td class="table-handler-drag-header"></td>
		<td class="table-handler-date"><strong>Delivery Date</strong></td>
		<td class="table-handler-time"><strong>Delivery Timing</strong></td>
		<td class="table-handler-sendername"><strong>Sender's Name</strong></td>
		<td class="table-handler-blk"><strong>Recipient's Blk and street name</strong></td>
		<td class="table-handler-postal"><strong>Recipient's Postal code</strong></td>
		<td class="table-handler-status"><strong>Status</strong></td>
	</tr>
</table>
<div id="handle">
	<ul id="handle-delivery-sort">
		<?php foreach ($delivery as $key => $value) { ?>
			<li data-id="<?php echo  $value['id']; ?>">
				<table class="table-sorting table table-striped table-bordered">
					<tr>
						<td class="table-handler-drag"><span class="drag-handle">&#9776;</span></td>
						<td class="table-handler-date"><?php echo date($dateFormatDisplay, strtotime($value['date_delivery'])); ?></td>
						<td class="table-handler-time"><?php echo $value['delivery_time']; ?></td>
						<td class="table-handler-sendername"><?php echo $value['sender_name']; ?></td>
						<td class="table-handler-blk"><?php echo $value['blk_street_name']; ?></td>
						<td class="table-handler-postal"><?php echo $value['postal_code']; ?></td>
						<td class="table-handler-status"><?php echo $statusList[$value['status']]; ?></td>
					</tr>
				</table>
			</li>
		<?php } ?>
	</ul>
	<div style="clear: both"></div>
</div>