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
		<?php foreach($list as $key => $value) { ?>
			<tr>
				<td><?php echo date(\Yii::$app->controller->dateFormatDisplay(), strtotime($value['date_delivery'])) ?></td>
				<td><?php echo $value['sender_name'] ?></td>
				<td><?php echo $value['receiver_name'] ?></td>
				<td><span class="label label-sm label-<?php echo $value['status'] ?>"><?php echo ucfirst($value['status']) ?></span></td>
			</tr>
		<?php } ?>
	</tbody>
</table>