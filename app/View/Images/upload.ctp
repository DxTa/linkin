<?php
   echo $this->Form->create('Image', array('type' => 'file'));
   echo $this->Form->input('Image.url', array('type' => 'file'));
   echo $this->Form->end('Upload');
?>
