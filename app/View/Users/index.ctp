 <?php foreach ($users as $user): ?>
  <tr>
    <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['sex']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['dob']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['password']); ?>&nbsp;</td>
    <td>
      <?php echo $this->Html->link($user['Image']['url'], array('controller' => 'images', 'action' => 'view', $user['Image']['id'])); ?>
    </td>
    <td><?php echo h($user['User']['remember_token']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['active']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['admin']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['created_at']); ?>&nbsp;</td>
    <td><?php echo h($user['User']['updated_at']); ?>&nbsp;</td>
    <td class="actions">
      <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
      <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
      <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
    </td>
  </tr>
<?php endforeach; ?>
