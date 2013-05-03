
<div class='links-manage'>
<h1> User Manager </h1>
<table border='1'>
<tr>
  <th>ID</th>
  <th>Email</th>
  <th>Username</th>
  <th>Sex</th>
  <th>DoB</th>
  <th>Avatar</th>
  <th>Friend</th>
  <th>View</th>
  <?php if($current_user['User']['admin'] == 1)  : ?>
  <th>Delete</th>
  <?php endif ?>
</tr>
 <?php foreach ($users as $user): ?>
  <tr>
    <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['sex']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['dob']); ?>&nbsp;</td>
    <td>
      <img src="<?php echo $current_user['User']['avatar']?>" />
    </td>
    <td class="actions">
      <?php if ($current_user["User"]["id"] != $user['User']['id']) {
        $friend = $this->App->search($user['followingFriends'],array('id' => $current_user["User"]["id"]));
        if (!$friend) $friend = $this->App->search($user['followedFriends'],array('id' => $current_user["User"]["id"]));
        if (!$friend) {
          echo $this->Form->create('Friendship', array('url'=>array('controller'=>'friendships', 'action'=>'add')));
          echo $this->Form->hidden('user_id', array('value' => $current_user["User"]["id"]));
          echo $this->Form->hidden('friend_id', array('value' => $user['User']['id']));
          echo $this->Form->submit('Add Friend', array('class' => 'btn'));
        } else {
          echo $this->Form->create('Friendship', array('url'=>array('controller'=>'friendships', 'action'=>'edit', $friend[0]["Friendship"]["id"])));
          if ($friend[0]["Friendship"]["state"] == 'approved') {
            echo $this->Form->hidden('event', array('value' => 'destroy'));
            echo $this->Form->submit('Unfriend', array('class' => 'btn'));
          }
          else {
            if ($friend[0]["Friendship"]["friend_id"] == $current_user["User"]["id"]) {
              echo $this->Form->hidden('event', array('value' => 'approve'));
              echo $this->Form->submit('Approve', array('class' => 'btn'));
            } else {
              echo $this->Form->submit('Pending', array('class' => 'btn disabled', 'disabled' => 'disabled'));
            }
          }
        }
      }?>

    </td>
    <td>    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?></td>
    <?php if($current_user['User']['admin'] == 1)  : ?>
    <td><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?></td>
    <?php endif ?>
  </tr>
<?php endforeach; ?>
</table>
</div>
