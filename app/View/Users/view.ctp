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
            <li id='link_<?php echo $feed['Link']['id'] ?>'>
              <div class='link-item clearfix'>
                <div class='link-thumb right-set'>
                  <a href="/links/view/<?php echo  $feed['Link']['id']?>" ><img src="<?php echo $feed['Link']['image'] ?>" ></a>
                </div>
                <div class='link-like'>
                  <a href="/links/view/<?php echo  $feed['Link']['id']?>" class='like-count'>
                      <span id="link_likes_<?php echo $feed['Link']['id'] ?>"><?php echo $feed['Link']['cnt_likes'] ?></span>
                  </a>
                  <?php if($current_user) : ?>
                  <a href='#' class='vote' onclick="likeCreate(<?php echo $feed['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"  >
                  <?php else : ?>
                  <a href='#' class='vote' >
                  <?php endif ?>
                    <i></i>
                    Like
                  </a>
                </div>
                <div class='link-content'>
                  <h2>
                    <?php if($current_user) : ?>
                    <a href="<?php echo $feed['Link']['url'] ?>"  target="_blank" id="<?php echo $feed['Link']['id'] ?>" onclick="viewCreate(<?php echo $feed['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"><?php echo $feed['Link']['description'] ?></a>
                    <?php else : ?>
                    <a href="<?php echo $feed['Link']['url'] ?>"  target="_blank" id="<?php echo $feed['Link']['id'] ?>" ><?php echo $feed['Link']['description'] ?></a>
                    <?php endif ?>
                  </h2>
                  <div class='link-meta'>
                    <span class='user-info'>
                      <strong>
                        <a href='/users/view/<?php echo $feed['Owner']['id'] ?>' class='link-owner'>
                        <img src='<?php echo $feed['Owner']['avatar'] ?>' >
                          <?php echo $feed['Owner']['username'] ?>
                        </a>
                      </strong>
                      send
                    </span>
                    <span class='seperator'>-</span>
                    <span class='channel'>
                      <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'view', $feed['Category']['id'])) ?>"><?php echo $feed['Category']['name'] ?></a>
                    </span>
                    <span class='seperator'>-</span>
                    <span class='domain'>
                      <a href="<?php echo $feed['Link']['url'] ?>" target="_blank"><?php echo $this->App->getDomainFromUrl($feed['Link']['url']) ?></a>
                    </span>
                  </div>
                  <div class='link-stats'>
                    <a class='timeago'>
                      <?php echo $this->Time->timeAgoInWords($feed['Link']['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?>
                    </a>
                      ·
                    <a class='view-count'>
                      <span id="link_views_<?php echo $feed['Link']['id'] ?>"><?php echo $feed['Link']['cnt_views'] ?></span>
                      Views
                    </a>
                      ·
                    <a class='comment-count' href="/links/view/<?php echo  $feed['Link']['id']?>">
                      <?php echo $feed['Link']['cnt_comments'] ?> Comments
                    </a>
                      ·
                    <?php echo $this->Facebook->share(Router::url(array('controller' => 'links', 'action' => 'view', $feed['Link']['id'])),array('style' => 'link','label' => 'Facebook this link')); ?>
                  </div>
                </div>
              </div>

            </li>
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
  </script>
