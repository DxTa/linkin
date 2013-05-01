<div class='login-form-holder'>

  <div class='title-bar login-icon'>
    Register With
    <b> LinkID</b>
  </div>
  <div class='login-form'>
    <div class='register-bar step1'>
      <div class='step logo'>
        Register <b> LinkID </b>
      </div>
      <div class='step'>
      Finish
      </div>
    </div>
    <div class='register-form'>
      <?php
      $defaultSex = array('Undefined' => 'Undefined', 'Male' => 'Male', 'Female' => 'Female', 'Gay' => 'Gay' ,'Lesbian' => 'Lesbian');

      echo $this->Form->create('User',array('action'=>'register','type'=> 'file'));
      echo $this->Form->input('username',array('type' => 'text'));
      echo $this->Form->input('email');
      echo $this->Form->input('avatar', array('label' => 'Avatar','type'=>'file'));
      echo $this->Form->input('sex',array('options' => $defaultSex));
      echo $this->Form->input('dob',array('type' => 'date'));
      echo $this->Form->input('password');
      echo $this->Form->submit('Register',array('class' => 'btn'));
      ?>
    </div>
  </div>

  <div class='register-now'>
    <b>
      Already have a <a href='#'> LinkID? </a>
    </b>
    <a href='/users/register'>
      <div class='btn register-btn'>Login</div>
    </a>
   <b> or  Register With </b>
    <div class='register-fb'>
      <?php echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'redirect' => true, 'label' => 'Connect with facebook')); ?>
    </div>

  </div>
</div>

