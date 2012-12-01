<?php
echo $this->Form->create();
echo $this->Form->inputs(array(
	'legend' => 'ลงทะเบียน - ผู้ดูแลระบบ',
	'AdminUser.username' => array('autocomplete' => 'off'),
	'AdminUser.password' => array('type' => 'password', 'autocomplete' => 'off'),
	'AdminUser.repassword' => array('type' => 'password', 'autocomplete' => 'off', 'required' => true),
	));
echo $this->Form->submit('ลงทะเบียน');
echo $this->Form->end();
echo $this->Form->button('ยกเลิก', array('onclick' => "location.href='".$this->Html->url(array('action' => 'login'))."'" )); ?>
?>