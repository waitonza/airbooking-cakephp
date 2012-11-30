<?= $this->Form->create(); ?>
<?= $this->Form->input('AdminUser.username', array('div' => false, 'placeholder' => 'บัญชีผู้ใช้')); ?>
<?= $this->Form->input('AdminUser.password', array('div' => false, 'placeholder' => 'รหัสผ่าน')); ?>
<?= $this->Form->submit('ลงชื่อเข้าใช้');  ?>
<?= $this->Form->end(); ?>
<?= $this->Html->link('ลงทะเบียน', array('action' => 'regis'));  ?>