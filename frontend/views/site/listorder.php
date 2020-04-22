<?php 
$this->title = 'List Order';
?>

<div class="container">
	<table class="table">
		<tr>
			<td>Order Code</td>
			<td>Email</td>
			<td>Address</td>
			<td>Card Number</td>
			<td>Order Date</td>
		</tr>
		<?php 
		foreach ($model as $key => $value) { ?>
			<tr>
				<td><?= $value->order->code ?></td>
				<td><?= $value->email ?></td>
				<td><?= $value->address ?></td>
				<td><?= $value->card_number ?></td>
				<td><?= $value->time_created ?></td>
			</tr>
		<?php } ?>
	</table>
</div>