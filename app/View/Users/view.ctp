<div class='page-wrap ViewUser'>
  <div class='page-content clearfix'>
    <div class='left-content' style="padding-top: 15px;">
      <div class="profile-header">
        <div class="avatar media-border">
            <img src='<?php echo $user['User']['avatar'] ?>' class="size80" >
        </div>
        <div class="profile-detail">
          <div class="profile-action">
            <h2>
              <a href='/users/<?php echo $user['User']['id'] ?>'>
                  <?php echo $user['User']['username'] ?>
              </a>
            </h2>
            <div>
              <span class="fr-button">
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

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class='right-content'>

    </div>
  </div>
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
          $('.profile-detail .profile-action .fr-button').html(response.data);
        }
    });
  }
  </script>
