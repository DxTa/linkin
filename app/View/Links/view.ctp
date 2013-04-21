<a href=" <?php echo $link['Link']['url']; ?>">
  <h1> URL </h1>
  <?php echo $this->Facebook->share(null,array('fbxml' => true, 'style' => 'link','label' => 'share it now')); //default is current address ?>
</a>
<h2> Comment </h2>
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
<img src="<?php echo $link['Link']['image'] ?>"/>
<br/>
<input type='text' name='content' id='comment-input' />
<button onclick="commentCreate(<?php echo $current_user['User']['id'] ?>,<?php echo $link['Link']['id'] ?>)"> COMMENT </button>

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

</script>
