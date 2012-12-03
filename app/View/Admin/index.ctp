<h3>รายการตั๋วจองทั้งหมด</h3>

<div class="index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'id'; ?></th>
			<th><?php echo 'Passenger Name'; ?></th>
			<th><?php echo 'Depart Form City'; ?></th>
			<th><?php echo 'Arrival to City'; ?></th>
			<th><?php echo 'Departure DateTime'; ?></th>
			<th><?php echo 'Arrival DateTime'; ?></th>
			<th><?php echo 'Adult Count'; ?></th>
			<th><?php echo 'Kids Count'; ?></th>
			<th><?php echo 'Baby Count'; ?></th>
			<th><?php echo 'Seat Type'; ?></th>
			<th><?php echo 'Payment Method'; ?></th>
			<th><?php echo 'Credit No'; ?></th>
			<th><?php echo 'Paypal Email'; ?></th>
			<th><?php echo 'Total Price'; ?></th>
	</tr>
	<?php
	foreach ($bookings as $booking): ?>
	<tr>
		<td><?php echo h($booking['Booking']['id']); ?>&nbsp;</td>
		<td><?php echo h($booking['Passenger']['name']); ?>&nbsp;</td>
		<td><?php echo h($booking['Form_city']['City']['name']); ?>&nbsp;</td>
		<td><?php echo h($booking['To_city']['City']['name']); ?>&nbsp;</td>
		<?php $start_date = new DateTime($booking['Flight']['departure_date'].' '.$booking['Flight']['departure_time']); ?>
		<td><?php echo h($start_date->format('D, M j Y H:i')); ?>&nbsp;</td>
		<?php $end_date = new DateTime($booking['Flight']['arrival_date'].' '.$booking['Flight']['arrival_time']); ?>
		<td><?php echo h($end_date->format('D, M j Y H:i')); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['adult_count']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['kids_count']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['baby_count']); ?>&nbsp;</td>
		<?php if ($booking['Booking']['seat_type'] == 'e'): ?>
		<td><?php echo 'Economy'; ?>&nbsp;</td>
		<?php elseif ($booking['Booking']['seat_type'] == 'b'): ?>
		<td><?php echo 'Business'; ?>&nbsp;</td>
		<?php elseif ($booking['Booking']['seat_type'] == 'f'): ?>
		<td><?php echo 'First Class'; ?>&nbsp;</td>
		<?php endif; ?>
		<?php if ($booking['Booking']['payment_method'] == 'C'): ?>
		<td><?php echo 'Credit Card'; ?>&nbsp;</td>
		<?php elseif ($booking['Booking']['payment_method'] == 'P'): ?>
		<td><?php echo 'Paypal'; ?>&nbsp;</td>
		<?php elseif ($booking['Booking']['payment_method'] == 'A'): ?>
		<td><?php echo 'Airport'; ?>&nbsp;</td>
		<?php endif; ?>
		<td><?php echo h($booking['Booking']['credit_no']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['paypal_email']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['total_price']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< previous ', array(), null, array('class' => 'prev'));
		echo $this->Paginator->numbers(array('separator' => ' | '));
		echo $this->Paginator->next(' next >', array(), null, array('class' => 'next'));
	?>
	</div>
</div>