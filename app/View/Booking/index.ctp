<h2>จองตั๋วเครื่องบิน</h2>

<p>คุณสามารถจองตั๋วเครื่องบินทาง Online ได้ล่วงหน้า 4 ชั่วโมง</p>

<h3>ค้นหาตามรายละเอียด</h3>

<?= $this->Form->create(); ?>
<div class="row">
	<div class="three columns">
	<?= $this->Form->input('Flight.type',array('type' => 'radio', 'legend' => 'ประเภทการเดินทาง', 'options' => array( 'Return' => 'ไป-กลับ', 'Not' => 'เที่ยวเดียว'),'default' => 0,'div' => false)); ?>
	</div>
	<div class="six columns pull-three">
		<fieldset>
			<legend>ข้อมูลการเดินทาง</legend>
			<div class="five columns">
			<?= $this->Form->input('City.Form_id', array('class' => false, 'options' => $cities, 'div' => false, 'label' => 'เดินทางจาก :', 'empty' => '(โปรดเลือก)'));?>
			<?= $this->Form->input('City.to_id', array('class' => false, 'options' => $cities, 'div' => false, 'label' => 'ถึง :', 'empty' => '(โปรดเลือก)'));?>
			</div>
			<div class="seven columns">
			<?= $this->Form->input('City.to_id', array('class' => false, 'type' => 'date', 'dateFormat' => 'DMY' , 'div' => false, 'label' => 'วันออกเดินทาง', 'id' => 'date',
    		'minYear' => date('Y'),
    		'maxYear' => date('Y') + 1));?>
    			<div id="dateback">
    				<?= $this->Form->input('City.to_id', array('class' => false, 'type' => 'date', 'dateFormat' => 'DMY' , 'div' => false, 'label' => 'วันเดินทางกลับ', 'id' => 'date',
    					'minYear' => date('Y'),
    					'maxYear' => date('Y') + 1));?>
    			</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row">
	<div class="six columns">
		<fieldset>
			<legend>จำนวนตั๋ว</legend>
			<div class="four columns">
			<?= $this->Form->input('City.to_id', array('class' => 'ticketnum', 'type' => 'select', 
			'options' => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9,
			)
			,'div' => false, 'label' => 'ผู้ใหญ่', 'default' => 1)); ?>
			</div>
			<div class="four columns">
		<?= $this->Form->input('City.to_id', array('class' => 'ticketnum', 'type' => 'select', 
			'options' => array(
				0 => 0,
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
			)
			,'div' => false, 'label' => 'เด็ก (2-11 ปี)','default' => 0)); ?>
			</div>
			<div class="four columns">
				<?= $this->Form->input('City.to_id', array('class' => 'ticketnum', 'type' => 'select', 
			'options' => array(
				0 => 0,
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
			)
			,'div' => false, 'label' => 'เด็กทารก','default' => 0)); ?>
			</div>
		
		</fieldset>
	</div>
	<div class="six columns">
		<?= $this->Form->submit('จองและซื้อ', array('class' => 'button', 'id' => 'booking_submit')); ?>
	</div>
</div>
<?= $this->Form->end(); ?>

<script type="text/javascript">
	$(document).ready(function(){
			$("#CityBool0").change(function(){
				if($('#CityBool0').attr('checked') == "checked") {
					$("#dateback").show();
				}
			});
			
			$("#CityBool1").change(function(){
				if($('#CityBool1').attr('checked') == "checked") {
					$("#dateback").hide();
				}
			});
	});
</script>