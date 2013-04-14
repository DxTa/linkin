<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('sex');
		echo $this->Form->input('dob');
		echo $this->Form->input('pwd');
		echo $this->Form->input('avatar');
		echo $this->Form->input('remember_token');
		echo $this->Form->input('active');
		echo $this->Form->input('admin');
		echo $this->Form->input('created_at');
		echo $this->Form->input('updated_at');
		echo $this->Form->input('followingFriends');
		echo $this->Form->input('followedFriends');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Authentications'), array('controller' => 'authentications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Authentication'), array('controller' => 'authentications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Likes'), array('controller' => 'likes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Like'), array('controller' => 'likes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Views'), array('controller' => 'views', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New View'), array('controller' => 'views', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Following Friends'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
