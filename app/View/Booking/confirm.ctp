<h2>ตรวจสอบข้อมูล</h2>

<div class="container">
	<h3>ผู้ซื้อตั๋ว</h3>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td>สายการบิน :</td>
			<td>
				Thai Airways Intl
			</td>
		</tr>

		<tr>
			<td>ผู้เดินทาง :</td>

			<td>
				<?= $data3['Passenger']['name']; ?>
			</td>
		</tr>

		<tr>
			<td>เพศ :</td>

			<td>
				<?php 
				if ($data3['Passenger']['sex'] == 'M') 
				{
					echo 'ชาย';
				} 
				else if($data3['Passenger']['sex'] == 'F')
				{
					echo 'หญิง';
				}
				?>
			</td>
		</tr>

		<tr>
			<td>เบอร์โทรศัพท์ที่ติดต่อได้ :</td>

			<td>
				<?= $data3['Passenger']['passTel_num']; ?>
			</td>
		</tr>

		<tr>
			<td>อีเมล์ :</td>

			<td>
				<?= $data3['Passenger']['email']; ?>
			</td>
		</tr>
	</table>

	<h3>ข้อมูลการเดินทาง</h3>
	<table cellspacing="0" cellpadding="0">

		<?php if ($flight_sel['Flight']['type'] == 'Return' || $flight_sel['Flight']['type'] == 'Not'): ?>
		<tr>
			<td>
				<?= $form_city['City']['name']; ?> ถึง <?= $to_city['City']['name']; ?>
			</td>
			<td>
				<?= date("D, M j Y",strtotime($flight_sel['Flight']['departure_date'])) ?>
			</td>
			<td>
				<?php $time = new DateTime($flight_sel['Flight']['departure_time']); echo $time->format('H:i'); ?> - <?php $time = new DateTime($flight_sel['Flight']['arrival_time']); echo $time->format('H:i'); ?>
			</td>
		</tr>
		<? endif; ?>

		<?php if ($flight_sel['Flight']['type'] == 'Return'): ?>
		<tr>
			<td>
				<?= $to_city['City']['name']; ?> ถึง <?= $form_city['City']['name']; ?>
			</td>
			<td>
				<?= date("D, M j Y",strtotime($flight_sel['Flight']['arrival_date'])) ?>
			</td>
			<td>
				<?php $time = new DateTime($flight_sel['Flight']['departure_time']); echo $time->format('H:i'); ?> - <?php $time = new DateTime($flight_sel['Flight']['arrival_time']); echo $time->format('H:i'); ?>
			</td>
		</tr>
		<? endif; ?>
	</table>

	<h3>ราคา</h3>
	<table border="0" cellspacing="0" cellpadding="0">
		<tr align="right">
			<td class="header">ผู้เดินทาง</td>
			<td>&nbsp;</td>
			<td class="header">เที่ยวบิน</td>
			<td>&nbsp;</td>
			<td class="header">
				ภาษี
			</td>
		</tr>
		<tr align="right" class="fared2">
			<td>
				<?= $data1['Booking']['adult_count']; ?> ผู้ใหญ่
			</td>
			<td align="center">
				x
			</td>
			<td>(<?= $flight_sel['Flight']['price_adult']; ?>.00</td>
			<td align="center">+</td>
			<td>
				<?php 
				if($data1['Booking']['adult_count'] == 0) 
				{
					echo '0.00)';
		} else 
		{
			echo '200.00)';
		}
		?>
	</td>
	<td align="center">
		=
	</td>
	<td class="textLighterBold">
		<span id="totalForATravellerType_ADT">
			<?php 
			$result_a = $flight_sel['Flight']['price_adult'] + 200;
			$result_a = $result_a * $data1['Booking']['adult_count'];
			echo $result_a;
			?>.00 THB
		</span>
	</td>
	<td>&nbsp;</td>
</tr>
<tr align="right" class="fared2">
	<td>
		<?= $data1['Booking']['kids_count']; ?> เด็ก
	</td>
	<td align="center">
		x
	</td>
	<td>(<?= $flight_sel['Flight']['price_kids']; ?>.00</td>
	<td align="center">+</td>
	<td>
		<?php if($data1['Booking']['kids_count'] == 0): ?>
		0.00)
	<?php else: ?>
	200.00)
<?php endif; ?>
</td>
<td align="center">
	=
</td>
<td class="textLighterBold">
	<?php 
	$result_k = $flight_sel['Flight']['price_kids'] + 200;
	$result_k = $result_k * $data1['Booking']['kids_count'];
	echo $result_k;
	?>.00 THB
</td>
</tr>
<tr align="right" class="fared2">
	<td>
		<?= $data1['Booking']['baby_count']; ?> ทารก
	</td>
	<td align="center">
		x
	</td>
	<td>(<?= $flight_sel['Flight']['price_baby']; ?>.00</td>
	<td align="center">+</td>
	<td>
		<?php if($data1['Booking']['baby_count'] == 0): ?>
		0.00)
	<?php else: ?>
	200.00)
<?php endif; ?>
</td>
<td align="center">
	=
</td>
<td class="textLighterBold">
	<span id="totalForATravellerType_ADT">
		<?php 
		$result_b = $flight_sel['Flight']['price_baby'] + 200;
		$result_b = $result_b * $data1['Booking']['baby_count'];
		echo $result_b;
		?>.00 THB
	</span>
</td>
</tr>
<tr>
	<td colspan="11" class="space"></td>
</tr>
<tr align="right">
	<td id="totalLabel" colspan="5" class="underline2">
		<span class="textColorBold">
			จำนวนรวมผู้เดินทางทั้งหมด
		</span>
	</td>
	<td align="center" class="underline2">&nbsp;</td>
	<td class="underline2">
		<span id="spanTotalPriceOfAllPax">
			<?php 
			$result = $result_a + $result_k + $result_b;
			echo $result;
			?>.00 THB
		</span>
	</table>

	<h3>การจ่ายเงิน</h3>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td>จ่ายเงินผ่านช่องทาง : </td>
			<td>
				<?php 
				if ($data4['Payment']['method'] == 'C') {
					echo 'บัตรเครดิด';
				} else if ($data4['Payment']['method'] == 'P') {
					echo 'Paypal';
				} else if ($data4['Payment']['method'] == 'A') {
					echo 'จ่ายค่าตั๋ว ณ สนามบิน';
				}
				?>
			</td>
		</tr>
		<?php if ($data4['Payment']['method'] == 'C'): ?>
		<tr>
			<td>หมายเลขบัตร Credit :</td>

			<td>
				<?= $data4['Payment']['credit_no']; ?>
			</td>
		</tr>

		<?php elseif ($data4['Payment']['method'] == 'P'): ?>
		<tr>
			<td>ที่อยู่อีเมล์ของบัญชี Paypal :</td>

			<td>
				<?= $data4['Payment']['paypal_email']; ?>
			</td>
		</tr>
		<?php endif; ?>

		<tr>
			<td>การรับบัตรโดยสาร :</td>

			<td>
				<?php 
				if ($data4['Payment']['method'] != 'A') {
					echo 'บัตรโดยสารอิเล็กทรอนิกส์';
				} else {
					echo 'รับตั๋ว ณ สนามบิน';
				}
				?>
			</td>
		</tr>

	</table>

	<?= $this->Form->create(); ?>
	<input class="button" id="booking_submit" type="submit" value="ยืนยัน" style="
    margin-left: 850px;
">
<?= $this->Form->end(); ?>
<button onclick="location.href='/booking/reset'" class="button" type="submit" style="
    margin-top: -56px;
    margin-left: 750px;
">ยกเลิก</button>