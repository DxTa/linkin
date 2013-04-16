<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
    <?php
      echo $this->Form->input('id');
      echo $this->Form->input('username',array('type' => 'text'));
      echo $this->Form->input('email');
      echo $this->Form->input('sex',array('options' => $defaultSex));
      echo $this->Form->input('dob',array('type' => 'date'));
      echo $this->Form->input('password');
      echo $this->Form->input('avatar', array('label' => 'Avatar', 'type' => 'file'));
    ?>
  </fieldset>
<?php echo $this->Form->submit(__('Submit'),array('class' => 'btn')); ?>
</div>
