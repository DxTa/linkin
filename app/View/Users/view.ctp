<div class='page-wrap ViewUser'>
  <div class='page-content clearfix'>
    <div class='left-content' style="padding-top: 15px;">
      <?php echo $this->element('User/profile-header', array('user' => $user, 'current_user' => $current_user))?>
      <div class="feed-container">
        <div class="lh-title">
          <h2>News Feed</h2>
        </div>
        <ul class="news-list">
          <?php foreach ($feeds as $feed): ?>
            <?php echo $this->element('link/link-item', array('link' => $feed, 'current_user' => $current_user)); ?>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
    <div class='right-content'>
      <div id="friends-list">
        <div class="head-list clearfix">
        <a href="/users/view_friends/<?php echo $user['User']['id'] ?>"><h2>Friends List</h2></a>
        </div>
        <div class="friends-list-wrapper">
          <?php $friends = $user['followingFriends'] + $user['followedFriends'];
            $friends = array_slice($friends,0,8);
          ?>
          <?php foreach($friends as $friend): ?>
            <a href='/users/view/<?php echo $friend['id'] ?>' class='link-user'>
              <img src='<?php echo $friend['avatar'] ?>' ><br/>
              <?php echo $friend['username'] ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
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
  var viewCreate = function(link_id,user_id) {
    data = {
      UserLinkView: {
        'link_id': link_id,
          'user_id' : user_id
      }
    };
    $.ajax({
      url:'/UserLinkViews/make',
        type:'post',
        data: {data: data},
        dataType : "json",
        success: function(response, status) {
          console.log(link_id);
          $("#link_views_"+ link_id).html(parseInt($("#link_views_" + link_id).html()) +1);
        }
    });
  };

  var likeCreate = function(link_id,user_id) {
    data = {
      UserLinkLike: {
        'link_id': link_id,
          'user_id' : user_id
      }
    };
    $.ajax({
      url:'/UserLinkLikes/make',
        type:'post',
        data: {data: data},
        dataType : "json",
        success: function(response, status) {
          console.log(link_id);
          $("#link_likes_"+ link_id).html(parseInt($("#link_likes_" + link_id).html()) +1);
        }
    });
  }
  </script>
