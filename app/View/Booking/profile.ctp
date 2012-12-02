<h2>ข้อมูลผู้เดินทาง</h2>
<p>กรุณากรอกข้อมูลผู้เดินทาง</p>

<?= $this->Form->create(); ?>
<?= $this->Form->input('Passenger.name', array('label' => 'ชื่อ - นามสกุล (ใช้ภาษาอังกฤษ)')); ?>
<?= $this->Form->input('Passenger.sex', array('type' => 'radio', 'options' => array('M' => 'ชาย', 'F' => 'หญิง'), 'legend' => 'เพศ')); ?>
<?= $this->Form->input('Passenger.passTel_num', array('label' => 'เบอร์โทรศัพท์')); ?>
<?= $this->Form->input('Passenger.email', array('label' => 'E-mail')); ?>
<?= $this->Form->input('Passenger.age', array('label' => 'อายุ', 'type' => 'text')); ?>
<?= $this->Form->submit('ตกลง', array('class' => 'button', 'id' => 'booking_submit')); ?>
<?= $this->Form->end(); ?>
<?= $this->Form->button('ยกเลิก', array('onclick' => "location.href='".$this->Html->url(array('action' => 'reset'))."'",'class' => 'button' )); ?>