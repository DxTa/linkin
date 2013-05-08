<div class='top-banner'>
  <div class='adv1'>

  </div>
</div>
<div class='page-wrap ViewLink'>
  <div class='page-content clearfix'>
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
          <span class="author-mess">
            <span class="dot">*</span>
            <?php echo $link['Link']['message'] ?>
          </span>
        </h2>
        <div class='link-meta'>
          <span class='user-info'>
            <strong>
              <a href='/users/view/<?php echo $link['Owner']['id'] ?>' class='link-owner'>
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
        <?php echo $this->Facebook->like(array('href' => "http://localhost:3000".Router::url(array('controller' => 'links', 'action' => 'view', $link['Link']['id'])))); ?>
      </div>



      <div class="linkView-comments">
        <div class="comments-wrapper">
          <h2 class="lineCenterTitle">
            <span class="line"></span>
            <span class="wrapper"><?php echo $link['Link']['cnt_comments'] ?> Comments</span>
          </h2>
          <ul class="commentlist">
            <?php foreach($link['Comment'] as $comment): ?>
              <?php echo $this->element('comment/comment-block', array('comment' => $comment, 'current_user' => $current_user)); ?>
            <?php endforeach ?>
          </ul>
        </div>
      </div>

      <div class="comment-form">
        <div class="titleReply new-comment">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td class="title">New Comment</td>
                        <td align="right">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bodyReply">
          <?php echo $this->Form->textarea("comment-input", array('rows' => 3)); ?>
          <div class="actionReply">
            <button class="comment-submit" onclick="commentCreate(<?php echo $current_user['User']['id'] ?>,<?php echo $link['Link']['id'] ?>)"> COMMENT </button>
          </div>
        </div>
      </div>
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
        $('.linkView-comments ul.commentlist').append(response.data);
        $("#comment-input").val('');
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
        $ele = $(".linkView-comments ul.commentlist .recomments.comment-" + comment_id);
        $ele.append(response.data);
        if ($ele.css('display') =='none')
          $ele.show();
        $("#recomment-input-"+comment_id).parentsUntil('.comment-block','.comment-form').hide().siblings('.c-action').show();
        $("#recomment-input-"+comment_id).val('');
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
