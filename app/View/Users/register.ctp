<?php
echo $this->Form->create('User',array('action'=>'register'));
echo $this->Form->input('username');
echo $this->Form->input('email');
echo $this->Form->input('sex');
echo $this->Form->input('dob');
echo $this->Form->input('password');
echo $this->Form->input('active');
echo $this->Form->end('Register');
?>
