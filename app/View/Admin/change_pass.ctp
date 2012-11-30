<?php
echo $this->Form->create();
echo $this->Form->inputs(array(
	'legend' => 'เปลี่ยนรหัสผ่านผู้ดูแลระบบ',
	'AdminUser.oldpassword' => array('type' => 'password', 'autocomplete' => 'off'),
	'AdminUser.password' => array('type' => 'password', 'autocomplete' => 'off'),
	'AdminUser.repassword' => array('type' => 'password', 'autocomplete' => 'off', 'required' => true),
	'AdminUser.id' => array('type' => 'hidden', 'required' => true)
	));
echo $this->Form->submit('เปลี่ยนรหัสผ่าน');
echo $this->Form->end();
?>