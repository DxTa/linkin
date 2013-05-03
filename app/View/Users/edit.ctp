<div class='page-wrap' style='width: 600px'>
  <div class='user-edit-form'>

  <?php echo $this->Form->create('User',array('type'=>'file')); ?>
    <fieldset>
      <legend><?php echo __('Edit User'); ?></legend>
      <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username',array('type' => 'text'));
        echo $this->Form->input('email');
        echo $this->Form->input('sex',array('options' => $defaultSex));
        echo $this->Form->input('dob',array('type' => 'date'));
        echo $this->Form->input('password');
      ?>
      <div class='avatar-holder'>
        <div class='avatar-frame'>
          <?php if($current_user['User']['avatar'])  : ?>
          <img src='<?php echo $current_user['User']['avatar'] ?>'>
          <?php else : ?>
          <img src='/app/webroot/img/default_avatar.png'>
          <?php endif ?>
        </div>
        <div class='avatar-btn'>
          <label>Upload</label>
        </div>
      <?php
      echo $this->Form->input('avatar', array('label' => 'Avatar','type'=>'file','onchange'=>'readURL(this)'));
      ?>
      </div>
    </fieldset>
  <?php echo $this->Form->submit(__('Submit'),array('class' => 'btn')); ?>
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
</script>
