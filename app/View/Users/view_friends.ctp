<div class='page-wrap ViewFriends'>
  <div class='page-content clearfix'>
    <div class='left-content' style="padding-top: 15px;">
      <?php echo $this->element('User/profile-header', array('user' => $user, 'current_user' => $current_user))?>
      <div class="feed-container">
        <div class="lh-title" style="color: grey;">
          <h2 style="display: inline-block;">Friends List</h2>
          <?php echo "(".count($friends)." friends)" ?>
        </div>
        <ul class="friends-list">
          <?php foreach ($friends as $friend):?>
            <li class="friends-list-item">
              <strong class="username">
                <a href="/users/view/<?php echo $friend['id'] ?>">
                  <img src="<?php echo $friend['avatar']?>" class="user-avatar" />
                </a>
              </strong>
              <h3>
                <a href="/users/view/<?php echo $friend['id'] ?>">
                  <?php echo $friend['username'] ?>
                </a>
              </h3>
              <span class="fr-button user-<?php echo $current_user['User']['id'] ?>-friend-<?php echo $friend['id'] ?>">
                <?php if ($current_user["User"]["id"] != $friend['id']) {
                  if (isset($friend['followingFriends'])) {
                    $fr = $this->App->search($friend['followingFriends'],array('id' => $current_user["User"]["id"]),1);
                  }
                  if (isset($friend['followedFriends'])) {
                    if (!isset($fr) || !$fr) $fr = $this->App->search($friend['followedFriends'],array('id' => $current_user["User"]["id"]),1);
                  }
                  if (!$fr || !isset($fr[0]["Friendship"])) {
                    echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$friend['id'].'" action="add" onclick="friendRequest(this)">Add Friend</button>';
                  } else {
                    if ($fr[0]["Friendship"]["state"] == 'approved') {
                      echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$friend['id'].'" event="destroy" action="edit/'.$fr[0]["Friendship"]["id"].'" onclick="friendRequest(this)">Unfriend</button>';
                    }
                    else {
                      if ($fr[0]["Friendship"]["friend_id"] == $current_user["User"]["id"]) {
                        echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$friend['id'].'" event="approve" action="edit/'.$fr[0]["Friendship"]["id"].'" onclick="friendRequest(this)">Approve</button>';
                      } else {
                        echo '<button class="friendship-act" user="'.$current_user["User"]["id"].'"friend="'.$friend['id'].'" event="pending" onclick="friendRequest(this)">Pending</button>';
                      }
                    }
                  }
                }?>
              </span>
              <div class="date-join">
                Join on <span class"time"><?php echo isset($friend['created_at']) == true ? $friend['created_at'] : "undefined"?></span>
              </div>
            </li>
          <?php endforeach ?>
        </ul>
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
                          $('.fr-button.user-' + $(ele).attr('user') + '-friend-' + $(ele).attr('friend')).html(response.data);
                        }
                    });
                  }
  </script>
