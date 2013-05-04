<div class="profile-header">
  <div class="avatar media-border">
      <img src='<?php echo $user['User']['avatar'] ?>' class="size80" >
  </div>
  <div class="profile-detail">
    <div class="profile-action">
      <h2>
        <a href='/users/view/<?php echo $user['User']['id'] ?>'>
            <?php echo $user['User']['username'] ?>
        </a>
      </h2>
      <div>
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
      </div>
    </div>
    <div class="blast-update">
      <?php if (isset($user['Link'][0])):?>
      <span class="blast-content">
        <?php echo $user['Link'][0]['description']?><br/>
        <a href="<?php echo $user['Link'][0]['url']?>" target="_blank"><?php echo $user['Link'][0]['url'] ?></a> -
      </span>
      <span class="timeago">
          <?php echo $this->Time->timeAgoInWords($user['Link'][0]['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?>
      </span>
      <?php endif; ?>
    </div>
  </div>
  <div class="statistic">
      <div>
        <span><?php echo count($user['followingFriends']) + count($user['followedFriends']) ?></span>
        Friends
      </div>
      <div>
        <span><?php echo count($user['Comment']) + count($user['Recomment']) ?></span>
        Comments
      </div>
      <div>
      <span><?php echo count($user['Link']) ?></span>
        Links
      </div>
  </div>
</div>
