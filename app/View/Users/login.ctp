<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User');
    echo $this->Form->input('username',array('type' => 'text'));
    echo $this->Form->input('password');
    echo $this->Form->submit('Login',array('class' => 'btn'));
?>
<br/>

<?php echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'redirect' => true, 'label' => 'Connect with facebook')); ?>
