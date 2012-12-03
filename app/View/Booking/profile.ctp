<h2>ข้อมูลผู้เดินทาง</h2>
<p>กรุณากรอกข้อมูลผู้เดินทาง</p>

<?= $this->Form->create(); ?>
<div class="row">
<?= $this->Form->input('Passenger.name', array('label' => 'ชื่อ - นามสกุล (ใช้ภาษาอังกฤษ)', 'class' => 'six columns')); ?>
</div>
<div class = "row">
	<?= $this->Form->input('Passenger.sex', array('type' => 'radio', 'options' => array('M' => 'ชาย', 'F' => 'หญิง'), 'legend' => 'เพศ' , 'class' => 'six columns')); ?>
</div>
<div class = "row" >
<?= $this->Form->input('Passenger.passTel_num', array('label' => 'เบอร์โทรศัพท์' , 'class' => 'four columns')); ?>
</div>
<div class = "row">
<?= $this->Form->input('Passenger.email', array('label' => 'E-mail' , 'class' => 'four columns')); ?>
</div>
<div class = "row" >
<?= $this->Form->input('Passenger.age', array('label' => 'อายุ', 'type' => 'text' , 'class' => 'one columns')); ?>
</div>
<input class="button" id="booking_submit" type="submit" value="ตกลง" style="
    margin-left: 850px;
">
<?= $this->Form->end(); ?>
<button onclick="location.href='/booking/reset'" class="button" type="submit" style="
    margin-top: -56px;
    margin-left: 750px;
">ยกเลิก</button>