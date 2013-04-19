<a href=" <?php echo $link['Link']['url']; ?>">
  <h1> URL </h1>
</a>
<h2> Comment </h2>
<div class="comments-holder">
<?php foreach($link['Comment'] as $comment): ?>
  <?php echo $comment['content'] ?>
  <?php print "<br>" ?>
<?php endforeach ?>
</div>
<br/>
<img src="<?php echo $link['Link']['image'] ?>"/>
<br/>
<input type='text' name='content' id='comment-input' />
<button onclick="commentCreate(<?php echo $current_user['id'] ?>,<?php echo $link['Link']['id'] ?>)"> COMMENT </button>

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

</script>
