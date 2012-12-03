<h3>แก้ไขเที่ยวบิน</h3>
<?= $this->Form->create(); ?>
<?= $this->Form->input('Flight.departure_time', array('type' => 'time', 'timeFormat' => 24)); ?>
<?= $this->Form->input('Flight.departure_date', array('type' => 'date')); ?>
<?= $this->Form->input('Flight.arrival_time', array('type' => 'time', 'timeFormat' => 24)); ?>
<?= $this->Form->input('Flight.arrival_date', array('type' => 'date')); ?>
<?= $this->Form->input('Flight.form_city_id', array('options' => $cities)); ?>
<?= $this->Form->input('Flight.to_city_id', array('options' => $cities)); ?>
<?= $this->Form->input('Flight.type', array('options' => array('Return' => 'Return', 'Not' => 'Not Return'))); ?>
<?= $this->Form->input('Flight.price_adult'); ?>
<?= $this->Form->input('Flight.price_kids'); ?>
<?= $this->Form->input('Flight.price_baby'); ?>
<?= $this->Form->input('Flight.id', array('type' => 'hidden')); ?>
<?= $this->Form->submit('Save', array('class' => 'button', 'id' => 'booking_submit')); ?>
<?= $this->Form->end(); ?>
<?= $this->Form->button('Back', array('onclick' => "location.href='".$this->Html->url(array('action' => 'flight_manager'))."'",'class' => 'button' )); ?>