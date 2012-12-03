<h2>ตรวจสอบข้อมูลเที่ยวบิน และการจ่ายเงิน</h2>
<div class="container">

<?php if ($flight_sel['Flight']['type'] == 'Return' || $flight_sel['Flight']['type'] == 'Not'): ?>
  <table cellspacing="0" cellpadding="0">
    <tbody><tr>
      <th colspan="3">
        <?= $form_city['City']['name']; ?> ถึง <?= $to_city['City']['name']; ?>
      </th>
    </tr>
    <tr>
      <td>เที่ยวบิน 1</td>
      <td width="83%" class="textBold" colspan="2">
        <?= date("D, M j Y",strtotime($flight_sel['Flight']['departure_date'])) ?>
      </td>
    </tr>
    <tr>
      <td class="textColorBold" valign="top">&nbsp;</td>
      <td style="padding:0px" colspan="2">
        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td style="padding:0px" colspan="3">
              <table width="100%" cellspacing="0" cellpadding="0">
                <tbody><tr>
                  <td width="15%" class="textBold"><span class="nowrap">ออกเดินทาง:</span></td>
                  <td class="nowrap"><?php $time = new DateTime($flight_sel['Flight']['departure_time']); echo $time->format('H:i'); ?></td>
                  <td width="90%">
                    <?= $form_city['City']['name']; ?>, <?= $form_city['Country']['name']; ?> - <?= $form_airport[1]['Airport']['airportName'] ?>
                  </td>
                </tr>
                <tr>
                  <td class="textBold"><span class="nowrap">เดินทางถึง:</span></td>
                  <td class="nowrap"><?php $time = new DateTime($flight_sel['Flight']['arrival_time']); echo $time->format('H:i'); ?>
                  </td>
                  <td>
                   <?= $to_city['City']['name']; ?>, <?= $to_city['Country']['name']; ?> - <?= $to_airport[$to_rand_no]['Airport']['airportName'] ?>
                 </td>
               </tr>
             </tbody></table>
           </td>
         </tr>
         <tr>
          <td colspan="4" class="space"></td>
        </tr>
        <tr>
          <td width="15%" class="textBoldSmallFlight">
            สายการบิน
          </td>
          <td id="segAirline_0_0" width="35%">
            Thai Airways Intl&nbsp;TG710
          </td>
          <td width="50%" colspan="2" rowspan="1" valign="top" style="padding:0px">

            <table width="100%" cellspacing="0" cellpadding="0"><tbody><tr>
              <td width="29%">เครื่องบิน</td>
              <td>
                Airbus Industrie A320-100/200
              </td>
            </tr>
          </tbody></table>
        </td>
      </tr>
      <tr>
        <td></td>

      </tr>
      <tr id="faretype">
        <td class="textBoldSmallFlight" nowrap="nowrap">ประเภทค่าโดยสาร:</td>
        <td>
          <?php 
          if ($class_sel == 'e') {
            $class = 'Ecomony / ราคาประหยัด';
          } else if ($class_sel == 'b') {
            $class = 'Bussiness / ราคาปกติ';
          } else if ($class_sel == 'f') {
            $class = 'First Class / ชั้นพิเศษ';
          } 
          ?>
          <?= $class ?>
        </td>
      </tr>
    </tbody></table>
  </td>
</tr>

<tr>
  <td></td>
  <td class="space" colspan="2">&nbsp;</td>
</tr>


</tbody></table>
<? endif; ?>

<?php if ($flight_sel['Flight']['type'] == 'Return'): ?>

<table cellspacing="0" cellpadding="0" style="border-top:none">
  <tbody><tr>
    <th colspan="3">
      <?= $to_city['City']['name']; ?> ถึง <?= $form_city['City']['name']; ?>
    </th>
  </tr>
  <tr>
    <td class="textBold flight">เที่ยวบิน 1</td>
    <td width="83%" class="textBold" colspan="2">
      <?= date("D, M j Y",strtotime($flight_sel['Flight']['arrival_date'])) ?>
    </td>
  </tr>
  <tr>
    <td class="textColorBold" valign="top">&nbsp;</td>
    <td style="padding:0px" colspan="2">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td style="padding:0px" colspan="3">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody><tr>

                <td width="15%" class="textBold"><span class="nowrap">ออกเดินทาง:</span></td>
                <td class="nowrap"><?php $time = new DateTime($flight_sel['Flight']['departure_time']); echo $time->format('H:i'); ?></td>
                <td width="90%">
                  <?= $to_city['City']['name']; ?>, <?= $to_city['Country']['name']; ?> - <?= $to_airport[$to_rand_no]['Airport']['airportName'] ?>
                </td>
              </tr>

              <tr>
                <td class="textBold"><span class="nowrap">เดินทางถึง:</span></td>
                <td class="nowrap"><?php $time = new DateTime($flight_sel['Flight']['arrival_time']); echo $time->format('H:i'); ?></td>
                <td>
                  <?= $form_city['City']['name']; ?>, <?= $form_city['Country']['name']; ?> - <?= $form_airport[1]['Airport']['airportName'] ?>   
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
        <tr>
          <td colspan="4" class="space"></td>
        </tr>
        <tr>
          <td width="15%">
            สายการบิน
          </td>
          <td id="segAirline_1_0" width="35%">
            Thai Airways Intl&nbsp;TG715
          </td>
          <td width="50%" colspan="2" rowspan="1" valign="top" style="padding:0px">

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td width="29%">เครื่องบิน</td>
                <td>
                  Airbus Industrie A320-100/200
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>

        <tr id="faretype">
          <td class="textBoldSmallFlight" nowrap="nowrap">ประเภทค่าโดยสาร:</td>
          <td id="segFareType_1_0">
           <?= $class ?>
         </td>
       </tr>
     </tbody></table>
   </td>
 </tr>

</tbody></table>
</div>
</tbody></table>
<? endif; ?>

<h3>ราคา</h3>
<div>
  <table cellspacing="0" cellpadding="0">
   <tbody><tr>
    <td>
      <table border="0" cellspacing="0" cellpadding="0">
        <tbody><tr align="right">
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
            <?php if($data1['Booking']['adult_count'] == 0): ?>
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
    <span id="totalForATravellerType_ADT">
     <?php 
     $result_k = $flight_sel['Flight']['price_kids'] + 200;
     $result_k = $result_k * $data1['Booking']['kids_count'];
     echo $result_k;
     ?>.00 THB
   </span>
 </td>
 <td>&nbsp;</td>
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
<td>&nbsp;</td>
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
    <span class="textColorBold">
      <span id="spanTotalPriceOfAllPax">
        <?php 
        $result = $result_a + $result_k + $result_b;
        echo $result;
        ?>.00 THB
      </span>
    </span>

  </td>
</tr>

</tbody></table>
</tbody></table>

<?= $this->Form->create(); ?>
<h3>การจ่ายเงิน</h3>
<?= $this->Form->input('Payment.total_payment', array('type' => 'hidden', 'value' => $result)); ?>
<?= $this->Form->input('Payment.method', array('type' => 'radio', 'options' => array('C' => 'บัตรเครดิด', 'P' => 'Paypal', 'A' => 'ช่องจ่ายตั๋วสนามบิน'), 'legend' => 'วิธีการจ่ายเงิน', 'default' => 'C')); ?>
<!-- Credit Card -->
<div id="field_credit">
  <div class = "row">
  <?= $this->Form->input('Payment.credit_no', array('label' => 'Credit Card Number','class' => 'four columns') ); ?>
  </div>
  <div class = "row">
    <?= $this->Form->input('Payment.ccv', array('label' => 'CCV', 'class' => 'two columns')); ?>
  </div>
   <div class = "row"> 
  <?= $this->Form->input('Payment.exp_date', array(
    'type' => 'date' ,
    'label' => 'Expire Date', 
    'dateFormat' => 'MY', 
    'minYear' => date('Y'),
    'maxYear' => date('Y') + 15)); ?>
  </div>
  </div>

  <!-- Paypal -->
  <div id="field_paypal" class = "row">
    <?= $this->Form->input('Payment.paypal_email', array('label' => 'Paypal E-mail Address','class' => 'two columns')); ?>
  </div>

  <!-- Airport -->
  <div id="field_airport">
    <p>
      โปรดจ่ายเงินที่ช่องจ่ายตั๋วสนามบิน
    </p>
  </div>

  <input class="button" id="booking_submit" type="submit" value="คกลง" style="
    margin-left: 850px;
">
<?= $this->Form->end(); ?>
<button onclick="location.href='/booking/reset'" class="button" type="submit" style="
    margin-top: -56px;
    margin-left: 750px;
">ยกเลิก</button>

  <script type="text/javascript">
  $(document).ready(function(){
    $("#field_credit").hide();
    $("#field_paypal").hide();
    $("#field_airport").hide();

    if($('#PaymentMethodC').attr('checked') == "checked") {
      $("#field_credit").show();
    } else if ($('#PaymentMethodP').attr('checked') == "checked") {
      $("#field_paypal").show();
    } else if ($('#PaymentMethodA').attr('checked') == "checked") {
      $("#field_airport").show();
    }

    $("#PaymentMethodC").change(function(){
      $("#field_credit").hide();
      $("#field_paypal").hide();
      $("#field_airport").hide();
      if($('#PaymentMethodC').attr('checked') == "checked") {
        $("#field_credit").show();
      } else if ($('#PaymentMethodP').attr('checked') == "checked") {
        $("#field_paypal").show();
      } else if ($('#PaymentMethodA').attr('checked') == "checked") {
        $("#field_airport").show();
      }
    });

    $("#PaymentMethodP").change(function(){
      $("#field_credit").hide();
      $("#field_paypal").hide();
      $("#field_airport").hide();
      if($('#PaymentMethodC').attr('checked') == "checked") {
        $("#field_credit").show();
      } else if ($('#PaymentMethodP').attr('checked') == "checked") {
        $("#field_paypal").show();
      } else if ($('#PaymentMethodA').attr('checked') == "checked") {
        $("#field_airport").show();
      }
    });

    $("#PaymentMethodA").change(function(){
      $("#field_credit").hide();
      $("#field_paypal").hide();
      $("#field_airport").hide();
      if($('#PaymentMethodC').attr('checked') == "checked") {
        $("#field_credit").show();
      } else if ($('#PaymentMethodP').attr('checked') == "checked") {
        $("#field_paypal").show();
      } else if ($('#PaymentMethodA').attr('checked') == "checked") {
        $("#field_airport").show();
      }
    });
  });
</script>