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
      <span><?php echo $this->Time->timeAgoInWords(isset($recomment['Recomment']['created_at']) == true ? $recomment['Recomment']['created_at'] : $recomment['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?></span>
    </div>
  </div>
  <div class="c-body">
    <?php echo isset($recomment['Recomment']['content']) == true ? $recomment['Recomment']['content'] : $recomment['content'] ?>
  </div>
  <div class="c-action">
    <a class="rc-reply" href="javascript://"></a>
    <div style="clear: both;font-size: 0; line-height: 0;height: 0"> </div>
  </div>
</li>
