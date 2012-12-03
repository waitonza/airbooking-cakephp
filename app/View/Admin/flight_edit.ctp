<h3>แก้ไขเที่ยวบิน</h3>
<?= $this->Form->create(); ?>
<div class = "row">
<?= $this->Form->input('Flight.departure_time', array('type' => 'time', 'timeFormat' => 24, 'id' => 'deptime')); ?>
<?= $this->Form->input('Flight.departure_date', array('type' => 'date' , 'id' =>'depdate')); ?>
<?= $this->Form->input('Flight.arrival_time', array('type' => 'time', 'timeFormat' => 24, 'id' => 'arrtime')); ?>
<?= $this->Form->input('Flight.arrival_date', array('type' => 'date','id' => 'arrdate')); ?>
<?= $this->Form->input('Flight.form_city_id', array('options' => $cities,'id' => 'fromid')); ?>
<?= $this->Form->input('Flight.to_city_id', array('options' => $cities,'id' => 'toid')); ?>
<?= $this->Form->input('Flight.type', array('options' => array('Return' => 'Return', 'Not' => 'Not Return'), 'id' => 'returnid')); ?>
<?= $this->Form->input('Flight.price_adult', array('id' => 'adultid')); ?>
<?= $this->Form->input('Flight.price_kids', array('id' => 'kidsid')); ?>
<?= $this->Form->input('Flight.price_baby', array('id' => 'babyid')); ?>
<?= $this->Form->input('Flight.id', array('type' => 'hidden')); ?>
</div>
<input class="button" id="booking_submit" type="submit" value="Save" style="
    margin-left: 850px;
">
<?= $this->Form->end(); ?>
<button onclick="location.href='/admin/flight_manager'" class="button" type="submit" style="
    margin-top: -56px;
    margin-left: 750px;
">ยกเลิก</button>