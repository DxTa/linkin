
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
      <span class="fr-button user-<?php echo $current_user['User']['id'] ?>-friend-<?php echo $user['User']['id'] ?>">
        <?php if ($current_user["User"]["id"] != $user['User']['id']) {
          $friend = $this->App->search($user['followingFriends'],array('id' => $current_user["User"]["id"]));
          if (!$friend) $friend = $this->App->search($user['followedFriends'],array('id' => $current_user["User"]["id"]));
          if (!$friend) {
            echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$user['User']['id'].'" action="add" onclick="friendRequest(this)">Add Friend</button>';
          } else {
            if ($friend[0]["Friendship"]["state"] == 'approved') {
              echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$user['User']['id'].'" event="destroy" action="edit/'.$friend[0]["Friendship"]["id"].'" onclick="friendRequest(this)">Unfriend</button>';
            }
            else {
              if ($friend[0]["Friendship"]["friend_id"] == $current_user["User"]["id"]) {
                echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$user['User']['id'].'" event="approve" action="edit/'.$friend[0]["Friendship"]["id"].'" onclick="friendRequest(this)">Approve</button>';
              } else {
                echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$user['User']['id'].'" event="pending" onclick="friendRequest(this)">Pending</button>';
              }
            }
          }
        }?>
      </span>

    </td>
    <td>    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?></td>
    <?php if($current_user['User']['admin'] == 1)  : ?>
    <td><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?></td>
    <?php endif ?>
  </tr>
<?php endforeach; ?>
</table>
</div>

<script type="text/javascript">
  var friendRequest = function(ele) {
    s_event = $(ele).attr('event');
    if (s_event == 'pending') return;
    action = $(ele).attr('action');
    data = {
      Friendship: {
        'user_id': $(ele).attr('user'),
        'friend_id' : $(ele).attr('friend')
      }
    };
    if (action.match(/edit/g) != null) {
      data.Friendship['event'] = s_event;
    }
    $.ajax({
      url:'/friendships/' + action,
        type:'post',
        data: {data: data},
        dataType : "json",
        success: function(response, status) {
          console.log(response);
          $('.fr-button.user-' + $(ele).attr('user') + '-friend-' + $(ele).attr('friend')).html(response.data);
        }
    });
  }
  </script>
