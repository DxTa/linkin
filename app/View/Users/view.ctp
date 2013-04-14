<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sex'); ?></dt>
		<dd>
			<?php echo h($user['User']['sex']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dob'); ?></dt>
		<dd>
			<?php echo h($user['User']['dob']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pwd'); ?></dt>
		<dd>
			<?php echo h($user['User']['pwd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Image']['url'], array('controller' => 'images', 'action' => 'view', $user['Image']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remember Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['remember_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin'); ?></dt>
		<dd>
			<?php echo h($user['User']['admin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($user['User']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($user['User']['updated_at']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Authentications'); ?></h3>
	<?php if (!empty($user['Authentication'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Provider'); ?></th>
		<th><?php echo __('Uid'); ?></th>
		<th><?php echo __('Access Token'); ?></th>
		<th><?php echo __('Secret'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Authentication'] as $authentication): ?>
		<tr>
			<td><?php echo $authentication['id']; ?></td>
			<td><?php echo $authentication['user_id']; ?></td>
			<td><?php echo $authentication['provider']; ?></td>
			<td><?php echo $authentication['uid']; ?></td>
			<td><?php echo $authentication['access_token']; ?></td>
			<td><?php echo $authentication['secret']; ?></td>
			<td><?php echo $authentication['created_at']; ?></td>
			<td><?php echo $authentication['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'authentications', 'action' => 'view', $authentication['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'authentications', 'action' => 'edit', $authentication['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'authentications', 'action' => 'delete', $authentication['id']), null, __('Are you sure you want to delete # %s?', $authentication['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Authentication'), array('controller' => 'authentications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($user['Comment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['id']; ?></td>
			<td><?php echo $comment['user_id']; ?></td>
			<td><?php echo $comment['title']; ?></td>
			<td><?php echo $comment['description']; ?></td>
			<td><?php echo $comment['created_at']; ?></td>
			<td><?php echo $comment['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Likes'); ?></h3>
	<?php if (!empty($user['Like'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Link Id'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Like'] as $like): ?>
		<tr>
			<td><?php echo $like['id']; ?></td>
			<td><?php echo $like['user_id']; ?></td>
			<td><?php echo $like['link_id']; ?></td>
			<td><?php echo $like['created_at']; ?></td>
			<td><?php echo $like['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'likes', 'action' => 'view', $like['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'likes', 'action' => 'edit', $like['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'likes', 'action' => 'delete', $like['id']), null, __('Are you sure you want to delete # %s?', $like['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Like'), array('controller' => 'likes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Views'); ?></h3>
	<?php if (!empty($user['View'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Link Id'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['View'] as $view): ?>
		<tr>
			<td><?php echo $view['id']; ?></td>
			<td><?php echo $view['user_id']; ?></td>
			<td><?php echo $view['link_id']; ?></td>
			<td><?php echo $view['created_at']; ?></td>
			<td><?php echo $view['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'views', 'action' => 'view', $view['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'views', 'action' => 'edit', $view['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'views', 'action' => 'delete', $view['id']), null, __('Are you sure you want to delete # %s?', $view['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New View'), array('controller' => 'views', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($user['followingFriends'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Dob'); ?></th>
		<th><?php echo __('Pwd'); ?></th>
		<th><?php echo __('Avatar'); ?></th>
		<th><?php echo __('Remember Token'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Admin'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['followingFriends'] as $followingFriends): ?>
		<tr>
			<td><?php echo $followingFriends['id']; ?></td>
			<td><?php echo $followingFriends['email']; ?></td>
			<td><?php echo $followingFriends['username']; ?></td>
			<td><?php echo $followingFriends['sex']; ?></td>
			<td><?php echo $followingFriends['dob']; ?></td>
			<td><?php echo $followingFriends['pwd']; ?></td>
			<td><?php echo $followingFriends['avatar']; ?></td>
			<td><?php echo $followingFriends['remember_token']; ?></td>
			<td><?php echo $followingFriends['active']; ?></td>
			<td><?php echo $followingFriends['admin']; ?></td>
			<td><?php echo $followingFriends['created_at']; ?></td>
			<td><?php echo $followingFriends['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $followingFriends['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $followingFriends['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $followingFriends['id']), null, __('Are you sure you want to delete # %s?', $followingFriends['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Following Friends'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($user['followedFriends'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Dob'); ?></th>
		<th><?php echo __('Pwd'); ?></th>
		<th><?php echo __('Avatar'); ?></th>
		<th><?php echo __('Remember Token'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Admin'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['followedFriends'] as $followedFriends): ?>
		<tr>
			<td><?php echo $followedFriends['id']; ?></td>
			<td><?php echo $followedFriends['email']; ?></td>
			<td><?php echo $followedFriends['username']; ?></td>
			<td><?php echo $followedFriends['sex']; ?></td>
			<td><?php echo $followedFriends['dob']; ?></td>
			<td><?php echo $followedFriends['pwd']; ?></td>
			<td><?php echo $followedFriends['avatar']; ?></td>
			<td><?php echo $followedFriends['remember_token']; ?></td>
			<td><?php echo $followedFriends['active']; ?></td>
			<td><?php echo $followedFriends['admin']; ?></td>
			<td><?php echo $followedFriends['created_at']; ?></td>
			<td><?php echo $followedFriends['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $followedFriends['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $followedFriends['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $followedFriends['id']), null, __('Are you sure you want to delete # %s?', $followedFriends['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Followed Friends'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
