<h3>จัดการรายการ เที่ยวบิน</h3>
<?= $this->Html->link('สร้างเที่ยวบิน', array('action' => 'flight_create')); ?>
<br><br>
<div class="index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'id'; ?></th>
			<th><?php echo 'Depart Form City'; ?></th>
			<th><?php echo 'Arrival to City'; ?></th>
			<th><?php echo 'Departure DateTime'; ?></th>
			<th><?php echo 'Arrival DateTime'; ?></th>
			<th><?php echo 'Type'; ?></th>
			<th><?php echo 'Price Adult'; ?></th>
			<th><?php echo 'Price Kids'; ?></th>
			<th><?php echo 'Price Baby'; ?></th>
			<th><?php echo 'Action'; ?></th>
	</tr>
	<?php
	foreach ($flights as $flight): ?>
	<tr>
		<td><?php echo h($flight['Flight']['id']); ?>&nbsp;</td>
		<td><?php echo h($flight['Form_city']['City']['name']); ?>&nbsp;</td>
		<td><?php echo h($flight['To_city']['City']['name']); ?>&nbsp;</td>
		<?php $start_date = new DateTime($flight['Flight']['departure_date'].' '.$flight['Flight']['departure_time']); ?>
		<td><?php echo h($start_date->format('D, M j Y H:i')); ?>&nbsp;</td>
		<?php $end_date = new DateTime($flight['Flight']['arrival_date'].' '.$flight['Flight']['arrival_time']); ?>
		<td><?php echo h($end_date->format('D, M j Y H:i')); ?>&nbsp;</td>
		<td><?php echo h($flight['Flight']['type']); ?>&nbsp;</td>
		<td><?php echo h($flight['Flight']['price_adult']); ?>&nbsp;</td>
		<td><?php echo h($flight['Flight']['price_kids']); ?>&nbsp;</td>
		<td><?php echo h($flight['Flight']['price_baby']); ?>&nbsp;</td>
		<td><?= $this->Html->link('Edit', array('action' => 'flight_edit', $flight['Flight']['id'])); ?> / 
			<?php echo $this->Form->postLink(
                'Remove',
                array('action' => 'flight_delete', $flight['Flight']['id']),
                array('confirm' => 'Are you sure?'));
            ?></td>
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
		echo $this->Paginator->prev('< previous ', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ' | '));
		echo $this->Paginator->next(' next >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>