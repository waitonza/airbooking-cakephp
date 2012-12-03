<?= $this->Form->create(); ?>
<div class = "row">
<?= $this->Form->input('AdminUser.username', array('div' => false, 'placeholder' => 'บัญชีผู้ใช้','class' => 'four columns')); ?>
</div>
<div class = "row">
<?= $this->Form->input('AdminUser.password', array('div' => false, 'placeholder' => 'รหัสผ่าน', 'class' => 'four columns')); ?>
</div>
<div class = "row">
<?= $this->Form->submit('ลงชื่อเข้าใช้');  ?>
</div>
<?= $this->Form->end(); ?>
<div class = "row">
<?= $this->Html->link('ลงทะเบียน', array('action' => 'regis'));  ?>
</div>