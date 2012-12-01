<h2>โปรกเลือกเวลาและแพ๊คเกจการเดินทาง</h2><br><br>
<?= $this->Form->create(); ?>
<?php if ($results[0]['Flight']['type'] == 'Return' || $results[0]['Flight']['type'] == 'Not'): ?>
<div class="clear">
  <table cellspacing="0">
    <tbody>
      <tr class="row1">
        <td>
          <div>
            <p>
              ขาไป: <?= $form_city['City']['name']; ?> - <?= $to_city['City']['name']; ?>
            </p>
            <p><?= date("D, M j Y",strtotime($results[0]['Flight']['departure_date'])) ?></p>
          </div> 
        </td>

        <th style="background-color:#EAD4E4">
          Economy
        </th>
        <th style="background-color:#DA89BE">
          Business
        </th>
        <th style="background-color:#B62A79">
          First Class
        </th>
      </tr>

      <?php foreach ($results as $result): ?>

      <tr>
        <td>
          <table cellspacing="0">
            <tbody>
              <tr>
                <td>
                 <table cellspacing="0">
                  <tbody><tr>
                    <td>ออกเดินทาง:</td>
                    <td><?= $result['Flight']['departure_time']; ?></td>
                    <td>&nbsp;</td>
                    <td><?= $form_city['City']['name']; ?> (<?= $form_city['City']['city_code']; ?>)
                      <br></td>
                    </tr>
                    <tr>
                      <td>การมาถึง:</td>
                      <td><?= $result['Flight']['arrival_time']; ?></td>
                      <td>&nbsp;</td>
                      <td><?= $to_city['City']['name']; ?> (<?= $to_city['City']['city_code']; ?>)
                        <br></td>
                      </tr>
                    </tbody></table>
                  </td>
                  <td>

                   <ul>
                    <li>
                      <img src="https://wftc3.e-travel.com/logos/logo_TG.gif" alt="">
                      <span class="nameHighlight">Thai Airways Intl(TG710)</span>
                    </li>
                  </ul>

                  <ul>
                    <?php $start_date = new DateTime($result['Flight']['departure_date'].' '.$result['Flight']['departure_time']);
                    $since_start = $start_date->diff(new DateTime($result['Flight']['arrival_date'].' '.$result['Flight']['arrival_time']));?>
                    <li>ใช้เวลาเดินทาง : <?php echo $since_start->h.' ชั่วโมง '.$since_start->i.' นาที'  ?></li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </td>

        <td style="background-color:#EAD4E4" onchange="" onclick="">
          <?php 
              $value = $result['Flight']['id'].'_'.'b'.'_'.$result['Flight']['price_baby'];
          ?>
          <?= $this->Form->input('Flight.selected',array('type' => 'radio', 'label' => false, 'options' => array($value => ''),'default' => false,'div' => false)); ?>
          <span>฿<?= $result['Flight']['price_baby']; ?>.00</span>
        </td>

        <td style="background-color:#E1A6CF" onchange="" onclick="">
          <?php 
              $value = $result['Flight']['id'].'_'.'k'.'_'.$result['Flight']['price_kids'];
          ?>
          <?= $this->Form->input('Flight.selected',array('type' => 'radio', 'label' => false, 'options' => array($value => ''),'default' => false,'div' => false)); ?>
          <span>฿<?= $result['Flight']['price_kids']; ?>.00</span>
        </td>

        <td style="background-color:#DA89BE" onchange="" onclick="">
          <?php 
              $value = $result['Flight']['id'].'_'.'a'.'_'.$result['Flight']['price_adult'];
          ?>
          <?= $this->Form->input('Flight.selected',array('type' => 'radio', 'label' => false, 'options' => array($value => ''),'default' => false,'div' => false)); ?>
          <span>฿<?= $result['Flight']['price_adult']; ?>.00</span>
        </td>

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<? endif; ?>

<?php if ($results[0]['Flight']['type'] == 'Return'): ?>
<div class="clear">
  <table cellspacing="0">
    <tbody><tr class="row1">
      <td>
        <div>
          <p>
            การเดินทางกลับ: <?= $to_city['City']['name']; ?> - <?= $form_city['City']['name']; ?>
          </p>
            <p><?= date("D, M j Y",strtotime($results[0]['Flight']['arrival_date'])) ?></p>
        </div> 
      </td>
      <th style="background-color:#EAD4E4">
        Economy
      </th>
      <th style="background-color:#DA89BE">
        Business
      </th>
      <th style="background-color:#B62A79">
        First Class
      </th>
    </tr>

    <?php foreach ($results as $result): ?>

    <tr>
      <td>
        <table cellspacing="0">
          <tbody>
            <tr>
              <td>
                <table cellspacing="0">
                  <tbody><tr>
                    <td>ออกเดินทาง:</td>
                    <td><?= $result['Flight']['departure_time']; ?></td>
                    <td>&nbsp;</td>
                    <td><?= $to_city['City']['name']; ?> (<?= $to_city['City']['city_code']; ?>)
                      <br></td>
                    </tr>
                    <tr>
                      <td>การมาถึง:</td>
                      <td><?= $result['Flight']['arrival_time']; ?></td>
                      <td>&nbsp;</td>
                      <td><?= $form_city['City']['name']; ?> (<?= $form_city['City']['city_code']; ?>)
                        <br></td>
                      </tr>
                    </tbody></table>
                  </td>
                  <td>
                   <ul>
                    <li>
                      <img src="https://wftc3.e-travel.com/logos/logo_TG.gif" alt="">
                      <span class="nameHighlight">Thai Airways Intl(TG123)</span>
                    </li>
                  </ul>
                  <ul>
                   <?php $start_date = new DateTime($result['Flight']['departure_date'].' '.$result['Flight']['departure_time']);
                    $since_start = $start_date->diff(new DateTime($result['Flight']['arrival_date'].' '.$result['Flight']['arrival_time']));?>
                    <li>ใช้เวลาเดินทาง : <?php echo $since_start->h.' ชั่วโมง '.$since_start->i.' นาที'  ?></li>
                  </ul>
                </td>
              </tr>
            </tbody></table>
          </td>

          <td style="background-color:#EAD4E4">
            <?php 
              $value = $result['Flight']['id'].'_'.'b'.'_'.$result['Flight']['price_baby'];
            ?>
            <?= $this->Form->input('Flight.selected',array('type' => 'radio', 'label' => false, 'options' => array($value => ''),'default' => false,'div' => false)); ?>
            <span>฿<?= $result['Flight']['price_baby']; ?>.00</span>
          </td>

          <td style="background-color:#E1A6CF">
            <?php 
              $value = $result['Flight']['id'].'_'.'k'.'_'.$result['Flight']['price_kids'];
            ?>
            <?= $this->Form->input('Flight.selected',array('type' => 'radio', 'label' => false, 'options' => array($value => ''),'default' => false,'div' => false)); ?>
            <span>฿<?= $result['Flight']['price_kids']; ?>.00</span>
          </td>

          <td style="background-color:#DA89BE">
            <?php 
              $value = $result['Flight']['id'].'_'.'a'.'_'.$result['Flight']['price_adult'];
            ?>
            <?= $this->Form->input('Flight.selected',array('type' => 'radio', 'label' => false, 'options' => array($value => ''),'default' => false,'div' => false)); ?>
            <span>฿<?= $result['Flight']['price_adult']; ?>.00</span>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody></table>
    </div>
<? endif; ?>
    <?= $this->Form->submit('เลือก', array('class' => 'button', 'id' => 'booking_submit')); ?>
    <?= $this->Form->end(); ?>
    <?= $this->Form->button('ยกเลิก', array('onclick' => "location.href='".$this->Html->url(array('action' => 'reset'))."'",'class' => 'button' )); ?>