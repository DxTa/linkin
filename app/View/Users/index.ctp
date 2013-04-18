<table>
 <?php foreach ($users as $user): ?>
  <tr>
    <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['sex']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['dob']); ?>&nbsp;</td>
    <td>
      <?php echo $this->Html->link($user['Image']['url'], array('controller' => 'images', 'action' => 'view', $user['Image']['id'])); ?>
    </td>
    <td><?php echo h($user['User']['active']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['admin']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['created_at']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['updated_at']); ?>&nbsp;</td>
    <td class="actions">
      <?php if ($current_user["id"] != $user['User']['id']) {
        $friend = $this->App->search($user['followingFriends'],array('id' => $current_user["id"]));
        if (!$friend) $friend = $this->App->search($user['followedFriends'],array('id' => $current_user["id"]));
        if (!$friend) {
          echo $this->Form->create('Friendship', array('url'=>array('controller'=>'friendships', 'action'=>'add')));
          echo $this->Form->hidden('user_id', array('value' => $current_user["id"]));
          echo $this->Form->hidden('friend_id', array('value' => $user['User']['id']));
          echo $this->Form->submit('Add Friend', array('class' => 'btn'));
        } else {
          echo $this->Form->create('Friendship', array('url'=>array('controller'=>'friendships', 'action'=>'edit', $friend[0]["Friendship"]["id"])));
          if ($friend[0]["Friendship"]["state"] == 'approved') {
            echo $this->Form->hidden('event', array('value' => 'destroy'));
            echo $this->Form->submit('Unfriend', array('class' => 'btn'));
          }
          else {
            if ($friend[0]["Friendship"]["friend_id"] == $current_user["id"]) {
              echo $this->Form->hidden('event', array('value' => 'approve'));
              echo $this->Form->submit('Approve', array('class' => 'btn'));
            } else {
              echo $this->Form->submit('Pending', array('class' => 'btn disabled', 'disabled' => 'disabled'));
            }
          }
        }
      }?>

      <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
      <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
      <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>
