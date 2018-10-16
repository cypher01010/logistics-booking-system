<?php 
$dateFormatDisplay = \Yii::$app->controller->dateFormatDisplay();
?>
<table>
	<tr>
		<td>
			<table class="table-sorting table-striped table-bordered">
				<tr>
					<td class=""><span class="drag-handle" style="color: #f9f9f9;">&#9776;</span></td>
					<td class="table-mobile-display">Delivery Date</td>
					<td class="table-mobile-display">Sender's Name</td>
					<td class="table-mobile-display">Status</td>
				</tr>
			</table>
			<div id="handle">
				<ul id="handle-delivery-sort">
					<?php foreach ($delivery as $key => $value) { ?>
						<li data-id="<?php echo  $value['id']; ?>">
							<table class="table-sorting table-striped table-bordered">
								<tr>
									<td class=""><span class="drag-handle">&#9776;</span></td>
									<td class="table-mobile-display"><?php echo date($dateFormatDisplay, strtotime($value['date_delivery'])); ?></td>
									<td class="table-mobile-display"><?php echo $value['sender_name']; ?></td>
									<td class="table-mobile-display"><?php echo $statusList[$value['status']]; ?></td>
								</tr>
							</table>
						</li>
					<?php } ?>
				</ul>
				<div style="clear: both"></div>
			</div>
		</td>
	</tr>
</table>