<div class='top-banner'>
  <div class='adv1'>

  </div>
</div>
<div class='page-wrap'>
  <div class='page-content border-center clearfix'>
    <div class='left-content'>
      <div class='list-links'>
        <div class='news-filter'>
          <h2>
            <a href='#'>
              <img src='/app/webroot/img/rss.png'/>
            </a>
            <a href='#' class='a-active'>
              Hot Links
            </a>
            |
            <a href='#'>
              News
            </a>
          </h2>
        </div>
        <ul class='news-list'>
          <?php foreach ($links as $link): ?>
            <li id='link_<?php echo $link['Link']['id'] ?>'>
              <div class='link-item clearfix'>
                <div class='link-thumb right-set'>
                  <a href="/links/view/<?php echo  $link['Link']['id']?>" ><img src="<?php echo $link['Link']['image'] ?>" ></a>
                </div>
                <div class='link-like'>
                  <a href="/links/view/<?php echo  $link['Link']['id']?>" class='like-count'>
                      <span id="link_likes_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_likes'] ?></span>
                  </a>
                  <a href='#' class='vote' onclick="likeCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"  >
                    <i></i>
                    Like
                  </a>
                </div>
                <div class='link-content'>
                  <h2>
                    <a href="<?php echo $link['Link']['url'] ?>"  target="_blank" id="<?php echo $link['Link']['id'] ?>" onclick="viewCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"><?php echo $link['Link']['description'] ?></a>
                  </h2>
                  <div class='link-meta'>
                    <span class='user-info'>
                      <strong>
                        <a href='/users/<?php echo $link['Owner']['id'] ?>' class='link-owner'>
                        <img src='<?php echo $link['Owner']['avatar'] ?>' >
                          <?php echo $link['Owner']['username'] ?>
                        </a>
                      </strong>
                      send
                    </span>
                    <span class='seperator'>-</span>
                    <span class='channel'>
                      <a href='#'>Education</a>
                    </span>
                    <span class='seperator'>-</span>
                    <span class='domain'>
                      <a href='#'>kenh14.vn</a>
                    </span>
                  </div>
                  <div class='link-stats'>
                    <a class='timeago'>
                      1 hours ago
                    </a>
                      ·
                    <a class='view-count'>
                      <span id="link_views_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_views'] ?></span>
                      Views
                    </a>
                      ·
                    <a class='comment-count' href="/links/view/<?php echo  $link['Link']['id']?>">
                      <?php echo $link['Link']['cnt_comments'] ?> Comments
                    </a>
                      ·
                    <?php echo $this->Facebook->share(Router::url(array('controller' => 'links', 'action' => 'view', $link['Link']['id'])),array('style' => 'link','label' => 'Facebook this link')); ?>
                  </div>
                </div>
              </div>

            </li>
          <?php endforeach; ?>
        </ul>

      </div>

    </div>

    <div class='right-content'>
      <div class='search-box'>
<input type='text' />
<span class='search-btn'></span>

      </div>

    </div>

  </div>
</div>






  <script type="text/javascript">
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
