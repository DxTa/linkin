<?php
echo $this->Form->create('Image', array('type' => 'file'));
echo $this->Form->input('Image.file', array('label' => 'Remote URL'));
echo $this->Form->end('Upload');
?>
