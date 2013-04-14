<?php
echo $this->Form->create('User',array('action'=>'register','type'=> 'file'));
echo $this->Form->input('username',array('type' => 'text'));
echo $this->Form->input('email');
echo $this->Form->input('avatar', array('label' => 'Avatar', 'type' => 'file'));
echo $this->Form->input('sex', array('type' => 'text'));
echo $this->Form->input('dob',array('type' => 'date'));
echo $this->Form->input('password');
echo $this->Form->submit('Register',array('class' => 'btn'));
?>
