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
      ?>
      <div class='avatar-holder'>
        <div class='avatar-frame'>
          <img src='/app/webroot/img/default_avatar.png'>
        </div>
        <div class='avatar-btn'>
          <label>Upload</label>
        </div>
      <?php
      echo $this->Form->input('avatar', array('label' => 'Avatar','type'=>'file','onchange'=>'readURL(this)'));
      ?>
      </div>
      <?php
      echo $this->Form->input('sex',array('options' => $defaultSex));
      echo $this->Form->input('dob',array('type' => 'date'));
      echo $this->Form->input('password');
      echo $this->Form->submit('Register',array('class' => 'btn','onclick'=>'nextStep()'));
      ?>
    </div>
  </div>

  <div class='register-now'>
    <b>
      Already have a <a href='#'> LinkID? </a>
    </b>
    <a href='/users/login'>
      <div class='btn register-btn'>Login</div>
    </a>
   <b> or  Register With </b>
    <div class='register-fb'>
      <?php echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'redirect' => array('controller' => 'users', 'action' => 'syncFacebook'), 'label' => 'Connect with facebook')); ?>
    </div>

  </div>
</div>

<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        if ($('.avatar-frame')) {
          $('.avatar-frame img').attr('src',e.target.result);
        }
      };

      reader.readAsDataURL(input.files[0]);
    }
  };
  function nextStep() {
    $(".register-bar").removeClass('step1').addClass('step2');
    $(".register-form").html("<div class='register-finish'><b>This account is saved. Please go to your <a>mail</a> to verify the registration</b></div>");
  }

</script>
