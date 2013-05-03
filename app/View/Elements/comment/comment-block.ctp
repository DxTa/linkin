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
      <span><?php echo $this->Time->timeAgoInWords(isset($comment['Comment']['created_at']) == true ? $comment['Comment']['created_at'] : $comment['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?></span>
    </div>
  </div>
  <div class="c-body">
    <?php if (isset($comment['Comment']['content'])) echo $comment['Comment']['content'];
          else echo $comment['content'] ?>
  </div>
  <div class="c-action">
    <a class="c-reply" href="javascript://" onclick="$(this).parent().hide().siblings('.comment-form').show();"></a>
    <div style="clear: both;font-size: 0; line-height: 0;height: 0"> </div>
  </div>
  <div class="comment-form" style="display: none;">
    <div class="titleReply">
        <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="title">Recomment</td>
                    <td align="right">
                        <a class="negative" href="javascript:void(0)" onclick="$(this).parentsUntil('.comment-block','.comment-form').hide().siblings('.c-action').show()">
                            <img src="/app/webroot/img/close-noactice.png">
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="bodyReply">

      <?php
        if (isset($comment['Comment']['id'])) {
          echo $this->Form->textarea("recomment-input-{$comment['Comment']['id']}", array('rows' => 3));
        } else {
          echo $this->Form->textarea("recomment-input-{$comment['id']}", array('rows' => 3));
        }
      ?>
      <div class="actionReply">
        <button class="recomment-submit-<?php echo isset($comment['Comment']['id']) == true ? $comment['Comment']['id'] : $comment['id'] ?>" onclick="recommentCreate(<?php echo $current_user['User']['id'] ?>,<?php echo isset($comment['Comment']['id']) == true ? $comment['Comment']['id'] : $comment['id']?>)"> Recomment </button>
      </div>
    </div>
  </div>
  <?php if (!empty($comment['Recomment'])): ?>
  <ul class="recomments comment-<?php echo $comment['id'] ?>">
    <?php foreach($comment['Recomment'] as $recomment): ?>
      <?php echo $this->element('comment/recomment-block', array('recomment' => $recomment, 'comment' => $comment)); ?>
    <?php endforeach ?>
  </ul>
  <?php else: ?>
  <ul class="recomments comment-<?php echo isset($comment['Comment']['id']) == true ? $comment['Comment']['id'] : $comment['id'] ?>" style="display: none;"></ul>
  <?php endif; ?>
</li>
