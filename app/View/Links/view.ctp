<div class='top-banner'>
  <div class='adv1'>

  </div>
</div>
<div class='page-wrap ViewLink'>
  <div class='page-content border-center clearfix'>
    <div class='left-content'>
      <div class='link-like'>
        <a href="/links/view/<?php echo  $link['Link']['id']?>" class='like-count'>
            <span id="link_likes_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_likes'] ?></span>
        </a>
        <a href='#' class='vote' onclick="likeCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"  >
          <i></i>
          Like
        </a>
      </div>
      <div class="thumb">
        <a href="<?php echo $link['Link']['url']?>">
            <img src="<?php echo $link['Link']['image'] ?>"/>
        </a>
      </div>
      <div class="link-content">
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
            <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'view', $link['Category']['id'])) ?>"><?php echo $link['Category']['name'] ?></a>
          </span>
          <span class='seperator'>-</span>
          <span class='domain'>
          <a href="<?php echo $link['Link']['url'] ?>" target="_blank"><?php echo $this->App->getDomainFromUrl($link['Link']['url']) ?></a>
          </span>
        </div>
        <div class='link-stats'>
          <a class='timeago'>
            <?php echo $this->Time->timeAgoInWords($link['Link']['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?>
          </a>
            ·
          <a class='view-count'>
            <span id="link_views_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_views'] ?></span>
            Views
          </a>
            ·
          <?php echo $this->Facebook->share(null,array('style' => 'link','label' => 'Facebook this link')); ?>
        </div>
        <?php echo $this->Facebook->like(); ?>
      </div>



      <div class="linkView-comments">
        <div class="comments-wrapper">
          <h2 class="lineCenterTitle">
            <span class="line"></span>
            <span class="wrapper"><?php echo $link['Link']['cnt_comments'] ?> Comments</span>
          </h2>
          <ul class="commentlist">
            <?php foreach($link['Comment'] as $comment): ?>
            <li class="comment-block">
              <div class="c-head clearfix">
                <strong class="username">
                  <a href="#">
                    <?php echo $comment['User']['username'] ?>
                    <img src="<?php echo $comment['User']['avatar']?>" class="user-avatar" />
                </a>
                </strong>
                <div class="timeago">
                  <span style="color: #808080; vertical-align: -3px;">·</span>
                  <span><?php echo $this->Time->timeAgoInWords($comment['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?></span>
                </div>
              </div>
              <div class="c-body">
                <?php echo $comment['content']?>
              </div>
              <div class="c-action">
                <a class="c-reply" href="javascript://"></a>
                <div style="clear: both;font-size: 0; line-height: 0;height: 0"> </div>
              </div>
              <ul class="recomments">
                <?php foreach($comment['Recomment'] as $recomment): ?>
                  <li class="recomment-block">
                    <div class="c-head">
                      <strong class="username">
                        <a href="#">
                          <?php echo $recomment['User']['username'] ?>
                          <img src="<?php echo $comment['User']['avatar']?>" class="user-avatar" />
                        </a>
                      </strong>
                      <div class="timeago">
                        <span style="color: #808080; vertical-align: -3px;">·</span>
                        <span><?php echo $this->Time->timeAgoInWords($recomment['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?></span>
                      </div>
                    </div>
                    <div class="c-body">
                      <?php echo $recomment['content']?>
                    </div>
                    <div class="c-action">
                      <a class="rc-reply" href="javascript://"></a>
                      <div style="clear: both;font-size: 0; line-height: 0;height: 0"> </div>
                    </div>
                  </li>
                <?php endforeach ?>
              </ul>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>


      <div class="comments-holder">
      <?php foreach($link['Comment'] as $comment): ?>
        <div class="comment-<?php echo $comment['id'] ?>-holder">
          <?php echo $comment['content'] ?>
          <input style="margin-left: 10px;" id= "recomment-input-<?php echo $comment['id'] ?>" />
          <button onclick="recommentCreate(<?php echo $current_user['User']['id'] ?>,<?php echo $comment['id']?>)"> Recomment </button>
          <div class="recomments-holder">
          <?php foreach($comment['Recomment'] as $recomment): ?>
            <?php echo $recomment['content'] ?>
            <br/>
          <?php endforeach ?>
          </div>
        </div>
      <?php endforeach ?>
      </div>
      <br/>
      <br/>
      <input type='text' name='content' id='comment-input' />
      <button onclick="commentCreate(<?php echo $current_user['User']['id'] ?>,<?php echo $link['Link']['id'] ?>)"> COMMENT </button>
    </div>
    <div class='right-content'>

    </div>
  </div>
</div>

<script type="text/javascript">
var commentCreate = function(user_id,link_id) {
  var content = $("#comment-input").val();
  data = {
    Comment: {
      'user_id': user_id,
      'link_id': link_id,
      'content': content
    }
  };
  $.ajax({
    url: '/Comments/make',
      type: 'post',
      data: {data: data},
      dataType: 'json',
      success: function(response,status) {
        $(".comments-holder").append("<br>" + content);
      }
  })
};

var recommentCreate = function(user_id,comment_id) {
  var content = $("#recomment-input-"+comment_id).val();
  data = {
    Recomment: {
      'user_id': user_id,
      'comment_id': comment_id,
      'content': content
    }
  };
  $.ajax({
    url: '/Recomments/make',
      type: 'post',
      data: {data: data},
      dataType: 'json',
      success: function(response,status) {
        $(".comment-" + comment_id + "-holder .recomments-holder").append("<br>" + content);
      }
  })
};

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
