<div class='login-form-holder'>
  <div class='title-bar login-icon'>
    Login With
    <b> LinkID</b>
  </div>
  <div class='login-form'>
<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User',array('action'=>'login'));
    echo $this->Form->input('username',array('type' => 'text'));
    echo $this->Form->input('password');
    echo $this->Form->submit('Login',array('class' => 'btn'));
?>
  </div>
  <div class='register-now'>
    <b>
      Not have <a href='#'> LinkID? </a>
    </b>
    <a href='/users/register'>
      <div class='btn register-btn'>Register</div>
    </a>
   <b> or  Register With </b>
    <div class='register-fb'>
      <?php echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'redirect' => array('controller' => 'users', 'action' => 'syncFacebook'), 'label' => 'Connect with facebook')); ?>
    </div>

  </div>


</div>
